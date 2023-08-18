<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailtransaksi extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idreservasi',
        'idtransaksi',
        'idmeja',
        'idmenu',
        'harga_awal',
        'diskon',
        'harga_akhir',
        'jumlah',
        'total_harga',
        'status',
        'aksi',
    ];
}
