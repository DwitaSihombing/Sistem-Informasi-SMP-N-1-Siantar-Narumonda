@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">{{ $blog->judul }}</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-8 col-xxl-9 mb-5">
                <div class="card mb-5">
                    <div class="card-body p-0">
                        <div class="glide glide-gallery" id="glideBlogDetail">

                            <img src="{{ asset($blog->cover) }}" style="width: 100%" alt="">

                        </div>
                        <div class="card-body pt-3">
                            <h4 class="mb-3">
                                {{ $blog->judul }}
                            </h4>

                            <h6>
                                Tanggal:
                                {{ date('d F Y - H:i:s', strtotime($blog->created_at)) }}
                                <span class="px-2"></span>
                                Dilihat:
                                <span class="align-middle">{{ $blog->dilihat }}x</span>
                            </h6>
                            <hr>

                            <div>
                                <?= str_replace("\n", '<br>', $blog->isi) ?>
                            </div>

                            @if($blog->lampiran)
                            <div class="border py-2 mt-3">
                                <p>
                                    <strong>Lampiran: </strong>
                                    <a target="_blank" href="{{ asset($blog->lampiran) }}">{{ $blog->lampiran }}</a>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-0">
                        <div class="row align-items-center">
                            <div class="col-6 text-muted">
                                <div class="row g-0">
                                    <div class="col-auto pe-3">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 col-xl-4 col-xxl-3">
                <div class="row">

                    <div class="col-12">
                        <h2 class="small-title">Populer</h2>
                        <div class="mb-5">
                            <div class="row mb-n2">

                                @foreach ($blogs_populer as $b)
                                    <div class="col-12 col-md-6 col-xl-12 mb-2">
                                        <div class="card sh-11 sh-sm-14">
                                            <div class="row g-0 h-100">
                                                <div class="col-auto">
                                                    <img src="{{ asset($b->cover) }}" alt="alternate text"
                                                        class="card-img card-img-horizontal sw-10 sw-sm-14">
                                                </div>
                                                <div class="col position-static">
                                                    <div
                                                        class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ route('blog.detail', ['blog_id' => $b->id]) }}"
                                                                class="stretched-link body-link">
                                                                <div class="clamp-line" data-line="2">
                                                                    {{ $b->judul }}</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
