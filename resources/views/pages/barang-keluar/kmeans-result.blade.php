@extends('layouts.main')
@section('content')
    @php
        function numFormats($value)
        {
            return number_format($value, 3, '.', ',');
        }
    @endphp
    <section class="section" id="section1">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="col-md-2 align-middle m-3">
                        <button type="button" class="btn btn-info text-white " onclick="window.location.href='#section2'"><i
                                class="bi bi-fast-forward-btn-fill"></i></button>
                    </div>

                    <div class="card-header">
                        @if ($errors->has('document'))
                            <span class="alert alert-danger" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success text-dark">{{ session('success') }}</div>
                        @endif
                        @if (session()->has('failed'))
                            <div class="alert alert-warning text-dark">{{ session('failed') }}</div>
                        @endif
                    </div>
                    <div class="card-content">

                        <!-- table bordered -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-sm text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Centeroid 1 | C1</th>
                                                <th>Centeroid 2 | C2</th>
                                                <th>Terdekat</th>
                                                <th>Cluster</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">

                                            @php
                                                // dd($result);
                                                $no = 0;
                                                $count_c1 = 0;
                                                $count_c2 = 0;
                                            @endphp
                                            @foreach ($result[0][0] as $key => $valued)
                                                <tr>
                                                    <td>{{ $no += 1 }}</td>

                                                    @if ($valued[0][0] == $valued[0][2])
                                                        <td class="table-primary fw-bolder">{{ $valued[0][0] }}</td>
                                                    @else
                                                        <td>{{ $valued[0][0] }}</td>
                                                    @endif
                                                    @if ($valued[0][1] == $valued[0][2])
                                                        <td class="table-warning fw-bolder">{{ $valued[0][1] }}</td>
                                                    @else
                                                        <td>{{ $valued[0][1] }}</td>
                                                    @endif
                                                    @if ($valued[0][0] == $valued[0][2])
                                                        <td class="table-primary fw-bolder">{{ $valued[0][2] }}</td>
                                                    @elseif ($valued[0][1] == $valued[0][2])
                                                        <td class="table-warning fw-bolder">{{ $valued[0][2] }}
                                                        </td>
                                                    @endif
                                                    @if ($valued[0][3] == 'C1')
                                                        @php
                                                            $count_c1 += 1;
                                                        @endphp
                                                        <td class="table-primary fw-bolder">{{ $valued[0][3] }}
                                                        </td>
                                                    @elseif ($valued[0][3] == 'C2')
                                                        @php
                                                            $count_c2 += 1;
                                                        @endphp
                                                        <td class="table-warning fw-bolder">{{ $valued[0][3] }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    {{-- {{ $data->onEachSide(5)->links() }} --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-sm text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Penjualan</th>
                                                <th>Rata-rata</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">

                                            @php
                                                $no2 = 0;
                                            @endphp
                                            @foreach ($result[2] as $vkey => $vvalue)
                                                <tr>
                                                    <td>{{ $no2 += 1 }}</td>
                                                    <td>{{ $vvalue[0] }}</td>
                                                    <td>{{ $vvalue[1] }}</td>
                                                    <td>{{ $vvalue[2] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <tbody class="text-center">
                                            <tr>

                                                <th>Total C1</th>
                                                <th>Anggota Produk</th>
                                                <th>Total C2</th>
                                                <th>Anggota Produk</th>
                                            </tr>

                                            <tr class="text-sm">
                                                <th rowspan="5" class="align-middle">{{ $count_c1 }}</th>
                                                <td>
                                                    @foreach ($result[0][1] as $c_1 => $c)
                                                        {{ $c[1] . ',' }}
                                                    @endforeach
                                                </td>
                                                <th rowspan="5" class="align-middle">{{ $count_c2 }}</th>
                                                <td>
                                                    @foreach ($result[0][2] as $c_2 => $cc)
                                                        {{ $cc[1] . ',' }}
                                                    @endforeach
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <tbody class="text-center">
                                            <tr>

                                                <th>Total C1</th>
                                                <th>Anggota Produk</th>
                                                <th>Total C2</th>
                                                <th>Anggota Produk</th>
                                            </tr>
                                            @php
                                                $sum_1 = 0;
                                                $sum_2 = 0;
                                            @endphp

                                            <tr class="text-sm">
                                                <th rowspan="5" class="align-middle">{{ $count_c1 }}</th>
                                                <td>
                                                    @foreach ($result[0][1] as $c_1 => $c)
                                                        {{ $c[0] . ',' }}
                                                        @php
                                                            $sum_1 += $c[0];
                                                        @endphp
                                                    @endforeach
                                                </td>
                                                <th rowspan="5" class="align-middle">{{ $count_c2 }}</th>
                                                <td>
                                                    @foreach ($result[0][2] as $c_2 => $cc)
                                                        {{ $cc[0] . ',' }}
                                                        @php
                                                            $sum_2 += $cc[0];
                                                        @endphp
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ $sum_1 }}</td>
                                                <td>{{ $sum_2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $sum_1 . ' / ' . $count_c1 . ' = ' . $sum_1 / $count_c1 }}</td>
                                                <td>{{ $sum_2 . ' / ' . $count_c2 . ' = ' . $sum_2 / $count_c2 }}</td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="height: 550px;">
                                    <canvas id="myChart" width="844" height="200"
                                        style="display: block; box-sizing: border-box; height: 211px; width: 422px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ----------------------------------- END ITERASI 1 ----------------------------------- --}}

    {{-- ----------------------------------- START ITERASI 2 ----------------------------------- --}}
    <section class="section" id="section2">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="col-md-2 align-middle m-3">
                        <button type="button" class="btn btn-info text-white "
                            onclick="window.location.href='#section1'"><i class="bi bi-skip-backward-btn-fill"></i></button>
                        <button type="button" class="btn btn-info text-white "
                            onclick="window.location.href='#section3'"><i class="bi bi-fast-forward-btn-fill"></i></button>
                    </div>

                    <div class="card-header">
                        @if ($errors->has('document'))
                            <span class="alert alert-danger" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success text-dark">{{ session('success') }}</div>
                        @endif
                        @if (session()->has('failed'))
                            <div class="alert alert-warning text-dark">{{ session('failed') }}</div>
                        @endif
                    </div>
                    <div class="card-content">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-sm text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Centeroid 1 | C1</th>
                                                <th>Centeroid 2 | C2</th>
                                                <th>Terdekat</th>
                                                <th>Cluster</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">

                                            @php
                                                // dd($result[1][0][0]);
                                                $noIterasi2 = 0;
                                                $count_Iterasi2c1 = 0;
                                                $count_Iterasi2c2 = 0;
                                            @endphp
                                            @foreach ($result[1][0][0] as $vkn => $vnew)
                                                <tr>
                                                    <td>{{ $noIterasi2 += 1 }}</td>

                                                    @if ($vnew[0] == $vnew[2])
                                                        <td class="table-primary fw-bolder">{{ $vnew[0] }}</td>
                                                    @else
                                                        <td>{{ $vnew[0] }}</td>
                                                    @endif
                                                    @if ($vnew[1] == $vnew[2])
                                                        <td class="table-warning fw-bolder">{{ $vnew[1] }}</td>
                                                    @else
                                                        <td>{{ $vnew[1] }}</td>
                                                    @endif
                                                    @if ($vnew[0] == $vnew[2])
                                                        <td class="table-primary fw-bolder">
                                                            {{ $vnew[2] }}
                                                        </td>
                                                    @elseif ($vnew[1] == $vnew[2])
                                                        <td class="table-warning fw-bolder">
                                                            {{ $vnew[2] }}
                                                        </td>
                                                    @endif
                                                    @if ($vnew[3] == 'C1')
                                                        @php
                                                            $count_Iterasi2c1 += 1;
                                                        @endphp
                                                        <td class="table-primary fw-bolder">{{ $vnew[3] }}
                                                        </td>
                                                    @elseif ($vnew[3] == 'C2')
                                                        @php
                                                            $count_Iterasi2c2 += 1;
                                                        @endphp
                                                        <td class="table-warning fw-bolder">{{ $vnew[3] }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-sm text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Penjualan</th>
                                                <th>Rata-rata</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">

                                            @php
                                                $no2 = 0;
                                            @endphp
                                            @foreach ($result[2] as $vkey => $vvalue2)
                                                <tr>
                                                    <td>{{ $no2 += 1 }}</td>
                                                    <td>{{ $vvalue2[0] }}</td>
                                                    <td>{{ $vvalue2[1] }}</td>
                                                    <td>{{ $vvalue2[2] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <tbody class="text-center">
                                            <tr>

                                                <th>Total C1</th>
                                                <th>Anggota Produk</th>
                                                <th>Total C2</th>
                                                <th>Anggota Produk</th>
                                            </tr>

                                            <tr class="text-sm">
                                                {{-- @php
                                                    dd($result[1][3][0]);
                                                @endphp --}}
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi2c1 }}</th>
                                                <td>
                                                    @foreach ($result[1][3][0] as $nnc_1 => $nnc)
                                                        {{ $nnc[1] . ',' }}
                                                    @endforeach
                                                </td>
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi2c2 }}</th>
                                                <td>
                                                    @foreach ($result[1][4][0] as $nnc_2 => $nnc)
                                                        {{ $nnc[1] . ',' }}
                                                    @endforeach
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <tbody class="text-center">
                                            <tr>

                                                <th>Total C1</th>
                                                <th>Anggota Produk</th>
                                                <th>Total C2</th>
                                                <th>Anggota Produk</th>
                                            </tr>
                                            @php
                                                $sum_2c1 = 0;
                                                $sum_2c2 = 0;
                                                // dd($result);
                                            @endphp

                                            <tr class="text-sm">
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi2c1 }}</th>
                                                <td>

                                                    @foreach ($result[1][3][1] as $nc_1 => $nc1)
                                                        {{ numFormats($nc1[0]) . ',' }}
                                                        @php
                                                            // dd($newClusterss);
                                                            $sum_2c1 += $nc1[0];
                                                        @endphp
                                                    @endforeach
                                                </td>
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi2c2 }}</th>
                                                <td>
                                                    @foreach ($result[1][4][1] as $nc_2 => $nc2)
                                                        {{ numFormats($nc2[0]) . ',' }}
                                                        @php
                                                            $sum_2c2 += $nc2[0];
                                                        @endphp
                                                    @endforeach
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>{{ numFormats($sum_2c1) }}</td>
                                                <td>{{ numFormats($sum_2c2) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ numFormats($sum_2c1) . ' / ' . $count_Iterasi2c1 . ' = ' . numFormats($sum_2c1 / $count_Iterasi2c1) }}
                                                </td>
                                                <td>{{ numFormats($sum_2c2) . ' / ' . $count_Iterasi2c2 . ' = ' . numFormats($sum_2c2 / $count_Iterasi2c2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="height: 550px;">
                                    <canvas id="myChart2" width="844" height="200"
                                        style="display: block; box-sizing: border-box; height: 211px; width: 422px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ----------------------------------- START ITERASI 3 ----------------------------------- --}}
    <section class="section" id="section3">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="col-md-2 align-middle m-3">
                        <button type="button" class="btn btn-info text-white "
                            onclick="window.location.href='#section2'"><i
                                class="bi bi-skip-backward-btn-fill"></i></button>
                        <button type="button" class="btn btn-info text-white "
                            onclick="window.location.href='#section3'"><i
                                class="bi bi-fast-forward-btn-fill"></i></button>
                    </div>

                    <div class="card-header">
                        @if ($errors->has('document'))
                            <span class="alert alert-danger" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success text-dark">{{ session('success') }}</div>
                        @endif
                        @if (session()->has('failed'))
                            <div class="alert alert-warning text-dark">{{ session('failed') }}</div>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-sm text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Centeroid 1 | C1</th>
                                                <th>Centeroid 2 | C2</th>
                                                <th>Terdekat</th>
                                                <th>Cluster</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">

                                            @php
                                                $noIterasi3 = 0;
                                                $count_Iterasi3c1 = 0;
                                                $count_Iterasi3c2 = 0;
                                            @endphp
                                            @foreach ($result[1][0][1] as $vkn => $vnew)
                                                <tr>
                                                    <td>{{ $noIterasi3 += 1 }}</td>

                                                    @if ($vnew[0] == $vnew[2])
                                                        <td class="table-primary fw-bolder">{{ numFormats($vnew[0]) }}
                                                        </td>
                                                    @else
                                                        <td>{{ numFormats($vnew[0]) }}</td>
                                                    @endif
                                                    @if ($vnew[1] == $vnew[2])
                                                        <td class="table-warning fw-bolder">{{ numFormats($vnew[1]) }}
                                                        </td>
                                                    @else
                                                        <td>{{ numFormats($vnew[1]) }}</td>
                                                    @endif
                                                    @if ($vnew[0] == $vnew[2])
                                                        <td class="table-primary fw-bolder">{{ numFormats($vnew[2]) }}
                                                        </td>
                                                    @elseif ($vnew[1] == $vnew[2])
                                                        <td class="table-warning fw-bolder">{{ numFormats($vnew[2]) }}
                                                        </td>
                                                    @endif
                                                    @if ($vnew[3] == 'C1')
                                                        @php
                                                            $count_Iterasi3c1 += 1;
                                                        @endphp
                                                        <td class="table-primary fw-bolder">{{ $vnew[3] }}
                                                        </td>
                                                    @elseif ($vnew[3] == 'C2')
                                                        @php
                                                            $count_Iterasi3c2 += 1;
                                                        @endphp
                                                        <td class="table-warning fw-bolder">{{ $vnew[3] }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <thead class="text-sm text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Penjualan</th>
                                                <th>Rata-rata</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-sm text-center">

                                            @php
                                                $no2 = 0;
                                            @endphp
                                            @foreach ($result[2] as $vkey => $vvalue3)
                                                <tr>
                                                    <td>{{ $no2 += 1 }}</td>
                                                    <td>{{ $vvalue3[0] }}</td>
                                                    <td>{{ $vvalue3[1] }}</td>
                                                    <td>{{ $vvalue3[2] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <tbody class="text-center">
                                            <tr>

                                                <th>Total C1</th>
                                                <th>Anggota Produk</th>
                                                <th>Total C2</th>
                                                <th>Anggota Produk</th>
                                            </tr>

                                            <tr class="text-sm">
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi3c1 }}</th>
                                                <td>
                                                    @foreach ($result[1][3][1] as $nnc_1 => $nnc)
                                                        {{ $nnc[1] . ',' }}
                                                    @endforeach
                                                </td>
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi2c2 }}</th>
                                                <td>
                                                    @foreach ($result[1][4][1] as $nnc_2 => $nnc)
                                                        {{ $nnc[1] . ',' }}
                                                    @endforeach
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered mb-0">
                                        <tbody class="text-center">
                                            <tr>

                                                <th>Total C1</th>
                                                <th>Anggota Produk</th>
                                                <th>Total C2</th>
                                                <th>Anggota Produk</th>
                                            </tr>
                                            @php
                                                $sum_3c1 = 0;
                                                $sum_3c2 = 0;
                                            @endphp

                                            <tr class="text-sm">
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi3c1 }}</th>
                                                <td>

                                                    @foreach ($result[1][3][1] as $nc_1 => $nc1)
                                                        {{ numFormats($nc1[0]) . ',' }}
                                                        @php
                                                            // dd($newClusterss);
                                                            $sum_3c1 += $nc1[0];
                                                        @endphp
                                                    @endforeach
                                                </td>
                                                <th rowspan="5" class="align-middle">{{ $count_Iterasi3c2 }}</th>
                                                <td>
                                                    @foreach ($result[1][4][1] as $nc_2 => $nc2)
                                                        {{ numFormats($nc2[0]) . ',' }}
                                                        @php
                                                            $sum_3c2 += $nc2[0];
                                                        @endphp
                                                    @endforeach
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>{{ numFormats($sum_3c1) }}</td>
                                                <td>{{ numFormats($sum_3c2) }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{ numFormats($sum_3c1) . ' / ' . $count_Iterasi3c1 . ' = ' . numFormats($sum_3c1 / $count_Iterasi3c1) }}
                                                </td>
                                                <td>{{ numFormats($sum_3c2) . ' / ' . $count_Iterasi3c2 . ' = ' . numFormats($sum_3c2 / $count_Iterasi3c2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="height: 550px;">
                                    <canvas id="myChart3" width="844" height="200"
                                        style="display: block; box-sizing: border-box; height: 211px; width: 422px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ----------------------------------- END ITERASI 3 ----------------------------------- --}}


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const ctx2 = document.getElementById('myChart2');
        const ctx3 = document.getElementById('myChart3');

        new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['Cluster_1', 'Cluster_2'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{!! json_encode($count_c1) !!}, {!! json_encode($count_c2) !!}],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)',
                        'rgb(54, 162, 235)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        new Chart(ctx2, {
            type: 'polarArea',
            data: {
                labels: ['Cluster_1', 'Cluster_2'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{!! json_encode($count_Iterasi2c1) !!}, {!! json_encode($count_Iterasi2c2) !!}],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)',
                        'rgb(54, 162, 235)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        new Chart(ctx3, {
            type: 'polarArea',
            data: {
                labels: ['Cluster_1', 'Cluster_2'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{!! json_encode($count_Iterasi2c1) !!}, {!! json_encode($count_Iterasi2c2) !!}],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)',
                        'rgb(54, 162, 235)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
