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
    <img class="mx-auto my-14" src="{{ asset('img/icon/icon.svg') }}" alt="">
    <div class="bg-white w-[30%] mx-auto px-16 pb-8 pt-10 shadow-md rounded-sm">
        <h1 class="font-black text-[30px]">Selamat Datang !</h1>
        <p class="opacity-60 -mt-1">Masuk untuk mengakses konten</p>

        @error('email')
            <div class="px-4 py-2 mt-2  text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
                {{ $message }}
            </div>
        @enderror
        @error('password')
            <div class="px-4 py-2 mt-2  text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
                {{ $message }}
            </div>
        @enderror
        <form class="flex flex-col" method="POST" action="{{ route('login') }}">
            @csrf
            <input
                class="bg-transparent h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                type="email" value="{{ old('email') }}" placeholder="Email" name="email" id="email">
            <input
                class="h-12 mb-3 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200 "
                type="password" placeholder="Password" name="password" id="email">
            <div class="flex">
                <input class="form-check-input mr-2" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Masuk</button>
        </form>

        <div class="mx-auto flex flex-col-reverse justify-center">
            <a href="{{ route('register.index') }}"
                class="text-[#0984E3] mx-auto font-bold py-1 px-2 hover:bg-blue-50 mt-2">
                Buat Akun
            </a>
            @if (Route::has('password.request'))
                <a class="text-[#0984E3] mx-auto font-bold py-1 px-2 hover:bg-blue-50 mt-2"
                    href="{{ route('password.request') }} ">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

    </div>
</body>

</html>
