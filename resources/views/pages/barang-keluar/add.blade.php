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

                            <form class="form form-horizontal" method="POST" action="{{ url('barang-keluar/store') }}"
                                autocomplete="off">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Kode Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control"
                                                name="kode_barang_keluar" placeholder="" value="{{ $kode }}">
                                            @error('kode_barang_keluar')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="quantity_keluar">Quantity Keluar</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="quantity_keluar" class="form-control"
                                                name="quantity_keluar" min="0">
                                            @error('quantity_keluar')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="barang">Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">

                                            <select class="form-select" id="barang" name="barang_id">
                                                <option selected disabled>Pilih</option>
                                                @foreach ($barang as $brg)
                                                    <option value="{{ $brg->id }}">{{ $brg->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('barang_id')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="harga_jual">Harga Jual</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="harga_jual" class="form-control" name="harga_jual"
                                                placeholder="0" min="0">
                                            @error('harga_jual')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal_keluar">Tanggal Keluar</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="tanggal_keluar" class="form-control"
                                                name="tanggal_keluar" placeholder="Pcs/Unit/Karton/Kg">
                                            @error('tanggal_keluar')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="window.location.href='{{ url('barang-keluar/index') }}'">Kembali</button>
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
