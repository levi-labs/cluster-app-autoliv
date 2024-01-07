<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kode_barang', 'satuan', 'kategori_id', 'stock', 'foto_barang'];
    protected $table = 'barang';

    public  $timestamps = false;


    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function getKodeBarang()
    {
        $barang = $this->count();

        if ($barang == 0) {
            $counter    = 00001;
            $number     = 'B-' . sprintf('%05s', $counter);
        } else {
            $last       = $this->all()->last();
            $sequence   = (int)substr($last->kode_barang, -5) + 1;
            $number     = 'B-' . sprintf('%05s', $sequence);
        }

        return $number;
    }

    public function getFoto()
    {
        return '/storage/' . $this->foto_barang;
    }
}
