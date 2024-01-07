@extends('layouts.main')
@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back! John</h4>
                {{--                <p class="mb-0">Your business dashboard template</p>--}}
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('kategori/index')}}">Daftar Kategori</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Form Edit Kategori</a></li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session()->has('failed'))
                    <div class="alert alert-danger text-dark">{{session('failed')}}</div>
                @endif
                <div class="card-header">
                    <h4 class="card-title">Form Edit Kategori</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="{{url('kategori/update/' . $kategori->id)}}" autocomplete="off">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Katgeori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_kategori" placeholder="K-00001" value="{{$kategori->kode_kategori}}" readonly>
                                    @error('kode_kategori')
                                    <span class="text-sm text-danger mt-2">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" value="{{$kategori->nama}}">
                                    @error('nama')
                                    <span class="text-sm text-danger mt-2">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
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
