<?php

namespace App\Http\Controllers;

use App\Imports\InstantPerhitunganImport;
use App\Models\InstantPerhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InstantPerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Perhitungan K-Means';
        $data       = InstantPerhitungan::paginate(20);
        return view('pages.k-means.index', [
            'title' => $title,
            'data'  => $data
        ]);
    }

    public function importExcel(Request $request)
    {
        $this->validate($request, [
            'document' => 'required'
        ]);
        try {
            $file   = $request->file('document');
            if (isset($file)) {

                DB::table('dataset')->truncate();

                Excel::import(new InstantPerhitunganImport, $file);

                return back()->with('success', 'File Datasets berhasil di import');
            }
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function createPerhitungan()
    {
        $title          = 'Form K Means';

        return view('pages.k-means.form', ['title' => $title]);
    }

    public function prosesPerhitungan(Request $request)
    {
        $this->validate($request, [
            'iterasi'   => 'required',
            'divide'    => 'required'
        ]);

        $title              = 'Hasil K-Means Clustering';
        $iteration          = $request->iterasi;
        $divide             = $request->divide;
        $kmeans             = new ProsesPerhitunganController();
        $instanceCenteroid  = $kmeans->getInstantCalculate($iteration, $divide);
        $dataset            = InstantPerhitungan::all()->toArray();
        $result_average     = [];
        $updateCentroid     = [];
        for ($i = 0; $i < count($dataset); $i++) {
            $result_average[] = [$dataset[$i], $dataset[$i]['penjualan'] / $divide];
        }
        // dd($instanceCenteroid[0], $instanceCenteroid[1]);
        // dd($instanceCenteroid);
        //dd($instanceCenteroid[0][0], $result_average, $instanceCenteroid[0][1]);
        // $insert_to_db   = $this->storePerhitungan($instanceCenteroid);
        return view('pages.k-means.result', [
            'title'         => $title,
            'data'          => $instanceCenteroid[0][0],
            'average'       => $result_average,
            'cluster_1'     => $instanceCenteroid[0][1],
            'cluster_2'     => $instanceCenteroid[0][2],
            'newClusterss'  => $instanceCenteroid[1]
        ]);
    }

    public function storePerhitungan($data)
    {
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InstantPerhitungan $instantPerhitungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstantPerhitungan $instantPerhitungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstantPerhitungan $instantPerhitungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstantPerhitungan $instantPerhitungan)
    {
        //
    }
}
