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
        <p class="opacity-60 -mt-1 mb-3">Lupa password?, reset melalui email!</p>

        @if (session('status'))
            <div class="p-4 text-green-700 border rounded border-green-900/10 bg-green-50" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form enctype="multipart/form-data" action="{{ route('password.email') }}" method="post" class="flex flex-col">
            @csrf
            <input id="email" type="email"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Masukkan email anda"
                autofocus>
            @error('email')
                <span class="px-4 py-2 mt-2  text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
                    {{ $message }}
                </span>
            @enderror

            <button class="bg-[#0984E3] h-12 rounded-xl my-4 font-bold text-white" type="submit">Kirim Link</button>

        </form>
    </div>
</body>

</html>
