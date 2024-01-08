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
                                    Ubah Data Ekstrakulikuler
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">

                                <form action="{{ route('guru.ekstrakulikuler.edit.post') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="ekstrakulikuler_id" value="{{ $ekstrakulikuler->id }}">

                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') ?? $ekstrakulikuler->judul }}">
                                        @error('judul')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="terbuka" class="form-label">Menerima Anggota?</label>
                                        <select class="form-control" name="terbuka" id="terbuka">
                                            <option {{ ($ekstrakulikuler->terbuka == 1) ? 'selected' : '' }} value="1">Ya</option>
                                            <option {{ $ekstrakulikuler->terbuka == 0 ? 'selected' : '' }} value="0">Tidak</option>
                                        </select>
                                        @error('terbuka')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5">{{ old('deskripsi') ?? $ekstrakulikuler->deskripsi }}</textarea>
                                        @error('deskripsi')
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
