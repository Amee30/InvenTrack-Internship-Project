<?php
namespace App\Http\Controllers;

use Illuminate\Console\Command;
use App\Models\Borrowing;
use App\Http\Controllers\NotificationController;
use Carbon\Carbon;

class AutoCancelBorrowing extends Command
{
    protected $signature = 'borrowing:auto-cancel';
    protected $description = 'Automatically cancel pending and waiting_pickup borrowings within 1 days';

    public function handle()
    {
        $yesterday = Carbon::now()->subDays();

        // Cancel pending borrowings yang lebih dari 1 hari
        $pendingBorrowings = Borrowing::where('status', 'pending')
            ->where('created_at', '<=', $yesterday)
            ->get();
        
        foreach ($pendingBorrowings as $borrowing) {
            $borrowing->update([
                'status' => 'rejected',
                'reject_reason' => 'Automatically cancelled: No admin action taken within 24 hours'
            ]);
            
            // Kirim notifikasi ke user
            NotificationController::createNotification(
                $borrowing->user_id,
                'borrowing_rejected',
                'Borrowing Request Automatically Cancelled',
                'Your borrowing request for ' . $borrowing->barang->nama_barang . ' has been automatically cancelled due to no admin action within 24 hours.',
                $borrowing->id
            );

            $this->info('Cancelled pending borrowing ID: ' . $borrowing->id);
        }

        // Cancel waiting_pickup yang lebih dari 1 hari
        $waitingPickupBorrowings = Borrowing::where('status', 'waiting_pickup')
            ->where('updated_at', '<=', $yesterday)
            ->get();
        
        foreach ($waitingPickupBorrowings as $borrowing) {
            $borrowing->update([
                'status' => 'rejected',
                'reject_reason' => 'Automatically cancelled: Not picked up within 24 hours'
            ]);
            
            // Kirim notifikasi ke user
            NotificationController::createNotification(
                $borrowing->user_id,
                'borrowing_rejected',
                'Borrowing Request Automatically Cancelled',
                'Your borrowing request for ' . $borrowing->barang->nama_barang . ' has been automatically cancelled due to not being picked up within 24 hours.',
                $borrowing->id
            );

            // Kirim notifikasi ke admin
            NotificationController::notifyAdmins(
                'pickup_timeout',
                'Pickup Timeout',
                'The borrowing request for ' . $borrowing->barang->nama_barang . ' by ' . $borrowing->user->name . ' has been automatically cancelled due to not being picked up within 24 hours.',
                $borrowing->id
            );

            $this->info('Cancelled waiting_pickup borrowing ID: ' . $borrowing->id);
        }

        $totalCancelled = $pendingBorrowings->count() + $waitingPickupBorrowings->count();
        $this->info("Total borrowings automatically cancelled: {$totalCancelled}");

        return 0;
    }
}