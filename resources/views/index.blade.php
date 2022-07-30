<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>PNB Repositories</title>
</head>
<body class="bg-[#F5F5F5]">
    <img class="mx-auto my-14" src="{{asset('img/icon/icon.svg')}}" alt="">
    <div class="bg-white w-[30%] mx-auto px-16 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px]">Selamat Datang !</h1>
        <p class="opacity-60 -mt-1">Masuk untuk mengakses konten</p>

        <form class="flex flex-col" action="post    ">
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="email" placeholder="Email" name="email" id="email">
            <input class="h-12 mb-3 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200 " type="password" placeholder="Password" name="password" id="email">
            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Masuk</button>
        </form> 
        <div class="mx-auto flex justify-center">
            <a href="{{ route('register.index') }}" class="text-[#0984E3] font-bold py-1 px-2 hover:bg-blue-50 mt-2">
                Buat Akun
            </a>
        </div>
        
    </div>
</body>
</html>