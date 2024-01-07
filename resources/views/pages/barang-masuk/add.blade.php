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

                            <form class="form form-horizontal" method="POST" action="{{ url('barang-masuk/store') }}"
                                autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Kode Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control"
                                                name="kode_barang" placeholder="" value="{{ $kode }}">
                                            @error('kode_barang')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="quantity_masuk">Quantity Masuk</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="quantity_masuk" class="form-control"
                                                name="quantity_masuk" placeholder="0" min="0">
                                            @error('quantity_masuk')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="barang">Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">

                                            <select class="form-select" id="barang" name="barang">
                                                <option selected disabled>Pilih</option>
                                                @foreach ($barang as $brg)
                                                    <option value="{{ $brg->id }}">{{ $brg->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('barang')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="harga_beli">Harga Beli</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="harga_beli" class="form-control" name="harga_beli"
                                                placeholder="0" min="0">
                                            @error('harga_beli')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="tanggal_masuk" class="form-control"
                                                name="tanggal_masuk" placeholder="Pcs/Unit/Karton/Kg">
                                            @error('tanggal_masuk')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="window.location.href='{{ url('barang-masuk/index') }}'">Kembali</button>
                                            <button type="submit" class="btn btn-dark me-1 mb-1">Submit</button>
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
@endsection
