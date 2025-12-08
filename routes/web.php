<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangMovementController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BorrowingController::class, 'index'])->name('dashboard');
    Route::get('/pinjam/history', [BorrowingController::class, 'history'])->name('pinjam.history');
    Route::get('/pinjam/{barangs}', [BorrowingController::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam', [BorrowingController::class, 'store'])->name('pinjam.store');
    Route::post('/pinjam/{borrowing}/return', [BorrowingController::class, 'returnItem'])->name('pinjam.return');
    
    Route::get('/pinjam/{borrowing}/show', [BorrowingController::class, 'show'])->name('pinjam.show');
    Route::delete('/pinjam/{borrowing}', [BorrowingController::class, 'destroy'])->name('pinjam.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pinjam/{borrowing}/receipt', [BorrowingController::class, 'generateReceipt'])
        ->name('pinjam.receipt')
        ->middleware(['auth']);

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount']);
    Route::get('/notifications/recent', [NotificationController::class, 'getRecent']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Gunakan resource kecuali show
    Route::resource('barang', AdminController::class)->except(['show']);
    
    Route::resource('users', UserController::class);
    Route::resource('movements', BarangMovementController::class);
    
    // Route untuk AJAX requests
    Route::get('/barang/{id}/details', [AdminController::class, 'getDetails'])->name('barang.details');
    Route::get('/barang/{id}/qr-code', [AdminController::class, 'getQrCode'])->name('barang.qrcode');
    
    Route::post('/peminjaman/{peminjaman}/approve', [AdminController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{peminjaman}/reject', [AdminController::class, 'reject'])->name('peminjaman.reject');

    Route::get('/qr-scanner', [AdminController::class, 'showQrScanner'])->name('qr-scanner');
    Route::post('/qr-scan/pickup', [AdminController::class, 'scanPickup'])->name('qr.pickup');
    Route::post('/qr-scan/return', [AdminController::class, 'scanReturn'])->name('qr.return');

    // Export Routes
    Route::get('/export', [ExportController::class, 'showExportOptions'])->name('export.options');
    Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');

    Route::post('/barang/{barang}/toggle-visibility', [AdminController::class, 'toggleVisibility'])
        ->name('barang.toggleVisibility');
});

require __DIR__.'/auth.php';
