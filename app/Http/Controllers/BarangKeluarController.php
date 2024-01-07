<?php

namespace App\Http\Controllers;

use App\Imports\BarangKeluarImport;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\InstantPerhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Barang Keluar';
        $data       = BarangKeluar::paginate(20);

        return view('pages.barang-keluar.index', ['title' => $title, 'data' => $data]);
    }

    public function formKmeans()
    {
        $title  = 'Form Perhitungan K-means';

        return view('pages.barang-keluar.kmeans-form', ['title' => $title]);
    }
    public function kmeansProses(Request $request)
    {
        try {
            $title      = 'Perhitungan K-means Barang-keluar';
            $calculate  = new ProsesPerhitunganController();

            $explode    = explode('-', $request->datepicker);

            $year       = $explode[1];
            $month      = $explode[0];
            $divide     = $request->divide;
            $bKeluar    = new BarangKeluar();
            $query      = $bKeluar->getCalculateData($month, $year);
            $result     = $calculate->store($query, $divide);
            // dd($result);
            return view('pages.barang-keluar.kmeans-result', ['title' => $title, 'result' => $result]);
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'Form Add Barang Keluar';
        $kode       = new BarangKeluar();
        $barang     = Barang::all();

        return view('pages.barang-keluar.add', [
            'title'     => $title,
            'kode'      => $kode->getKodeBarangKeluar(),
            'barang'    => $barang
        ]);
    }
    public function importExcel(Request $request)
    {

        // $this->validate($request, [
        //     'document' => 'required|mimes:csv,xls,xlsx',
        // ]);
        try {
            DB::table('barang_keluar')->truncate();
            $file = $request->file('document');

            Excel::import(new BarangKeluarImport, $file);

            return back()->with('success', 'Barang berhasil di import');
        } catch (\Throwable $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'barang'                => 'required',
            'kode_barang_keluar'    => 'required',
            'quantity_keluar'       => 'required',
            'harga_jual'            => 'required',
            'tanggal_keluar'        => 'required',

        ]);

        DB::beginTransaction();
        try {
            $bKeluar                        = new BarangKeluar();
            $bKeluar->kode_barang_keluar    = $request->kode_barang_keluar;
            $bKeluar->qty_keluar            = $request->qty_keluar;
            $bKeluar->barang_id             = $request->barang;
            $bKeluar->harga_jual            = $request->harga_jeluar;
            $bKeluar->tanggal_keluar        = $request->tanggal_keluar;
            $bKeluar->save();

            $barang                         = Barang::where('id', $request->barang)->first();
            $temp                           = $barang->stock - $bKeluar->qty_keluar;
            $barang->stock                  = $temp;
            $barang->save();
            DB::commit();

            return redirect('barang-keluar/store')->with('success', 'Barang Keluar berhasil di tambah');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {

        $bKeluar        = BarangKeluar::where('id', $barangKeluar->id)->first();
        $title          = 'Detail-' . $bKeluar->kode_barang_keluar;

        return view('pages.barang-keluar', ['title' => $title, 'bKeluar' => $bKeluar]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        $bKeluar        = BarangKeluar::where('id', $barangKeluar->id)->first();
        $barang         = Barang::all();
        $title          = 'Form Edit Barang Keluar';

        return view('pages.barang-keluar.edit', ['title' => $title, 'bKeluar' => $bKeluar, 'barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $this->validate($request, [
            'barang'                => 'required',
            'kode_barang_keluar'    => 'required',
            'quantity_keluar'       => 'required',
            'harga_jual'            => 'required',
            'tanggal_keluar'        => 'required',
        ]);

        DB::beginTransaction();

        try {
            $bKeluar                    = BarangKeluar::where('id', $barangKeluar->id)->first();
            $bKeluar->barang_id         = $request->barang;
            $tempQtyKeluar              = $bKeluar->qty_keluar;
            $bKeluar->qty_keluar        = $request->quantity_keluar;
            $bKeluar->harga_jual        = $request->harga_jual;
            $bKeluar->tanggal_keluar    = $request->tanggal_keluar;
            $bKeluar->save();

            $barang                     = Barang::where('id', $request->barang)->first();
            $temp                       = $barang->stock + $tempQtyKeluar;
            $barang->stock              = $temp - $bKeluar->qty_keluar;
            $barang->save();

            DB::commit();

            return redirect('barang-keluar/index')->with('success', 'Barang Keluar ' . $bKeluar->kode_barang_keluar . ' berhasil di update');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::beginTransaction();
        try {
            $bKeluar        = BarangKeluar::where('id', $barangKeluar->id)->first();
            $barang         = Barang::where('id', $bKeluar->barang_id)->first();

            $result         = $barang->stock + $bKeluar->quantity_keluar;
            $barang->stock  = $result;
            $barang->save();

            $bKeluar->delete();
            DB::commit();

            return back()->with('success', 'Barang Keluar ' . $bKeluar->kode_barang_keluar . ' berhasil di delete');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('failed', $e->getMessage());
        }
    }
}
