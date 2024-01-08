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
                                        Lihat Data Calon Siswa
                                    </h4>
                                </div>
                            </div>

                            <hr>

                            @if ($tUser->data)

                                <img src="{{ $tUser->photo ? asset($tUser->photo) : asset('img/logo.png') }}" style="width: 200px" alt="">

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Surat Keterangan</h5>
                                <h4><a target="_blank" href="{{ asset($tUser->data->surat_keterangan) }}">Buka</a></h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Kartu Keluarga</h5>
                                <h4><a target="_blank" href="{{ asset($tUser->data->kartu_keluarga) }}">Buka</a></h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Akte Lahir</h5>
                                <h4><a target="_blank" href="{{ asset($tUser->data->akte_lahir) }}">Buka</a></h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nama Lengkap</h5>
                                <h4>{{ $tUser->name }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Tempat Lahir</h5>
                                <h4>{{ $tUser->data->tempat_lahir }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Tanggal Lahir</h5>
                                <h4>{{ $tUser->data->tanggal_lahir }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Jenis Kelamin</h5>
                                <h4>{{ $tUser->data->jenis_kelamin }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Agama</h5>
                                <h4>{{ $tUser->data->agama }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Status Dalam Keluarga</h5>
                                <h4>{{ $tUser->data->status_dalam_keluarga }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Anak Ke</h5>
                                <h4>{{ $tUser->data->anak_ke }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Alamat</h5>
                                <h4>{{ $tUser->data->alamat }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nomor Telepon</h5>
                                <h4>{{ $tUser->data->nomor_telepon }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Sekolah Asal</h5>
                                <h4>{{ $tUser->data->sekolah_asal }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nama Ayah</h5>
                                <h4>{{ $tUser->data->nama_ayah }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Pekerjaan Ayah</h5>
                                <h4>{{ $tUser->data->pekerjaan_ayah }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nama Ibu</h5>
                                <h4>{{ $tUser->data->nama_ibu }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Pekerjaan Ibu</h5>
                                <h4>{{ $tUser->data->pekerjaan_ibu }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Alamat Orang Tua</h5>
                                <h4>{{ $tUser->data->alamat_orang_tua }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nomor Telepon Orang Tua</h5>
                                <h4>{{ $tUser->data->nomor_telepon_orang_tua }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nama Wali</h5>
                                <h4>{{ $tUser->data->nama_wali }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nama Wali</h5>
                                <h4>{{ $tUser->data->nama_wali }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Alamat Wali</h5>
                                <h4>{{ $tUser->data->alamat_wali }}</h4>

                                <hr>
                                <h5 class="p-0 m-0" class="text-muted">Nomor Telepon Wali</h5>
                                <h4>{{ $tUser->data->nomor_telepon_wali }}</h4>

                            @endif
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
