<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monolog extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
      'category',
      'foto',
      'judul',
      'tanggal',
      'deskripsi',
      'upload',
      'penulis',
      'status',
    ];
}
