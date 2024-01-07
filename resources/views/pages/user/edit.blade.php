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
                                action="{{ url('user-management/update/' . $user->id) }}" autocomplete="off">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Username</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control"
                                                name="username" placeholder="" value="{{ $user->username }}">
                                            @error('username')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control"
                                                name="nama" placeholder="" value="{{ $user->nama }}">
                                            @error('nama')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Level</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select class="form-select" id="basicSelect" name="level">
                                                <option selected disabled>Pilih</option>
                                                <option {{ $user->level == 'Admin' ? 'selected' : '' }} value="Admin">Admin
                                                </option>
                                                <option {{ $user->level == 'Staf' ? 'selected' : '' }} value="Staf">Staf
                                                </option>
                                            </select>
                                            @error('level')
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
