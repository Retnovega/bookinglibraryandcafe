<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'judul',
      'jam',
      'tanggal',
      'deskripsi',
      'narasumber',
      'upload',
      'status',
    ];
}
