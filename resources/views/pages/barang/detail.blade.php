@extends('layouts.main')
@section('content')
    <div class="page-heading">
        <h3>{{ $title }}</h3>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Foto Barang</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <div class="col-6 col-sm-4 col-lg-4 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="#">
                                    <img class="w-100 active" src="{{ $barang->getFoto() }}"
                                        data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                </a>
                            </div>
                            <div class="col-8 col-sm-8 col-lg-8 mt-2 mt-md-0 mb-md-0 mb-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th colspan="5">{{ $barang->nama }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">Kode Barang</td>
                                                <td colspan="5">{{ $barang->kode_barang }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Stock</td>
                                                <td colspan="5">{{ $barang->stock }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Satuan</td>
                                                <td colspan="5">{{ $barang->satuan }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Kategori</td>
                                                <td colspan="5">{{ $barang->kategoris->nama }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
