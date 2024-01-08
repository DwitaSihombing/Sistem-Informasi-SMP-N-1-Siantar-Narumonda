@extends('layouts.calon')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 mb-5">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="mb-3">
                            Pengumuman
                        </h4>
                        <p class="text-alternate clamp-line mb-0" data-line="2">
                            @if($user->is_verified > 0)
                                Selamat kamu diterima masuk, silahkan lakukan pendaftaran ulang dengan mengunjungi SMP Negeri 1 Siantar Narumonda.
                            @elseif($user->is_verified < 0)
                                Mohon maaf setelah melakukan berbagai pertimbangan kami menyatakan kamu gagal untuk masuk ke SMP Negeri 1 Siantar Narumonda.
                            @else
                                Harap bersabar data kamu sedang dilakukan pemeriksaan, silahkan periksa secara berkala untuk informasi berikutnya.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
