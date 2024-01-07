@extends('report-layout.main')
@section('surat')
    <center>
        <h4>Laporan Barang Keluar</h4>
        <h4>Periode :
            {{ Carbon\Carbon::parse($from)->isoFormat('D MMMM Y') . ' - ' . Carbon\Carbon::parse($to)->isoFormat('D MMMM Y') }}
        </h4>
    </center>
    {{-- @php
        dd($data);
    @endphp --}}
    <div class="table-print">

        <button type="button" onclick="window.print()" class="btn">&nbsp;Print</button>
        <table class="table table-bordered d-print-table" style="border-collapse: collapse; border: 2px solid black;"
            border="2">
            <thead>
                <tr class="text-center">
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        No
                    </th>
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        Kode<br>
                        Barang Keluar
                    </th>
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        Nama<br>
                        Barang
                    </th>
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        Tanggal<br>
                        Keluar
                    </th>
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        Qty<br>
                        Keluar
                    </th>
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        Harga<br>
                        Jual
                    </th>
                    <th style="background-color: rgb(87, 102, 172); color:white;" class="text-center top-th" rowspan="2">
                        Sub<br>
                        Total
                    </th>

                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp

                @foreach ($data as $dt)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->kode_barang_keluar }}</td>
                        <td>{{ $dt->barangs->nama }}</td>
                        <td>{{ $dt->tanggal_keluar }}</td>
                        <td>{{ $dt->qty_masuk }}</td>
                        <td>@currency($dt->harga_jual)</td>
                        <td>@currency($dt->harga_jual * $dt->qty_keluar)</td>
                        @php
                            $total += $dt->harga_beli;
                        @endphp

                    </tr>
                @endforeach
                <style>
                    .text-right {
                        text-align: center;
                        padding-right: 5px;
                    }
                </style>
                <tr>
                    <td class="text-right" colspan="6">Total </td>
                    <td class="text-center">@currency($total)</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <style>
            .space-ttd {
                width: 1000px;
            }

            .ttd-row {
                width: 100%;
            }
        </style>
        <table class="ttd-row">
            <tr>
                <td style="text-align: center">
                    {{-- <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br> --}}
                    <br>
                    <br><br><br>
                    {{-- <p>Dikirim</p>, --}}
                    <br><br><br>
                    <br>
                    {{-- <hr width="100px"> --}}
                </td>
                <td class="space-ttd"></td>
                <td style="text-align: center">
                    <b>Bekasi,<br><br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                    <br><br>
                    <p>Diterima</p>
                    <br><br><br>
                    <br>

                    <hr width="100px">
                </td>
            </tr>
        </table>
    </div>
@endsection
