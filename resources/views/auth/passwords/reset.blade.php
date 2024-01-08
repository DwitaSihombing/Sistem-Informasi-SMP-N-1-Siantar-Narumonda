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
            <h2 class="cta-1 text-primary">Reset Kata Sandi</h2>
        </div>

        <div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="email"></i>
                    <input type="email" class="form-control" placeholder="Alamat Email" name="email"  value="{{ $email ?? old('email') }}" required />
                    @error('email')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                </div>

                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input type="password" class="form-control" placeholder="Kata Sandi Baru" name="password" required />
                    @error('password')
                    <span class="text-danger" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input type="password" class="form-control" placeholder="Ulangi Kata Sandi Baru" name="password_confirmation" required />
                </div>

                <button type="submit" class="btn btn-lg btn-primary">
                    Reset Kata Sandi
                </button>

            </form>
        </div>
    </div>
@endsection
