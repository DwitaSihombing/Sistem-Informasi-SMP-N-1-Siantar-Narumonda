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
                                    Ubah Data Pengguna
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">

                                <form action="{{ route('admin.user.edit.post') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $tUser->id }}">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $tUser->name }}">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $tUser->email }}">
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            <option {{ ($tUser->role == 0) ? 'selected' : '' }} value="0">Calon Siswa</option>
                                            <option {{ ($tUser->role == 1) ? 'selected' : '' }} value="1">Siswa</option>
                                            <option {{ ($tUser->role == 2) ? 'selected' : '' }} value="2">Guru</option>
                                            <option {{ ($tUser->role == 3) ? 'selected' : '' }} value="3">Tata Usaha</option>
                                            <option {{ ($tUser->role == 4) ? 'selected' : '' }} value="4">Admin</option>
                                        </select>
                                        @error('role')
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
