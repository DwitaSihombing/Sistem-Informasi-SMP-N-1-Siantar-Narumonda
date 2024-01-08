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
                                    Tambah Data Pengguna
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">

                                <form action="{{ route('admin.user.add') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="0">Calon Siswa</option>
                                            <option value="1">Siswa</option>
                                            <option value="2">Guru</option>
                                            <option value="3">Tata Usaha</option>
                                            <option value="4">Admin</option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <strong>Kata sandi default: psi07</strong>
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
