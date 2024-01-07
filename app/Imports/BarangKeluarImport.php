<?php

namespace App\Imports;

use App\Models\BarangKeluar;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangKeluarImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kode = new BarangKeluar();

        return new BarangKeluar([

            'kode_barang_keluar' =>  $kode->getKodeBarangKeluar(),
            'barang_id'         =>  $row['barang_id'],
            'harga_jual'        =>  $row['harga_jual'],
            'qty_keluar'        =>  $row['qty_keluar'],
            'tanggal_keluar'    =>  $row['tanggal_keluar'],
        ]);
    }
}
