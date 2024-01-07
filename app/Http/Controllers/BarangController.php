<?php

namespace App\Http\Controllers;

use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\Kategori;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Barang';
        $data       = Barang::paginate(20);

        return view('pages.barang.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'Form Add Barang';
        $kode       = new Barang();
        $kategori   = Kategori::all();

        return view('pages.barang.add', [
            'title'     => $title,
            'barang'    => $kode->getKodeBarang(),
            'kategori'  => $kategori
        ]);
    }

    public function importExcel(Request $request)
    {
        $this->validate($request, [
            'document' => 'required|mimes:csv,xls,xlsx',
        ]);
        try {
            $file = $request->file('document');

            Excel::import(new BarangImport, $file);

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
            'nama'          => 'required',
            'kode_barang'   => 'required',
            'kategori'      => 'required',
            'stock'         => 'required',
            'satuan'        => 'required',
            'foto_barang'   => 'required'
        ]);

        try {
            $barang                     = new Barang();
            $barang->nama               = $request->nama;
            $barang->kode_barang        = $request->kode_barang;
            $barang->kategori_id        = $request->kategori;
            $barang->stock              = $request->stock;
            $barang->satuan             = $request->satuan;
            $imgFile                    = $request->file('foto_barang');
            if ($imgFile) {
                $nama                   = rand() . $request->nama . '-' . $request->kode_barang . '.' . $imgFile->getClientOriginalExtension();
                $path                   = 'images';
                $saveFile               = $imgFile->storeAs($path, $nama);
                $barang->foto_barang    = $saveFile;
                $barang->save();

                return redirect('barang/index')->with('success', 'Barang berhasil di tambah');
            } else {
                return back()->withErrors(['file_error' => 'something went wrong your files might not have been uploaded ']);
            }
        } catch (Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        try {
            $title      = 'Detail Barang';
            $barang     = Barang::where('id', $barang->id)->first();

            return view('pages.barang.detail', [
                'title'     => $title,
                'barang'    => $barang
            ]);
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $title          = 'Form Edit Barang';
        $kategori       = Kategori::all();
        $barang         = Barang::where('id',  $barang->id)->first();

        return view('pages.barang.edit', [
            'title'     => $title,
            'barang'    => $barang,
            'kategori'  => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'kode_barang'   => 'required',
            'nama'          => 'required',
            'kategori'      => 'required',
            'stock'         => 'required',
            'satuan'        => 'required',
        ]);

        try {
            $data                 =  Barang::where('id', $barang->id)->first();
            $data->kode_barang    = $request->kode_barang;
            $data->nama           = $request->nama;
            $data->kategori_id    = $request->kategori;
            $data->stock          = $request->stock;
            $data->satuan         = $request->satuan;

            $imgFile                = $request->file('foto_barang');

            if ($imgFile) {
                if ($data->foto_barang != NULL) {
                    Storage::delete($data->foto_barang);
                }
                $nama                 = rand() . $request->nama . '-' . $request->kode_barang . '.' . $imgFile->getClientOriginalExtension();
                $path                 = 'images';
                $saveFile             = $imgFile->storeAs($path, $nama);
                $data->foto_barang    = $saveFile;
            } else {
                $saveFile             = $data->foto_surat;
            }
            $data->foto_barang        = $saveFile;
            $data->update();

            return redirect('barang/index')->with('success', 'Barang ' . $barang->kode_barang . ' berhasil di update');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        try {
            $data     = Barang::where('id', $barang->id)->first();
            $data->delete();

            return back()->with('success', 'Barang berhasil di delete');
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                return back()->with('failed', 'Barang gagal di delete , Data Barang digunakan / Hapus terlebih dahulu pada Barang Masuk , Barang Keluar');
            } else {
                return back()->with('failed', $e->getMessage());
            }
        }
    }
}
