<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangKeluar extends Model
{
    use HasFactory;


    protected $fillable = ['kode_barang_keluar', 'barang_id', 'qty_keluar', 'harga_jual', 'tanggal_keluar'];


    protected $table = 'barang_keluar';
    public $timestamps = false;



    public function getCalculateData($month, $year)
    {
        $query = 'SELECT
                        bk.barang_id AS bkbid, b.nama,b.stock AS stock_awal,
                        SUM(qty_keluar) AS penjualan, 
                        COUNT(bk.barang_id) AS bkbid,
                        bk.harga_jual AS harga_jual,
                        SUM(harga_jual * qty_keluar) AS transaction
                    FROM barang_keluar bk 
                        INNER JOIN barang b 
                        ON bk.barang_id = b.id 
                        WHERE MONTH(tanggal_keluar)= ' . $month . ' AND YEAR(tanggal_keluar)= ' . $year . ' GROUP BY bk.barang_id,b.nama,stock,harga_jual';
        return DB::select($query);
    }
    public function getReportBarangKeluar($from, $to)
    {
        $first  = $this->all()->first();
        $last   = $this->all()->last();

        if ($from != null && $to != null) {
            $query      = $this->where('tanggal_keluar', '>=', $from)->where('tanggal_keluar', '<=', $to)->get();
            return $query;
        } elseif ($from != null && $to == null) {
            $query      = $this->where('tanggal_keluar', '>=', $from)->where('tanggal_keluar', '<=', $last->tanggal_keluar)->get();
            return [$query, $first->tanggal_masuk, $last->tanggal_keluar];
        } elseif ($from == null && $to != null) {
            $query      = $this->where('tanggal_keluar', '>=', $first->tanggal_keluar)->where('tanggal_keluar', '<=', $to)->get();
            return [$query, $first->tanggal_masuk, $last->tanggal_keluar];
        }
    }

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function getKodeBarangKeluar()
    {
        $count = $this->count();

        if ($count == 0) {
            $format     = 00001;
            $number     = 'BK-' . sprintf('%05s', $format);
        } else {
            $last       = $this->all()->last();
            $sequence   = (int)substr($last->kode_barang_keluar, -5) + 1;
            $number     = 'BK-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
