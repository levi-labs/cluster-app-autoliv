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
                                <a class="btn btn-dark" href="{{ url('barang-masuk/create') }}">Tambah Data</a>
                            </p>
                        </div>
                        <!-- table bordered -->
                        <div class="table-responsive p-2">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang Masuk</th>
                                        <th>Nama Barang</th>
                                        <th>Qty Masuk</th>
                                        <th>Harga Beli</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $dt->kode_barang_masuk }}</td>
                                            <td>{{ $dt->barangs->nama }}</td>
                                            <td>{{ $dt->qty_masuk }}</td>
                                            <td>{{ $dt->harga_beli }}</td>
                                            <td>{{ $dt->tanggal_masuk }}</td>
                                            <td class="color-primary">
                                                <a class="btn btn-warning"
                                                    href="{{ url('barang-masuk/edit/' . $dt->id) }}">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="{{ url('barang-masuk/delete/' . $dt->id) }}">Delete</a>
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
