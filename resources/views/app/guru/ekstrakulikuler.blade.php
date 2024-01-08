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
                                    Kelola Ekstrakulikuler
                                </h4>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a href="{{ route('guru.ekstrakulikuler.add') }}" class="btn btn-primary">Tambah Data</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Jumlah Anggota</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($ekstrakulikuler as $key => $e)
                                            <tr>
                                                <th scope="row">{{ ($e->id) }}</th>
                                                <td>{{ $e->judul }}</td>
                                                <td>{{ $e->jumlah_anggota }}</td>
                                                <td>
                                                    @if($e->terbuka == 1)
                                                        <span class="badge bg-success">Menerima Anggota</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak Menerima Anggota</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($e->user_id == $user->id)
                                                        <a class="text-primary" href="{{ route('guru.ekstrakulikuler.anggota', ['ekstrakulikuler_id'=> $e->id]) }}">Anggota</a>
                                                        <span class="px-1"></span>
                                                        <a class="text-warning" href="{{ route('guru.ekstrakulikuler.edit', ['ekstrakulikuler_id'=>$e->id]) }}">Ubah</a>
                                                        <span class="px-1"></span>
                                                        <a class="text-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" href="{{ route('guru.ekstrakulikuler.delete', ['ekstrakulikuler_id'=>$e->id]) }}">Hapus</a>
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
    </div>
@endsection
