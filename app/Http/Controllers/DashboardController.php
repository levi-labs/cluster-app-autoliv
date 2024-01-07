<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barang         = Barang::count();
        $barangMasuk    = BarangMasuk::count();
        $barangKeluar   = BarangKeluar::count();
        $user           = User::count();
        return view(
            'pages.dashboard.index',
            compact(
                'barang',
                'barangMasuk',
                'barangKeluar',
                'user'
            )
        );
    }
}
