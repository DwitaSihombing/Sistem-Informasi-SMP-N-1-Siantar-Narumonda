@extends('layouts.auth')

@section('content')
    <div class="sw-lg-50 px-5">
        <div class="sh-11">
            <a href="{{ route('index') }}">
                <div class="d-flex">
                    <img src="{{ asset('img/logo.png') }}" style="height: 55px" alt="">
                    <h4 class="pt-1 ps-2">SMP Negeri 1<br> Siantar Narumonda</h4>
                </div>
            </a>
        </div>

        <div class="mb-3">
            <h2 class="cta-1 text-primary">Masuk ke akun kamu!</h2>
        </div>

        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="email"></i>
                    <input type="email" class="form-control" placeholder="Alamat Email" name="email" required />
                    @error('email')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                </div>

                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input class="form-control pe-7" name="password" type="password" placeholder="Lupa Kata Sandi" />
                    <a class="text-small position-absolute t-3 e-3" href="{{ route('password.request') }}">Lupa?</a>
                </div>

                <button type="submit" class="btn btn-lg btn-primary">
                    Masuk
                </button>

            </form>
        </div>
    </div>
@endsection
