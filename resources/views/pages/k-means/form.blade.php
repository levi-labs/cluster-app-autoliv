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

                            <form class="form form-horizontal" method="POST" action="{{ url('kmeans/proses-perhitungan') }}"
                                autocomplete="off">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-5">
                                            <label hidden for="contact-info-horizontal">Jumlah iterasi</label>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <input type="hidden" id="contact-info-horizontal" class="form-control"
                                                name="iterasi" placeholder="0" min="0" value="2">
                                            @error('iterasi')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-5">
                                            <label for="contact-info-horizontal">Nilai pembagi</label>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <input type="number" id="contact-info-horizontal" class="form-control"
                                                name="divide" placeholder="0" min="0">
                                            @error('divide')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-center">

                                            <button type="submit" class="btn btn-block btn-dark me-1 mb-1">Submit</button>
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
