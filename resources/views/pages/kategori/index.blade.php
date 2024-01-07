@extends('layouts.main')
@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{ $title }}</h4>
                {{--                <p class="mb-0">Your business dashboard template</p> --}}
            </div>
        </div>

    </div>

    <div class="col-lg-12">
        <div class="card">
            @if (session()->has('success'))
                <div class="alert alert-success text-dark">{{ session('success') }}</div>
            @elseif (session()->has('failed'))
                <div class="alert alert-danger text-dark">{{ session('failed') }}</div>
            @endif
            <div class="card-header">
                <a href="{{ url('kategori/create') }}" class="btn btn-dark font-weight-bold">Tambah Data</a>
                {{--                <h4 class="card-title">Daftar Barang</h4> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm text-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $dt)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $dt->kode_kategori }}</td>
                                    <td>{{ $dt->nama }}</td>
                                    <td class="color-primary">
                                        <a class="btn btn-warning" href="{{ url('kategori/edit/' . $dt->id) }}">Edit</a>
                                        <a class="btn btn-danger" href="{{ url('kategori/delete/' . $dt->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
