<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barang_id',
        'borrowed_at',
        'return_due_date',
        'returned_at',
        'status',
        'reason',
        'reject_reason',
        'cancelled_at',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'return_due_date' => 'datetime',
        'returned_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barangs::class, 'barang_id');
    }
}
