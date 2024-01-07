<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportMasukController extends Controller
{
    public function index(Request $request)
    {
        $title    = 'Form Report Masuk';
        return view('pages.reports.report-masuk', ['title' => $title]);
    }

    public function sendReportMasuk(Request $request)
    {
        try {
            $title  = 'Report Barang Masuk';

            $from   = $request->from_date;
            $to     = $request->to_date;

            $barangMasuk    = new BarangMasuk();
            // dd($request->all());
            if ($from != null && $to != null) {
                $result     = $barangMasuk->getReportBarangMasuk($from, $to);
                return view('pages.reports.print-masuk', ['title' => $title, 'data' => $result, 'from' => $from, 'to' => $to]);
            } elseif ($from != null && $to == null) {
                $result     = $barangMasuk->getReportBarangMasuk($from, $to);

                return view('pages.reports.print-masuk', ['title' => $title, 'data' => $result[0], 'from' => $from, 'to' => $result[2]]);
            } elseif ($from == null && $to != null) {
                $result     = $barangMasuk->getReportBarangMasuk($from, $to);
                return view('pages.reports.print-masuk', ['title' => $title, 'data' => $result[0], 'from' => $result[1], 'to' => $to]);
            }
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
}
