<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapak extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
      'category',
      'name',
      'foto',
      'harga',
      'diskon',
      'deskripsi',
      'status',
    ];
}
