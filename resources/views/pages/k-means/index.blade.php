@extends('layouts.main')
@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if (session()->has('failed'))
                            <div class="alert alert-warning text-dark">{{ session('failed') }}</div>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <form class="form form-horizontal" method="POST" action="{{ url('kmeans/import-file') }}"
                                autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <label for="satuan">Import file</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input class="form-control form-control-sm" id="formFileSm" type="file"
                                                name="document">
                                            @error('document')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-center">

                                            <button type="submit" class="btn btn-block btn-dark me-1 mb-1">Submit</button>
                                            {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @isset($data)
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="col-md-2 align-middle m-3">
                            <button type="button" class="btn btn-success text-white "
                                onclick="window.location.href='{{ url('kmeans/create-perhitungan') }}'"><i
                                    class="bi bi-calculator-fill"></i>Perhitungan
                                K-Means</button>
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
                            <div class="table-responsive p-2">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $dt)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>

                                                <td>{{ $dt->nama }}</td>
                                                <td>{{ $dt->penjualan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                {{ $data->onEachSide(5)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
@endsection
