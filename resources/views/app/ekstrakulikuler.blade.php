@extends('layouts.first')

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

                            </div>
                        </div>

                        <hr>

                        <div class="card mb-5">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Jumlah Anggota</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($ekstrakulikuler as $key => $e)
                                            <tr>
                                                <td>{{ $e->judul }}</td>
                                                <td>{{ $e->jumlah_anggota }}</td>
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
