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
                                    Anggota Ekstrakulikuler: {{ $ekstrakulikuler->judul }}<br>
                                    <small class="text-muted">{{ $ekstrakulikuler->deskripsi }}</small>
                                </h4>
                                <h5>
                                    Jumlah Anggota: <span class="badge bg-primary">{{ $ekstrakulikuler->jumlah_anggota }}</span>, Menerima Anggota Baru: <?= ($ekstrakulikuler->terbuka == 1) ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>' ?>
                                </h5>
                            </div>
                            <div class="col">

                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($anggota as $key => $a)
                                            <tr>
                                                <th scope="row">{{ ($a->id) }}</th>
                                                <td>
                                                    <img src="{{ ($a->photo) ? asset($a->photo) : asset('img/logo.png') }}" style="height: 150px;" alt="">
                                                </td>
                                                <td>{{ $a->data->nisn }}</td>
                                                <td>{{ $a->name }}</td>
                                                <td>
                                                    <a class="text-danger" onclick="return confirm('Yakin ingin menghapus anggota ini?')" href="{{ route('guru.ekstrakulikuler.anggota.delete', ['ekstrakulikuler_id'=>$ekstrakulikuler->id, 'anggota_id'=>$a->id]) }}">Hapus</a>
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
