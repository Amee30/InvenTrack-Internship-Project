<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Barangs extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'serial_number',
        'qr_code',
        'stok',
        'foto',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'barang_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            if (empty($barang->qr_code)) {
                $barang->qr_code = 'BRG' . Str::upper(Str::random(20));
            }
        });
    }

    // PERBAIKAN: Convert HtmlString ke string biasa
    public function generateQrCodeImage()
    {
        $qrCode = QrCode::size(200)
            ->margin(2)
            ->generate($this->qr_code);
        
        // Convert HtmlString object ke string
        return (string) $qrCode;
    }
}
