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
                                    Daftar Fasilitas
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
                                            <th scope="col">Cover</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($fasilitas as $key => $f)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($f->cover) }}" style="height: 200px" alt="">
                                                </td>
                                                <td>{{ $f->keterangan }}</td>
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
