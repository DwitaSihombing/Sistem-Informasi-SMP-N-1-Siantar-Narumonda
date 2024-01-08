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
                                    Kelola Fasilitas
                                </h4>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a href="{{ route('admin.fasilitas.add') }}" class="btn btn-primary">Tambah Data</a>
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
                                            <th scope="col">Cover</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Dibuat pada</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($fasilitas as $key => $f)
                                            <tr>
                                                <th scope="row">{{ ($f->id) }}</th>
                                                <td>
                                                    <img src="{{ asset($f->cover) }}" style="height: 200px" alt="">
                                                </td>
                                                <td>{{ $f->keterangan }}</td>
                                                <td>{{ date("d F Y - H:i:s", strtotime($f->created_at)) }}</td>
                                                <td>
                                                    <a class="text-warning" href="{{ route('admin.fasilitas.edit', ['fasilitas_id'=>$f->id]) }}">Ubah</a>
                                                    <span class="px-1"></span>
                                                    <a class="text-danger" onclick="return confirm('Yakin ingin menghapus fasilitas ini?')" href="{{ route('admin.fasilitas.delete', ['fasilitas_id'=>$f->id]) }}">Hapus</a>
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
