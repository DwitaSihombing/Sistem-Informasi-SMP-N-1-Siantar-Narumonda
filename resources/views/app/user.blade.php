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
                                    Ubah Photo Profil
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <form action="{{ route('user.edit.photo') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <img src="{{ asset($user->photo) }}" style="width: 250px" alt="">
                                <br>
                                <label for="photo" class="form-label">Pilih Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                @error('photo')
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

                <div class="card mb-5">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h4 class="mb-3">
                                    Ubah Data Akun
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <form action="{{ route('user.edit.account') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}">
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}">
                                @error('email')
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

                <div class="card mb-5">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h4 class="mb-3">
                                    Ubah Kata Sandi
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <form action="{{ route('user.edit.password') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="old_password" class="form-label">Kata Sandi Lama</label>
                                <input type="password" class="form-control" id="old_password" name="old_password">
                                @error('old_password')
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

                @if($user->role == 0)
                <div class="card mb-5">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h4 class="mb-3">
                                    Ubah Data Diri Lanjutan
                                </h4>
                            </div>
                        </div>

                        <hr>

                        @if ($user->data)
                                <form action="{{ route('user.edit.calon.siswa') }}" method="post">
                                    @csrf

                                    <label>Tempat Lahir*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('tempat_lahir') ?? $user->data->tempat_lahir }}" type="text"
                                            class="form-control" name="tempat_lahir"
                                            required />
                                        @error('tempat_lahir')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Tanggal Lahir*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('tanggal_lahir') ?? $user->data->tanggal_lahir }}"
                                            type="date" class="form-control"
                                            name="tanggal_lahir" required />
                                        @error('tanggal_lahir')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Jenis Kelamin*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option {{ $user->data->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                Laki-Laki</option>
                                            <option {{ $user->data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Agama*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <select name="agama" class="form-control" required>
                                            <option {{ $user->data->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option {{ $user->data->agama == 'Kristen Katolik' ? 'selected' : '' }}>
                                                Kristen Katolik</option>
                                            <option {{ $user->data->agama == 'Kristen Protestan' ? 'selected' : '' }}>
                                                Kristen Protestan</option>
                                            <option {{ $user->data->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option {{ $user->data->agama == 'Buddha' ? 'selected' : '' }}>Buddha
                                            </option>
                                        </select>
                                        @error('agama')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Status Dalam Keluarga*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <select name="status_dalam_keluarga" class="form-control" required>
                                            <option
                                                {{ $user->data->status_dalam_keluarga == 'Anak Kandung' ? 'selected' : '' }}>
                                                Anak Kandung</option>
                                            <option
                                                {{ $user->data->status_dalam_keluarga == 'Anak Angkat' ? 'selected' : '' }}>
                                                Anak Angkat</option>
                                        </select>
                                        @error('status_dalam_keluarga')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Anak Ke*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('anak_ke') ?? $user->data->anak_ke }}" type="number"
                                            min="1" class="form-control"  name="anak_ke" required />
                                        @error('anak_ke')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Alamat*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('alamat') ?? $user->data->alamat }}" type="text"
                                            class="form-control" name="alamat" required />
                                        @error('alamat')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nomor Telepon</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nomor_telepon') ?? $user->data->nomor_telepon }}"
                                            type="number" min="1" class="form-control"
                                            name="nomor_telepon" />
                                        @error('nomor_telepon')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Sekolah Asal</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('sekolah_asal') ?? $user->data->sekolah_asal }}"
                                            type="text" class="form-control"
                                            name="sekolah_asal" />
                                        @error('sekolah_asal')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nama Ayah</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama_ayah') ?? $user->data->nama_ayah }}" type="text"
                                            class="form-control" name="nama_ayah" />
                                        @error('nama_ayah')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Pekerjaan Ayah</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('pekerjaan_ayah') ?? $user->data->pekerjaan_ayah }}"
                                            type="text" class="form-control"
                                            name="pekerjaan_ayah" />
                                        @error('pekerjaan_ayah')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nama Ibu</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama_ibu') ?? $user->data->nama_ibu }}" type="text"
                                            class="form-control" name="nama_ibu" />
                                        @error('nama_ibu')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Pekerjaan Ibu</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('pekerjaan_ibu') ?? $user->data->pekerjaan_ibu }}"
                                            type="text" class="form-control"
                                            name="pekerjaan_ibu" />
                                        @error('pekerjaan_ibu')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Alamat Orang Tua</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('alamat_orang_tua') ?? $user->data->alamat_orang_tua }}"
                                            type="text" class="form-control"
                                            name="alamat_orang_tua" />
                                        @error('alamat_orang_tua')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nomor Telepon Orang Tua</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input
                                            value="{{ old('nomor_telepon_orang_tua') ?? $user->data->nomor_telepon_orang_tua }}"
                                            type="number" class="form-control"
                                            name="nomor_telepon_orang_tua" />
                                        @error('nomor_telepon_orang_tua')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nama Wali</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama_wali') ?? $user->data->nama_wali }}" type="text"
                                            class="form-control" name="nama_wali" />
                                        @error('nama_wali')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Alamat Wali</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('alamat_wali') ?? $user->data->alamat_wali }}" type="text"
                                            class="form-control" name="alamat_wali" />
                                        @error('alamat_wali')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nomor Telepon Wali</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input
                                            value="{{ old('nomor_telepon_wali') ?? $user->data->nomor_telepon_wali }}"
                                            type="number" class="form-control"
                                            name="nomor_telepon_wali" />
                                        @error('nomor_telepon_wali')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                                    </div>

                                </form>
                            @else
                                <form action="{{ route('user.edit.calon.siswa') }}" method="post">
                                    @csrf

                                    <label>Tempat Lahir*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('tempat_lahir') }}" type="text" class="form-control"
                                            name="tempat_lahir" required />
                                        @error('tempat_lahir')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Tanggal Lahir*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('tanggal_lahir') }}" type="date" class="form-control"
                                            name="tanggal_lahir" required />
                                        @error('tanggal_lahir')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Jenis Kelamin*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option selected value="" disabled>Pilih Jenis Kelamin</option>
                                            <option>Laki-Laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Agama*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <select name="agama" class="form-control" required>
                                            <option selected value="" disabled>Pilih Agama</option>
                                            <option>Islam</option>
                                            <option>Kristen Katolik</option>
                                            <option>Kristen Protestan</option>
                                            <option>Hindu</option>
                                            <option>Buddha</option>
                                        </select>
                                        @error('agama')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Status Dalam Keluarga*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <select name="status_dalam_keluarga" class="form-control" required>
                                            <option selected value="" disabled>Pilih Status Dalam Keluarga</option>
                                            <option>Anak Kandung</option>
                                            <option>Anak Angkat</option>
                                        </select>
                                        @error('status_dalam_keluarga')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Anak Ke*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('anak_ke') }}" type="number" min="1" class="form-control"
                                            name="anak_ke" required />
                                        @error('anak_ke')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Alamat*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('alamat') }}" type="text" class="form-control"
                                            name="alamat" required />
                                        @error('alamat')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nomor Telepon</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nomor_telepon') }}" type="number" min="1"
                                            class="form-control" name="nomor_telepon" />
                                        @error('nomor_telepon')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Sekolah Asal</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('sekolah_asal') }}" type="text" class="form-control"
                                            name="sekolah_asal" />
                                        @error('sekolah_asal')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nama Ayah</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama_ayah') }}" type="text" class="form-control"
                                            name="nama_ayah" />
                                        @error('nama_ayah')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Pekerjaan Ayah</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('pekerjaan_ayah') }}" type="text" class="form-control"
                                            name="pekerjaan_ayah" />
                                        @error('pekerjaan_ayah')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nama Ibu</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama_ibu') }}" type="text" class="form-control"
                                            name="nama_ibu" />
                                        @error('nama_ibu')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Pekerjaan Ibu</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('pekerjaan_ibu') }}" type="text" class="form-control"
                                            name="pekerjaan_ibu" />
                                        @error('pekerjaan_ibu')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Alamat Orang Tua</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('alamat_orang_tua') }}" type="text" class="form-control"
                                            name="alamat_orang_tua" />
                                        @error('alamat_orang_tua')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nomor Telepon Orang Tua</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nomor_telepon_orang_tua') }}" type="number"
                                            class="form-control" name="nomor_telepon_orang_tua" />
                                        @error('nomor_telepon_orang_tua')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nama Wali</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama_wali') }}" type="text" class="form-control"
                                            name="nama_wali" />
                                        @error('nama_wali')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Alamat Wali</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('alamat_wali') }}" type="text" class="form-control"
                                            name="alamat_wali" />
                                        @error('alamat_wali')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Nomor Telepon Wali</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nomor_telepon_wali') }}" type="number"
                                            class="form-control" name="nomor_telepon_wali" />
                                        @error('nomor_telepon_wali')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                                    </div>

                                </form>
                            @endif


                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-3">
                                    Ubah Berkas
                                </h4>
                            </div>
                        </div>

                        <hr>

                        <form action="{{ route('user.edit.calon.berkas') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="surat_keterangan" class="form-label">Surat Keterangan*
                                    <a href="{{ asset($user->data->surat_keterangan) }}" target="_blank">
                                        (Sebelumnya)
                                    </a>
                                </label>
                                <input type="file" class="form-control" id="surat_keterangan" name="surat_keterangan" required>
                                @error('surat_keterangan')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kartu_keluarga" class="form-label">Kartu Keluarga*
                                    <a href="{{ asset($user->data->kartu_keluarga) }}" target="_blank">
                                        (Sebelumnya)
                                    </a>
                                </label>
                                <input type="file" class="form-control" id="kartu_keluarga" name="kartu_keluarga" required>
                                @error('kartu_keluarga')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="akte_lahir" class="form-label">Akte Lahir*
                                    <a href="{{ asset($user->data->akte_lahir) }}" target="_blank">
                                        (Sebelumnya)
                                    </a>
                                </label>
                                <input type="file" class="form-control" id="akte_lahir" name="akte_lahir" required>
                                @error('akte_lahir')
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
                @endif

            </div>

        </div>
    </div>
@endsection
