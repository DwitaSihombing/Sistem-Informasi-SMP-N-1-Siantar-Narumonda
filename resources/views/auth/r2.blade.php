@extends('layouts.auth')

@section('content')
    <div class="sw-lg-50 px-5">
        <div class="sh-11">
            <a href="{{ route('index') }}">
                <div class="d-flex">
                    <img src="{{ asset('img/logo.png') }}" style="height: 55px" alt="">
                    <h4 class="pt-1 ps-2">SMP Negeri 1<br> Siantar Narumonda</h4>
                </div>
            </a>
        </div>

        <div class="mb-3">
            <h2 class="cta-1 text-primary">Daftar sebagai calon siswa!</h2>
        </div>

        <div>
            <form method="POST" action="{{ route('siswa.daftar') }}" enctype="multipart/form-data">
                @csrf

                <small>(*) wajib di isi!</small>
                <br>
                <br>

                <label>Surat Keterangan Lulus* <br> <small class="text-muted">(Ijazah SD/sederajat atau dokumen lain yang menyebutkan bahwa peserta didik sudah menyelesaikan kelas 6 SD)</small> </label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="image"></i>
                    <input type="file" class="form-control" name="surat_keterangan" required />
                    @error('surat_keterangan')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <label>Kartu Keluarga*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="image"></i>
                    <input type="file" class="form-control" name="kartu_keluarga" required />
                    @error('kartu_keluarga')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <label>Akte Lahir*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="image"></i>
                    <input type="file" class="form-control" name="akte_lahir" required />
                    @error('akte_lahir')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <label>Nama Lengkap*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('nama') }}" type="text" class="form-control" name="nama" required />
                    @error('nama')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <label>Tempat Lahir*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('tempat_lahir') }}" type="text"
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
                    <input value="{{ old('tanggal_lahir') }}"
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
                    <input value="{{ old('anak_ke') }}" type="number"
                        min="1" class="form-control" name="anak_ke" required />
                    @error('anak_ke')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Alamat*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('alamat') }}" type="text"
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
                    <input value="{{ old('nomor_telepon') }}"
                        type="number" min="1" class="form-control"
                        name="nomor_telepon" />
                    @error('nomor_telepon')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Sekolah Asal*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('sekolah_asal') }}"
                        type="text" class="form-control"
                        name="sekolah_asal" required />
                    @error('sekolah_asal')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Nama Ayah*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('nama_ayah') }}" type="text"
                        class="form-control" name="nama_ayah" required />
                    @error('nama_ayah')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Pekerjaan Ayah*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('pekerjaan_ayah') }}"
                        type="text" class="form-control"
                        name="pekerjaan_ayah" required />
                    @error('pekerjaan_ayah')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Nama Ibu*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('nama_ibu') }}" type="text"
                        class="form-control" name="nama_ibu" required />
                    @error('nama_ibu')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Pekerjaan Ibu*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('pekerjaan_ibu') }}"
                        type="text" class="form-control"
                        name="pekerjaan_ibu" required />
                    @error('pekerjaan_ibu')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Alamat Orang Tua*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('alamat_orang_tua') }}" required
                        type="text" class="form-control"
                        name="alamat_orang_tua" />
                    @error('alamat_orang_tua')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Nomor Telepon Orang Tua*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input
                        value="{{ old('nomor_telepon_orang_tua') }}"
                        type="number" class="form-control"
                        name="nomor_telepon_orang_tua" required />
                    @error('nomor_telepon_orang_tua')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Nama Wali</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="edit"></i>
                    <input value="{{ old('nama_wali') }}" type="text"
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
                    <input value="{{ old('alamat_wali') }}" type="text"
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
                        value="{{ old('nomor_telepon_wali') }}"
                        type="number" class="form-control"
                        name="nomor_telepon_wali" />
                    @error('nomor_telepon_wali')
                        <span class="text-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <label>Alamat Email*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="email"></i>
                    <input value="{{ old('email') }}" type="email" class="form-control"  name="email" required />
                    @error('email')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                </div>

                <label>Kata Sandi*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input type="password" class="form-control" name="password" required />
                    @error('password')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <label>Konfirmasi Kata Sandi*</label>
                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input type="password" class="form-control" name="password_confirmation" required />
                </div>

                <button type="submit" class="btn btn-lg btn-primary">
                    Daftar
                </button>

            </form>
        </div>
    </div>
@endsection
