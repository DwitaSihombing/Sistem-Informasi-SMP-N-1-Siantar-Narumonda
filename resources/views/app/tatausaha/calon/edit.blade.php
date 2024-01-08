@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 mb-5">

                @if ($tUser->role == 0)
                    <div class="card mb-5">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <h4 class="mb-3">
                                        Ubah Data Calon Siswa
                                    </h4>
                                </div>
                            </div>

                            <hr>

                            @if ($tUser->data)
                                <form action="{{ route('tatausaha.siswa.calon.edit.post') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                                    <input type="hidden" name="user_id" value="{{ $tUser->id }}">

                                    <label>Nama Lengkap*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama') ?? $tUser->name }}" type="text" class="form-control"
                                             name="nama" required />
                                        @error('nama')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <label>Tempat Lahir*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('tempat_lahir') ?? $tUser->data->tempat_lahir }}" type="text"
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
                                        <input value="{{ old('tanggal_lahir') ?? $tUser->data->tanggal_lahir }}"
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
                                            <option {{ $tUser->data->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                Laki-Laki</option>
                                            <option {{ $tUser->data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
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
                                            <option {{ $tUser->data->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option {{ $tUser->data->agama == 'Kristen Katolik' ? 'selected' : '' }}>
                                                Kristen Katolik</option>
                                            <option {{ $tUser->data->agama == 'Kristen Protestan' ? 'selected' : '' }}>
                                                Kristen Protestan</option>
                                            <option {{ $tUser->data->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option {{ $tUser->data->agama == 'Buddha' ? 'selected' : '' }}>Buddha
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
                                                {{ $tUser->data->status_dalam_keluarga == 'Anak Kandung' ? 'selected' : '' }}>
                                                Anak Kandung</option>
                                            <option
                                                {{ $tUser->data->status_dalam_keluarga == 'Anak Angkat' ? 'selected' : '' }}>
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
                                        <input value="{{ old('anak_ke') ?? $tUser->data->anak_ke }}" type="number"
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
                                        <input value="{{ old('alamat') ?? $tUser->data->alamat }}" type="text"
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
                                        <input value="{{ old('nomor_telepon') ?? $tUser->data->nomor_telepon }}"
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
                                        <input value="{{ old('sekolah_asal') ?? $tUser->data->sekolah_asal }}"
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
                                        <input value="{{ old('nama_ayah') ?? $tUser->data->nama_ayah }}" type="text"
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
                                        <input value="{{ old('pekerjaan_ayah') ?? $tUser->data->pekerjaan_ayah }}"
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
                                        <input value="{{ old('nama_ibu') ?? $tUser->data->nama_ibu }}" type="text"
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
                                        <input value="{{ old('pekerjaan_ibu') ?? $tUser->data->pekerjaan_ibu }}"
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
                                        <input value="{{ old('alamat_orang_tua') ?? $tUser->data->alamat_orang_tua }}"
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
                                            value="{{ old('nomor_telepon_orang_tua') ?? $tUser->data->nomor_telepon_orang_tua }}"
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
                                        <input value="{{ old('nama_wali') ?? $tUser->data->nama_wali }}" type="text"
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
                                        <input value="{{ old('alamat_wali') ?? $tUser->data->alamat_wali }}" type="text"
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
                                            value="{{ old('nomor_telepon_wali') ?? $tUser->data->nomor_telepon_wali }}"
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
                                <form action="{{ route('tatausaha.siswa.calon.edit.post') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">

                                    <input type="hidden" name="user_id" value="{{ $tUser->id }}">

                                    <label>Nama Lengkap*</label>
                                    <div class="mb-3 filled form-group tooltip-end-top">
                                        <i data-acorn-icon="edit"></i>
                                        <input value="{{ old('nama') ?? $tUser->name }}" type="text" class="form-control" name="nama"
                                            required />
                                        @error('nama')
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

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
                @endif

            </div>

        </div>
    </div>
@endsection
