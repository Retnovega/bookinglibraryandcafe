<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idcustomer',
        'kodereservasi',
        'tanggal',
        'jam',
        'jumlah',
        'status',
        'no_meja',
        'massage',
        'pembayaran',
        'buktibayar',
        'bank',
        'pemilik',
        'jumlahbayar',
        'biayalain',
        'keperluanid',
    ];
}
