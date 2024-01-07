<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    public $timestamps = false;

    public function getKodeKategori()
    {
        $kategori = $this->count();
        if ($kategori == 0) {
            $counter = 00001;
            $number  = 'K-' . sprintf('%05s', $counter);
        } else {
            $last     = $this->all()->last();
            $sequence = (int)substr($last->kode_kategori, -5) + 1;
            $number   = 'K-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
