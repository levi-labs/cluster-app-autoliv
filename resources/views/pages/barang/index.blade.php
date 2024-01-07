@extends('layouts.main')
@section('content')
    <div class="page-heading">
        <h3>{{ $title }}</h3>
    </div>
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">

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
                        <div class="card-body">
                            <p class="card-text">
                                <a class="btn btn-dark" href="{{ url('barang/create') }}">Tambah Data</a>
                            </p>
                        </div>
                        <!-- table bordered -->
                        <div class="table-responsive p-2">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Stock</th>
                                        <th>Satuan</th>
                                        <th class="text-center">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $dt->kode_barang }}</td>
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->kategoris->nama }}</td>
                                            <td>{{ $dt->stock }}</td>
                                            <td>{{ $dt->satuan }}</td>
                                            <td class="color-primary text-center">
                                                <a class="btn btn-info"
                                                    href="{{ url('barang/show/' . $dt->id) }}">Detail</a>
                                                <a class="btn btn-warning"
                                                    href="{{ url('barang/edit/' . $dt->id) }}">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="{{ url('barang/delete/' . $dt->id) }}">Delete</a>
                                            </td>
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
@endsection
