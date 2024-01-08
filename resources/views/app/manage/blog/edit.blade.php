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
                                    Ubah Data Blog
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">

                                <form action="{{ route('manage.blog.edit.post') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $blog->id }}">

                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input value="{{ old('judul') ?? $blog->judul }}" type="text" class="form-control" id="judul" name="judul">
                                        @error('judul')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <img src="{{ asset($blog->cover) }}" style="height: 300px">
                                        <br>
                                        <label for="cover" class="form-label">Cover</label>
                                        <input type="file" class="form-control" id="cover" name="cover">
                                        @error('cover')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="isi" class="form-label">Isi</label>
                                        <textarea class="form-control" name="isi" id="isi" rows="10">{{ old('isi') ?? $blog->isi }}</textarea>
                                        @error('isi')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <a href="{{ asset($blog->lampiran) }}">{{ $blog->lampiran }}</a>
                                        <br>
                                        <label for="lampiran" class="form-label">Lampiran (Optional)</label>
                                        <input type="file" class="form-control" id="lampiran" name="lampiran">
                                        @error('lampiran')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
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
