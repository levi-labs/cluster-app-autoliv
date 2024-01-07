<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table    = 'barang_masuk';
    public $timestamps  = false;



    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function getReportBarangMasuk($from, $to)
    {
        $first  = $this->all()->first();
        $last   = $this->all()->last();
        if ($from != null && $to != null) {
            $query      = $this->where('tanggal_masuk', '>=', $from)->where('tanggal_masuk', '<=', $to)->get();
            return $query;
        } elseif ($from != null && $to == null) {
            $query      = $this->where('tanggal_masuk', '>=', $from)->where('tanggal_masuk', '<=', $last->tanggal_masuk)->get();
            return [$query, $first->tanggal_masuk, $last->tanggal_masuk];
        } elseif ($from == null && $to != null) {
            $query      = $this->where('tanggal_masuk', '>=', $first->tanggal_masuk)->where('tanggal_masuk', '<=', $to)->get();
            return [$query, $first->tanggal_masuk, $last->tanggal_masuk];
        }
    }
    public function getKodeBarangMasuk()
    {

        $count =  $this->count();

        if ($count == 0) {
            $format     = 00001;
            $number     = 'BGM-' . sprintf('%05s', $format);
        } else {
            $lastNumber = $this->all()->last();
            $sequence   = (int)substr($lastNumber->kode_barang_masuk, -5) + 1;
            $number     = 'BGM-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
