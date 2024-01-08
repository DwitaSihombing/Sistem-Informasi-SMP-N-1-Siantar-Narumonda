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
                                    Kelola Pengguna
                                </h4>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <a href="{{ route('admin.user.add') }}" class="btn btn-primary">Tambah Data</a>
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
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($users as $key => $u)
                                            <tr>
                                                <th scope="row">{{ ($u->id) }}</th>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td>
                                                    @switch($u->role)
                                                        @case(4)
                                                            Admin
                                                            @break
                                                        @case(3)
                                                            Tata Usaha
                                                            @break
                                                        @case(2)
                                                            Guru
                                                            @break
                                                        @case(1)
                                                            Siswa
                                                            @break
                                                        @default
                                                            Calon Siswa
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if($u->id != $user->id)
                                                        <a class="text-warning" href="{{ route('admin.user.edit', ['user_id'=>$u->id]) }}">Ubah</a>
                                                        <span class="px-1"></span>
                                                        <a class="text-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" href="{{ route('admin.user.delete', ['user_id'=>$u->id]) }}">Hapus</a>
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
