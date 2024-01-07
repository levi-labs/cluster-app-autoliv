<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstantPerhitungan extends Model
{
    use HasFactory;

    protected $table    = 'dataset';
    public $timestamps  = false;

    protected $fillable = ['nama', 'penjualan'];
}
