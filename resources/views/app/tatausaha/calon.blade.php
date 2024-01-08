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
                                    Kelola Calon Siswa
                                    <br>
                                    <small class="text-muted">{{ $pendaftaran->judul }}</small>
                                    <br>
                                    <small class="text-muted">({{ date("d F Y", strtotime($pendaftaran->tanggal_buka)) }} sampai {{ date("d F Y", strtotime($pendaftaran->tanggal_tutup )) }})</small>
                                </h4>
                                <small>

                                </small>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a target="_blank" href="{{ route('tatausaha.siswa.calon.laporan', ['pendaftaran_id'=>$pendaftaran->id]) }}" class="btn btn-primary">Buat Laporan</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tanggal Mendaftar</th>
                                        <th scope="col">Data Diri</th>
                                        <th scope="col">Surat Keterangan</th>
                                        <th scope="col">Kartu Keluarga</th>
                                        <th scope="col">Akte Lahir</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($users as $key => $u)
                                        <tr>
                                            <th scope="row">{{ ($u->id) }}</th>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ date("d F Y - H:i:s", strtotime($u->created_at)) }}</td>
                                            <td>
                                                @if($u->data)
                                                    <span class="badge bg-success">Terdapat</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak</span>
                                                @endif
                                            </td>

                                            @if($u->data)
                                                <td>
                                                    @if($u->data->surat_keterangan)
                                                        <span class="badge bg-success">Terdapat</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($u->data->kartu_keluarga)
                                                        <span class="badge bg-success">Terdapat</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($u->data->akte_lahir)
                                                        <span class="badge bg-success">Terdapat</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak</span>
                                                    @endif
                                                </td>
                                            @else

                                            <td><span class="badge bg-danger">Tidak</span></td>
                                            <td><span class="badge bg-danger">Tidak</span></td>
                                            <td><span class="badge bg-danger">Tidak</span></td>


                                            @endif


                                            <td>
                                                @if($u->is_verified > 0)
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif($u->is_verified < 0)
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning">Butuh Diverifikasi</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($u->id != $user->id)
                                                    <a class="text-primary" target="_blank" href="{{ route('tatausaha.siswa.calon.view', ['user_id'=>$u->id, 'pendaftaran_id'=>$pendaftaran->id]) }}">Lihat</a>
                                                    <span class="px-1"></span>
                                                    <a class="text-warning" target="_blank" href="{{ route('tatausaha.siswa.calon.edit', ['user_id'=>$u->id, 'pendaftaran_id'=>$pendaftaran->id]) }}">Ubah</a>

                                                    @if($u->is_verified == 0)

                                                        <span class="px-1"></span>
                                                        <a class="text-success" onclick="return confirm('Yakin ingin menerima calon siswa ini?')" href="{{ route('tatausaha.siswa.calon.verification', ['user_id'=>$u->id, 'pendaftaran_id'=>$pendaftaran->id, 'action'=>1]) }}">Terima</a>
                                                        <span class="px-1"></span>
                                                        <a class="text-danger" onclick="return confirm('Yakin ingin menolak calon siswa ini?')" href="{{ route('tatausaha.siswa.calon.verification', ['user_id'=>$u->id, 'pendaftaran_id'=>$pendaftaran->id, 'action'=> -1]) }}">Tolak</a>

                                                    @elseif($u->is_verified == 1)

                                                        <span class="px-1"></span>
                                                        <a class="text-primary" onclick="return confirm('Yakin ingin mengubah pengguna ini menjadi siswa?')" href="{{ route('tatausaha.siswa.calon.verification', ['user_id'=>$u->id, 'pendaftaran_id'=>$pendaftaran->id, 'action'=> 99]) }}">Jadikan Siswa</a>

                                                    @endif


                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
