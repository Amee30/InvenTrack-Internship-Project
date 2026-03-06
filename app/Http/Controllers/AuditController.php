<?php

namespace App\Http\Controllers;

use App\Models\Barangs;
use App\Models\Location;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $locations      = Location::orderBy('name')->get();
        $location_id    = $request->input('location_id');
        $selectedLocation = null;
        $barangs        = collect();
        $categorySummary = collect();

        if ($location_id) {
            $selectedLocation = Location::find($location_id);
            $barangs = Barangs::where('location_id', $location_id)
                ->orderBy('kategori')
                ->orderBy('nama_barang')
                ->get();

            // Summary: count per kategori
            $categorySummary = $barangs->groupBy('kategori')->map(fn($items) => $items->count());
        }

        return view('admin.audit.index', compact('locations', 'location_id', 'selectedLocation', 'barangs', 'categorySummary'));
    }

    /**
     * Mark item as available (confirmed present in current location).
     */
    public function markAvailable(Request $request, Barangs $barang)
    {
        $barang->update(['audit_status' => 'available']);

        return redirect()->back()->with('success', "Item \"{$barang->nama_barang}\" marked as Available.");
    }

    /**
     * Mark item as lost — move to the "Lost" location.
     */
    public function markLost(Request $request, Barangs $barang)
    {
        // Find the "Lost" location (case-insensitive)
        $lostLocation = Location::whereRaw('LOWER(name) = ?', ['lost'])->first();

        if (!$lostLocation) {
            return redirect()->back()->with('error', 'No "Lost" location found. Please create a location named "Lost" in Location Management first.');
        }

        $barang->update([
            'audit_status' => 'unavailable',
            'location_id'  => $lostLocation->id,
        ]);

        return redirect()->back()->with('success', "Item \"{$barang->nama_barang}\" marked as Lost and moved to the Lost location.");
    }

    /**
     * Move item to another location.
     */
    public function moveLocation(Request $request, Barangs $barang)
    {
        $request->validate([
            'new_location_id' => 'required|exists:locations,id',
        ]);

        $newLocation = Location::find($request->new_location_id);

        $barang->update([
            'audit_status' => 'available',
            'location_id'  => $request->new_location_id,
        ]);

        return redirect()
            ->route('admin.audit.index', ['location_id' => $request->new_location_id])
            ->with('success', "Item \"{$barang->nama_barang}\" moved to \"{$newLocation->name}\".");
    }
}
