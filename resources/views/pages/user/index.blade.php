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
                                <a class="btn btn-dark" href="{{ url('user-management/create') }}">Tambah Data</a>
                            </p>
                        </div>
                        <!-- table bordered -->
                        <div class="table-responsive p-2">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>username</th>
                                        <th>nama</th>
                                        <th>level</th>
                                        <th class="text-center">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr class="text-center">
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $dt->username }}</td>
                                            <td>{{ $dt->nama }}</td>
                                            <td>{{ $dt->level }}</td>
                                            <td class="color-primary text-center">
                                                <a class="btn btn-primary"
                                                    href="{{ url('user-management/reset-password/' . $dt->id) }}">Reset
                                                    Password</a>
                                                <a class="btn btn-warning"
                                                    href="{{ url('user-management/edit/' . $dt->id) }}">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="{{ url('user-management/delete/' . $dt->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{-- {{ $data->onEachSide(5)->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
