<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
      'nama',
      'alamat',
      'nomor_hp',
      'deskripsi',
      'lokasi',
      'foto',
      'status',
    ];
}
