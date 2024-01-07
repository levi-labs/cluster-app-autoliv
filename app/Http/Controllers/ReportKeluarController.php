<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class ReportKeluarController extends Controller
{
    public function index(Request $request)
    {
        $title    = 'Form Report Keluar';

        return view('pages.reports.report-keluar', ['title' => $title]);
    }

    public function sendReportKeluar(Request $request)
    {
        try {
            $title  = 'Report Barang Keluar';
            $from   = $request->dari;
            $to     = $request->to;

            $barangKeluar    = new BarangKeluar();
            if ($from != null && $to != null) {
                $result     = $barangKeluar->getReportBarangKeluar($from, $to);
                return view('pages.reports.print-keluar', ['title' => $title, 'data' => $result, 'from' => $from, 'to' => $to]);
            } elseif ($from != null && $to == null) {
                $result     = $barangKeluar->getReportBarangKeluar($from, $to);

                return view('pages.reports.print-keluar', ['title' => $title, 'data' => $result[0], 'from' => $from, 'to' => $result[2]]);
            } elseif ($from == null && $to != null) {
                $result     = $barangKeluar->getReportBarangKeluar($from, $to);
                return view('pages.reports.print-keluar', ['title' => $title, 'data' => $result[0], 'from' => $result[1], 'to' => $to]);
            }
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
}
