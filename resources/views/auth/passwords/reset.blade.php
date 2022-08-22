<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>PNB Repositories</title>
</head>

<body class="bg-[#F5F5F5]">
    <img class="mx-auto my-14" src="{{ asset('img/icon/icon.svg') }}">
    <div class="bg-white w-[30%] mx-auto px-16 pb-8 pt-10 mb-32 shadow-md rounded-sm">
        <h1 class="font-black text-[#333333] text-[30px]">Reset Password</h1>

        <form enctype="multipart/form-data" action="{{ route('password.update') }}" method="post"
            class="flex flex-col">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <input id="email" type="email"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                placeholder="Masukkan email anda" name="email" value="{{ $email ?? old('email') }}" required
                autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            <input id="password" type="password"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                name="password" required autocomplete="new-password" placeholder="Masukkan password baru">
            @error('password')
                <span class="px-4 py-2 mt-2  text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
                    {{ $message }}
                </span>
            @enderror

            <input id="password-confirm" type="password"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                name="password_confirmation" required autocomplete="new-password"
                placeholder="Konfirmasi password baru">

            <button class="bg-[#0984E3] h-12 rounded-xl my-4 font-bold text-white" type="submit">Kirim Link</button>

        </form>
    </div>
</body>

</html>



@extends('layouts.old_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">



                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
