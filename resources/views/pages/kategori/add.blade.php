@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">



            <div class="card">
                @if (session()->has('failed'))
                    <div class="alert alert-danger text-dark">{{ session('failed') }}</div>
                @endif
                <div class="card-header">


                    <h4 class="card-title">Form Add Kategori</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{ url('kategori/store') }}" autocomplete="off">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Katgeori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_kategori"
                                        value="{{ $kategori }}" readonly>
                                    @error('kode_kategori')
                                        <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" placeholder="">
                                    @error('nama')
                                        <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-end">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
