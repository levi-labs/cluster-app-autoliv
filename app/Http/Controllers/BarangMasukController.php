<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title          = 'Daftar Barang Masuk';
        $barangMasuk    = BarangMasuk::paginate(20);

        return view('pages.barang-masuk.index', [
            'title' => $title,
            'data'  => $barangMasuk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title          = 'Form Add Barang Masuk';
        $kode           = new BarangMasuk();
        $barang         = Barang::all();

        return view('pages.barang-masuk.add', [
            'title'     => $title,
            'kode'      => $kode->getKodeBarangMasuk(),
            'barang'    => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_barang'       => 'required',
            'barang'            => 'required',
            'harga_beli'        => 'required',
            'tanggal_masuk'     => 'required',
            'quantity_masuk'    => 'required'
        ]);
        DB::beginTransaction();
        try {
            $bMasuk                     = new BarangMasuk();
            $bMasuk->kode_barang_masuk  = $request->kode_barang;
            $bMasuk->barang_id          = $request->barang;
            $bMasuk->qty_masuk          = $request->quantity_masuk;
            $bMasuk->tanggal_masuk      = $request->tanggal_masuk;
            $bMasuk->harga_beli         = $request->harga_beli;
            $bMasuk->save();
            $barang                     = Barang::where('id', $request->barang)->first();
            $barang->stock              = $barang->stock + $request->quantity_masuk;
            $barang->save();

            DB::commit();

            return redirect('barang-masuk/index')->with('success', 'Barang Masuk berhasil di tambah');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $title      = 'Form Edit Barang Masuk';
        $bMasuk     = BarangMasuk::where('id', $barangMasuk->id)->first();
        $barang     = Barang::all();

        return view('pages.barang-masuk.edit', [
            'title'     => $title,
            'bMasuk'    => $bMasuk,
            'barang'    => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {

        $this->validate($request, [
            'barang'            => 'required',
            'harga_beli'       => 'required',
            'tanggal_masuk'     => 'required',
            'quantity_masuk'    => 'required'
        ]);

        DB::beginTransaction();

        try {

            $bMasuk                 = BarangMasuk::where('id', $barangMasuk->id)->first();

            $bMasuk->barang_id      = $request->barang;
            $bMasuk->harga_beli     = $request->harga_beli;
            $bMasuk->tanggal_masuk  = $request->tanggal_masuk;
            $barang                 = Barang::where('id', $bMasuk->barang_id)->first();
            $tempStock              = $barang->stock - $bMasuk->qty_masuk;

            $bMasuk->qty_masuk      = $request->quantity_masuk;
            $bMasuk->save();

            $barang->stock          = $tempStock + $bMasuk->qty_masuk;
            $barang->save();

            DB::commit();

            return redirect('barang-masuk/index')->with('success', 'Barang Masuk berhasil di update');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        DB::beginTransaction();
        try {
            $bMasuk         = BarangMasuk::where('id', $barangMasuk->id)->first();
            $barang         = Barang::where('id', $barangMasuk->barang_id)->first();
            $barang->stock  = $barang->stock - $bMasuk->qty_masuk;
            $barang->save();

            $bMasuk->delete();

            DB::commit();

            return back()->with('success', 'Barang Masuk berhasil di delete');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('failed', $e->getMessage());
        }
    }
}
