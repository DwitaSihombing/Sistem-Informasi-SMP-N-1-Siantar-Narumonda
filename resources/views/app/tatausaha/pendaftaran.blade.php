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
                                    Kelola Pendaftaran
                                </h4>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a href="{{ route('tatausaha.pendaftaran.add') }}" class="btn btn-primary">Tambah Data</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Tanggal Buka</th>
                                        <th scope="col">Tanggal Tutup</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($pendaftaran as $key => $p)
                                        <tr>
                                            <th scope="row">{{ ($p->id) }}</th>
                                            <td>{{ $p->judul }}</td>
                                            <td>{{ date("d F Y", strtotime($p->tanggal_buka)) }}</td>
                                            <td>{{ date("d F Y", strtotime($p->tanggal_tutup)) }}</td>
                                            <td>
                                                @if(strtotime($p->tanggal_buka) <= strtotime(date("d F Y")) && strtotime($p->tanggal_tutup) >  strtotime(date("d F Y")))
                                                    <span class="badge bg-success">Buka</span>
                                                @else
                                                    <span class="badge bg-danger">Tutup</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="text-primary" href="{{ route('tatausaha.siswa.calon', ['pendaftaran_id'=>$p->id]) }}">Pendaftar</a>
                                                <span class="px-1"></span>
                                                <a class="text-warning" href="{{ route('tatausaha.pendaftaran.edit', ['pendaftaran_id'=>$p->id]) }}">Ubah</a>
                                                <span class="px-1"></span>
                                                <a class="text-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" href="{{ route('tatausaha.pendaftaran.delete', ['pendaftaran_id'=>$p->id]) }}">Hapus</a>
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
