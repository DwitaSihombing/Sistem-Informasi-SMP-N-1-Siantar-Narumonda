@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 mb-5">
                <div class="card mb-5">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h4 class="mb-3">
                                    Tambah Data Pendaftaran
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">

                                <form action="{{ route('tatausaha.pendaftaran.add') }}" method="post">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                                        @error('judul')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_buka" class="form-label">Tanggal Buka</label>
                                        <input type="date" class="form-control" id="tanggal_buka" name="tanggal_buka" value="{{ old('tanggal_buka') }}">
                                        @error('tanggal_buka')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_tutup" class="form-label">Tanggal Tutup</label>
                                        <input type="date" class="form-control" id="tanggal_tutup" name="tanggal_tutup" value="{{ old('tanggal_tutup') }}">
                                        @error('tanggal_tutup')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                                    </div>

                                </form>


                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
