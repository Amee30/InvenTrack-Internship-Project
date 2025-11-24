<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrowing;
use App\Http\Controllers\NotificationController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AutoCancelBorrowing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrowing:auto-cancel {--test : Run in test mode to see what would be cancelled}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically cancel pending and waiting_pickup borrowings after 1 day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $testMode = $this->option('test');
        $yesterday = Carbon::now()->subDay();

        $this->info('Starting auto-cancel process...');
        $this->info('Current time: ' . Carbon::now()->format('Y-m-d H:i:s'));
        $this->info('Checking for borrowings older than: ' . $yesterday->format('Y-m-d H:i:s'));
        $this->line('');

        // Cancel pending borrowings yang lebih dari 1 hari
        $pendingBorrowings = Borrowing::where('status', 'pending')
            ->where('created_at', '<=', $yesterday)
            ->get();

        $this->info("Found {$pendingBorrowings->count()} pending borrowing(s) to cancel");
        
        if ($pendingBorrowings->count() > 0) {
            $this->table(
                ['ID', 'User', 'Item', 'Created At', 'Hours Ago'],
                $pendingBorrowings->map(function ($b) {
                    return [
                        $b->id,
                        $b->user->name ?? 'N/A',
                        $b->barang->nama_barang ?? 'N/A',
                        $b->created_at->format('Y-m-d H:i:s'),
                        $b->created_at->diffInHours(now()) . ' hours'
                    ];
                })
            );
        }

        if (!$testMode) {
            foreach ($pendingBorrowings as $borrowing) {
                $borrowing->update([
                    'status' => 'rejected',
                    'reject_reason' => 'Automatically cancelled: No admin action taken within 24 hours',
                    'cancelled_at' => now()
                ]);

                // Kirim notifikasi ke user
                try {
                    NotificationController::createNotification(
                        $borrowing->user_id,
                        'borrowing_cancelled',
                        'Borrowing Request Auto-Cancelled',
                        'Your borrowing request for ' . $borrowing->barang->nama_barang . ' has been automatically cancelled due to no admin response within 24 hours.',
                        $borrowing->id
                    );
                } catch (\Exception $e) {
                    Log::error("Failed to create notification", ['error' => $e->getMessage()]);
                }

                $this->info("✓ Cancelled pending borrowing ID: {$borrowing->id}");
                Log::info("Auto-cancelled pending borrowing", ['borrowing_id' => $borrowing->id]);
            }
        } else {
            $this->warn('[TEST MODE] No changes were made');
        }

        $this->line('');

        // Cancel waiting_pickup borrowings yang lebih dari 1 hari
        $waitingPickupBorrowings = Borrowing::where('status', 'waiting_pickup')
            ->where('updated_at', '<=', $yesterday)
            ->get();

        $this->info("Found {$waitingPickupBorrowings->count()} waiting_pickup borrowing(s) to cancel");
        
        if ($waitingPickupBorrowings->count() > 0) {
            $this->table(
                ['ID', 'User', 'Item', 'Updated At', 'Hours Ago'],
                $waitingPickupBorrowings->map(function ($b) {
                    return [
                        $b->id,
                        $b->user->name ?? 'N/A',
                        $b->barang->nama_barang ?? 'N/A',
                        $b->updated_at->format('Y-m-d H:i:s'),
                        $b->updated_at->diffInHours(now()) . ' hours'
                    ];
                })
            );
        }

        if (!$testMode) {
            foreach ($waitingPickupBorrowings as $borrowing) {
                $borrowing->update([
                    'status' => 'rejected',
                    'reject_reason' => 'Automatically cancelled: Item not picked up within 24 hours',
                    'cancelled_at' => now()
                ]);

                // Kirim notifikasi ke user
                try {
                    NotificationController::createNotification(
                        $borrowing->user_id,
                        'borrowing_cancelled',
                        'Borrowing Request Auto-Cancelled',
                        'Your borrowing request for ' . $borrowing->barang->nama_barang . ' has been automatically cancelled because the item was not picked up within 24 hours.',
                        $borrowing->id
                    );

                    // Kirim notifikasi ke admin juga
                    NotificationController::notifyAdmins(
                        'pickup_timeout',
                        'Pickup Timeout',
                        'Borrowing request for ' . $borrowing->barang->nama_barang . ' by ' . $borrowing->user->name . ' has been auto-cancelled due to no pickup.',
                        $borrowing->id
                    );
                } catch (\Exception $e) {
                    Log::error("Failed to create notification", ['error' => $e->getMessage()]);
                }

                $this->info("✓ Cancelled waiting_pickup borrowing ID: {$borrowing->id}");
                Log::info("Auto-cancelled waiting_pickup borrowing", ['borrowing_id' => $borrowing->id]);
            }
        } else {
            $this->warn('[TEST MODE] No changes were made');
        }

        $this->line('');
        $totalCancelled = $pendingBorrowings->count() + $waitingPickupBorrowings->count();
        
        if ($testMode) {
            $this->info("Total borrowings that would be cancelled: {$totalCancelled}");
        } else {
            $this->info("Total auto-cancelled borrowings: {$totalCancelled}");
        }

        return 0;
    }
}
