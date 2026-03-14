<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Location;

class Barangs extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'manufacturer',
        'model',
        'serial_number',
        'asset_tag',
        'qr_code',
        'stok',
        'foto',
        'is_hidden',
        'location_id',
        'audit_status',
        'last_audited_at',
    ];

    protected $casts = [
        'is_hidden'       => 'boolean',
        'last_audited_at' => 'datetime',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'barang_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            if (empty($barang->qr_code)) {
                $barang->qr_code = 'BRG' . Str::upper(Str::random(10));
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
