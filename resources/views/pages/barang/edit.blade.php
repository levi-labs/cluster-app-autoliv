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
                            <form class="form form-horizontal" method="POST"
                                action="{{ url('barang/update/' . $barang->id) }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Kode Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control"
                                                name="kode_barang" placeholder="" value="{{ $barang->kode_barang }}">
                                            @error('kode_barang')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Nama Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="password-horizontal" class="form-control"
                                                name="nama" placeholder="" value="{{ $barang->nama }}">
                                            @error('nama')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email-horizontal">Kategori</label>
                                        </div>
                                        <div class="col-md-8 form-group">

                                            <select class="form-select" id="basicSelect" name="kategori">
                                                <option selected disabled>Pilih</option>
                                                @foreach ($kategori as $kt)
                                                    <option {{ $barang->kategori_id == $kt->id ? 'selected' : '' }}
                                                        value="{{ $kt->id }}">{{ $kt->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Stock</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="contact-info-horizontal" class="form-control"
                                                name="stock" placeholder="0" min="0" value="{{ $barang->stock }}">
                                            @error('stock')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="satuan">Satuan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="satuan" class="form-control" name="satuan"
                                                value="{{ $barang->satuan }}" placeholder="Pcs/Unit/Karton/Kg">
                                            @error('satuan')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="satuan">Foto Barang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input class="form-control form-control-sm" id="formFileSm" type="file"
                                                name="foto_barang"> <span class="text-danger text-sm">
                                                {{ $barang->foto_barang }}</span>
                                            @error('foto_barang')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="window.location.href='{{ url('barang/index') }}'">Kembali</button>
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
