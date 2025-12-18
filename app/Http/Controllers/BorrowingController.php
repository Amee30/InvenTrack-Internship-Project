<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Barangs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get filter kategori dari request
        $selectedKategori = $request->get('kategori');

        // Query barang dengan filter is_hidden dan kategori
        $barangs = Barangs::where('is_hidden', false)
            ->when($selectedKategori && $selectedKategori !== 'all', function ($query) use ($selectedKategori) {
                return $query->where('kategori', $selectedKategori);
            })
            ->get();

        // Get semua kategori unik untuk dropdown (hanya dari barang yang tidak hidden)
        $kategori = Barangs::where('is_hidden', false)
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');
        
        $borrowings = Borrowing::where('user_id', Auth::id())->with('barang')->get();

        return view('dashboard', compact('barangs', 'borrowings', 'kategori', 'selectedKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Barangs $barangs)
    {
        return view('borrowing.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'borrowed_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after_or_equal:borrowed_date',
            'reason' => 'required|string|max:500',
        ]);

        $barang = Barangs::findOrFail($request->barang_id);

        if ($barang->stok < 1) {
            return back()->with('error', 'Item is currently out of stock.');
        }

        $existingRequest = Borrowing::where('user_id', Auth::id())
            ->where('barang_id', $request->barang_id)
            ->whereIn('status', ['pending', 'waiting_pickup', 'borrowed', 'waiting_return'])
            ->exists();
        
        if ($existingRequest) {
            return back()->with('error', 'You already have a pending borrowing request for this item.');
        }
        
        $activeRequestCount = Borrowing::where('barang_id', $request->barang_id)
            ->whereIn('status', ['pending', 'waiting_pickup', 'borrowed', 'waiting_return'])
            ->count();

        if ($activeRequestCount >= $barang->stok) {
            return back()->with('error', 'This item is currently unavailable. All stock is either requested or borrowed by other user.');
        }


        // Gabungkan date dengan waktu saat ini untuk borrowed_at
        $borrowedAt = Carbon::parse($request->borrowed_date)->setTime(
            now()->hour,
            now()->minute,
            now()->second
        );

        // Gabungkan return_date dengan waktu default 17:00 (5 PM)
        $returnDueDate = Carbon::parse($request->return_date)->setTime(17, 0, 0);

        Borrowing::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'borrowed_at' => $borrowedAt,
            'return_due_date' => $returnDueDate,
            'status' => 'pending',
            'reason' => $request->reason,
        ]);

        // Kirim notifikasi ke semua admin
        NotificationController::notifyAdmins(
            'new_borrowing_request',
            'New Borrowing Request',
            Auth::user()->name . ' has requested to borrow ' . $barang->nama_barang,
            null
        );

        return redirect()->route('pinjam.history')->with('success', 'Borrowing request submitted successfully. Waiting for admin approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        // Explicitly check if user is admin first
        if (Auth::user()->role == 'admin') {
            $userId = $borrowing->user_id;
            $userStats = [
                'total' => Borrowing::where('user_id', $userId)->count(),
                'active' => Borrowing::where('user_id', $userId)->where('status', 'borrowed')->count(),
                'completed' => Borrowing::where('user_id', $userId)->where('status', 'returned')->count(),
                'rejected' => Borrowing::where('user_id', $userId)->where('status', 'rejected')->count(),
                'pending' => Borrowing::where('user_id', $userId)->where('status', 'pending')->count(),
            ];
            return view('borrowing.show', compact('borrowing', 'userStats'));
        }
        
        // If not admin, check if it's their own borrowing
        if ($borrowing->user_id !== Auth::id()) {
            abort(403, 'You do not have access to view this borrowing.');
        }

        return view('borrowing.show', compact('borrowing'));
    }

    
    public function edit(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }

        return view('borrowing.edit', compact('borrowing'));
    }

    
    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'borrowed_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrowed_date',
            'reason' => 'required|string|max:500',
        ]);

        // Update dengan waktu yang sudah ada atau set default
        $borrowedAt = Carbon::parse($request->borrowed_date)->setTime(
            Carbon::parse($borrowing->borrowed_at)->hour,
            Carbon::parse($borrowing->borrowed_at)->minute,
            Carbon::parse($borrowing->borrowed_at)->second
        );

        $returnDueDate = Carbon::parse($request->return_date)->setTime(
            Carbon::parse($borrowing->return_due_date)->hour,
            Carbon::parse($borrowing->return_due_date)->minute,
            Carbon::parse($borrowing->return_due_date)->second
        );

        $borrowing->update([
            'borrowed_at' => $borrowedAt,
            'return_due_date' => $returnDueDate,
            'reason' => $request->reason,
        ]);

        return redirect()->route('pinjam.history')->with('success', 'Borrowing request updated successfully.');
    }

    
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id() || $borrowing->status !== 'pending') {
            abort(403);
        }
        $borrowing->delete();
        return redirect()->route('dashboard')->with('success', 'Borrowing request cancelled successfully.');
    }

    public function history(){
        $borrowings = Borrowing::where('user_id', Auth::id())->with('barang')->orderBy('created_at', 'desc')->paginate(5);
        return view('borrowing.history', compact('borrowings'));
    }

    public function generateReceipt(Borrowing $borrowing)
    {
        $allowedStatuses = ['approved', 'borrowed', 'returned', 'waiting_return', 'waiting_pickup'];
        // cek status peminjaman
        if (!in_array($borrowing->status, $allowedStatuses)) {
            abort(403, 'Receipt can only be generated for approved, borrowed, or returned borrowings.');
        }

        // Cek apakah pengguna adalah admin 
        if (Auth::id() !== $borrowing->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'You do not have access to this receipt.');
        }
        
        // Generate PDF 
        $pdf = PDF::loadView('borrowing.receipt-pdf', compact('borrowing'));
        
        // Set paper size ke A4
        $pdf->setPaper('a4');
        
        return $pdf->stream('Borrowing_Receipt_'. $borrowing->id .'.pdf');
    }

     public function returnItem(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id()){
            abort(403, 'You do not have access to return this borrowing.');
        }

        if ($borrowing->status !== 'borrowed'){
            return redirect()->back()->with('error', 'This item is not currently borrowed.');
        }

        $borrowing->update(['status' => 'waiting_return']);

        // Kirim notifikasi ke semua admin
        NotificationController::notifyAdmins(
            'return_request',
            'Return Request',
            Auth::user()->name . ' has requested to return ' . $borrowing->barang->nama_barang,
            $borrowing->id
        );

        return redirect()->route('pinjam.history')->with('success', 'Return Request Submitted. Please bring the item to admin for scanning');
    }
}
