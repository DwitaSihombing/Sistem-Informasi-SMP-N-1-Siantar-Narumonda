@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-xl-8 col-xxl-9 mb-5">

            @foreach ($blogs as $b)

            <div class="card mb-5">
                <a href="{{ route('blog.detail', ['blog_id'=>$b->id]) }}">
                    <img src="{{ asset($b->cover) }}" class="card-img-top sh-35" alt="{{ $b->judul }}">
                </a>
                <div class="card-body">
                    <h4 class="mb-3">
                        <a href="{{ route('blog.detail', ['blog_id'=>$b->id]) }}">{{ $b->judul }}</a>
                    </h4>
                    <p class="text-alternate clamp-line mb-0" data-line="2">
                        {{ $b->isi }}
                    </p>
                </div>
                <div class="card-footer border-0 pt-0">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="sw-5 d-inline-block position-relative me-3">
                                    <img src="{{ $b->user->photo ? asset($b->user->photo) : asset('img/logo.png') }}" class="img-fluid rounded-xl"
                                        alt="Photo pengguna">
                                </div>
                                <div class="d-inline-block">
                                    <a href="#">{{ $b->user->name }}</a>
                                    <div>
                                        #{{ $b->user->id }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-muted">
                            <div class="row g-0 justify-content-end">
                                <div class="col-auto pe-3">
                                    <i data-acorn-icon="eye" class="text-primary me-1"
                                        data-acorn-size="15"></i>
                                    <span class="align-middle">{{ $b->dilihat }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach




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
                                            <img src="{{ asset($b->cover) }}" alt="alternate text" class="card-img card-img-horizontal sw-10 sw-sm-14">
                                        </div>
                                        <div class="col position-static">
                                            <div
                                                class="card-body d-flex flex-column pt-0 pb-0 h-100 justify-content-center">
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('blog.detail', ['blog_id'=>$b->id]) }}" class="stretched-link body-link">
                                                        <div class="clamp-line" data-line="2">{{ $b->judul }}</div>
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
