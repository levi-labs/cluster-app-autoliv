@extends('layouts.main')
@section('content')
    <style>
        .null-input {
            display: none;
        }
    </style>
    <section id="basic-horizontal-layouts">
        <div class="row match-height justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if (session()->has('failed'))
                            <div class="alert alert-warning text-dark">{{ session('failed') }}</div>
                        @endif

                        <div class="alert alert-danger text-dark null-input">field Dari / Sampai is required</div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="my-form" class="form form-horizontal" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="tanggal_masuk">Dari</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="from_date" class="form-control" name="from_date"
                                                placeholder="Pcs/Unit/Karton/Kg">
                                            @error('from_date')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal_masuk">Sampai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="to_date" class="form-control" name="to_date"
                                                placeholder="Pcs/Unit/Karton/Kg">
                                            @error('to_date')
                                                <span class="text-sm text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="button" class="btn btn-light me-1 mb-1"
                                                onclick="clearButton()">Reset</button>
                                            <button onclick="checkValue()" type="submit"
                                                class="btn btn-dark me-1 mb-1">Submit</button>
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
    <script>
        function clearButton() {
            location.reload();
        }

        function checkValue() {
            input_from = document.getElementById('from_date').value;
            input_to = document.getElementById('to_date').value;
            showError = document.querySelector('.null-input');
            myForm = document.querySelector('#my-form');
            myForm.addEventListener('submit', function(e) {
                if (input_from == '' && input_to == '') {
                    showError.style.display = 'block';
                    e.preventDefault();
                } else if (input_from != '' || input_to != '') {
                    myForm.action = '/report-masuk/post-report-masuk';
                    myForm.target = '_blank';
                    showError.style.display = 'none';
                    e.currentTarget.submit();
                }
            });
        }
    </script>
@endsection
