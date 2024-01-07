<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Kategori';
        $data       = Kategori::all();
        return view('pages.kategori.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'From Add Kategori';
        $kategori   = new Kategori();

        return view('pages.kategori.add', ['title' => $title, 'kategori' => $kategori->getKodeKategori()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_kategori' => 'required',
            'nama'          => 'required'
        ]);
        try {
            $kategori                   = new Kategori();
            $kategori->kode_kategori    = $request->kode_kategori;
            $kategori->nama             = $request->nama;
            $kategori->save();

            return redirect('kategori/index')->with('success', 'Kategori Berhasil di tambah ');
        } catch (\Exception $e) {
            return  back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $title             = 'Form Edit Kategori';
        $kategori          = Kategori::where('id', $kategori->id)->first();

        return view('pages.kategori.edit', ['title' => $title, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->validate($request, [
            'kode_kategori'     => 'required',
            'nama'              => 'required'
        ]);

        try {
            $kategori                   = Kategori::where('id', $kategori->id)->first();
            $kategori->kode_kategori    = $request->kode_kategori;
            $kategori->nama             = $request->nama;
            $kategori->save();

            return redirect('kategori/index')->with('success', 'Kategori Berhasil di update');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori          = Kategori::where('id', $kategori->id)->first();
            $kategori->delete();

            return back()->with('success', 'Kategori Berhasil di delete');
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return back()->with('failed', 'Kategori gagal di delete , Data Kategori digunakan / Hapus terlebih dahulu pada Barang');
            } else {
                return back()->with('failed', $e->getMessage());
            }
        }
    }
}
