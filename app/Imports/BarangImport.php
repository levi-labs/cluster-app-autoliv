<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kode = new Barang();

        return new Barang([
            //
            'kode_barang' =>  $kode->getKodeBarang(),
            'nama'        =>  $row['nama'],
            'kategori_id' =>  $row['kategori_id'],
            'stock'       =>  $row['stock'],
            'satuan'      =>  $row['satuan'],
            'foto_barang' =>  $row['foto_barang']
        ]);
    }
}
