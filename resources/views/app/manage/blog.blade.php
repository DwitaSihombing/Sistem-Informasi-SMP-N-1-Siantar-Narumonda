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
                                    Kelola Blog
                                </h4>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a href="{{ route('manage.blog.add') }}" class="btn btn-primary">Tambah Data</a>
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
                                            <th scope="col">Penulis</th>
                                            <th scope="col">Dibuat pada</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($blogs as $key => $b)
                                            <tr>
                                                <th scope="row">{{ ($b->id) }}</th>
                                                <td>{{ $b->judul }}</td>
                                                <td>{{ $b->user->name }}</td>
                                                <td>{{ date("d F Y - H:i:s", strtotime($b->created_at)) }}</td>
                                                <td>

                                                    <a target="_blank" href="{{ route('blog.detail', ['blog_id'=>$b->id]) }}">Lihat</a>

                                                    @if(($user->role == 3 && $user->id == $b->user_id) || $user->role == 4)
                                                    <span class="px-1"></span>
                                                    <a class="text-warning" href="{{ route('manage.blog.edit', ['blog_id'=>$b->id]) }}">Ubah</a>
                                                    <span class="px-1"></span>
                                                    <a class="text-danger" onclick="return confirm('Yakin ingin menghapus blog ini?')" href="{{ route('manage.blog.delete', ['blog_id'=>$b->id]) }}">Hapus</a>

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
