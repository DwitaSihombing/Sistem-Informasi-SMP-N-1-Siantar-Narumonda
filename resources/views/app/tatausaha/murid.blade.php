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
                                    Kelola Siswa
                                </h4>
                            </div>
                            <div class="col">

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
                                        <th scope="col">Terdapat Data Diri</th>
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
                                                @if($u->dataDiri > 0)
                                                    <span class="badge bg-success">Ya</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($u->id != $user->id)
                                                    <a class="text-warning" href="{{ route('tatausaha.murid.edit', ['user_id'=>$u->id]) }}">Ubah</a>
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
