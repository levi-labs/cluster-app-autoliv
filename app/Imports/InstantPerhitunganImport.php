<?php

namespace App\Imports;

use App\Models\InstantPerhitungan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InstantPerhitunganImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new InstantPerhitungan([
            //
            'nama'      => $row['nama'],
            'penjualan' => $row['penjualan']
        ]);
    }
}
