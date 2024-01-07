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
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('user/update') }}" method="POST">
                            @csrf
                            <div class="form-group my-2">
                                <label for="old_password" class="form-label">Password Terakhir</label>
                                <input type="password" name="old_password" id="old_password" class="form-control"
                                    placeholder="Masukkan Password Terakhir">
                                @error('old_password')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="Masukkan Password Baru" value="">
                                @error('new_password')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Masukkan Konfirmasi Password Baru" value="">
                                @error('fail_password')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
