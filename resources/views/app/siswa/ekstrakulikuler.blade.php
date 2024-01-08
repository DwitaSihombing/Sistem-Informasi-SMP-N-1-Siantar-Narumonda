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
                                    Daftar Ekstrakulikuler
                                </h4>
                            </div>
                            <div class="col">
                                @if($ekstraKu)
                                    <div class="text-end">
                                        <a href="{{ route('siswa.ekstrakulikuler.detail', ['ekstrakulikuler_id'=>$ekstraKu->ekstrakulikuler_id]) }}" class="btn btn-primary">Ekstrakulikuler Ku</a>
                                    </div>
                                @endif
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
                                                    @if(!$ekstraKu)
                                                    <a class="text-primary" onclick="return confirm('Yakin ingin bergabung dengan ekstrakulikuer ini?')" href="{{ route('siswa.ekstrakulikuler.join', ['ekstrakulikuler_id'=> $e->id]) }}">Bergabung</a>
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
