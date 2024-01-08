@extends('layouts.app')

@section('css')
    <style>
        @media print {

            body *{
                visibility: hidden;
            }

            #printarea,
            #printarea * {
                visibility: visible;
            }

            .card-body{
                margin-top: -60px;
            }
        }

    </style>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 mb-5">
                <div class="card mb-5">

                    <div class="card-header">
                        <div class="text-end">
                            <button class="btn btn-primary" onclick="document.title = '{{ $pendaftaran->judul }}'; window.print();return false;">Print</button>
                        </div>
                    </div>

                    <div class="card-body" id="printarea">

                        <div class="row">
                            <div class="col">
                                <h4 class="mb-3">
                                    {{ $pendaftaran->judul }}

                                </h4>
                                <p class="text-muted">Melalui pengumuman ini kami hendak menyampaikan nama-nama calon
                                    siswa yang diterima masuk di SMP Negeri 1 Siantar Narumonda. Bagi nama-nama yang
                                    tercantum pada tabel di bawah ini, diharapkan melakukan pendaftaran ulang di SMP Negeri
                                    1 Siantar Narumonda.</p>
                            </div>
                        </div>

                        <hr>

                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $key => $u)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $u->name }}</td>
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
