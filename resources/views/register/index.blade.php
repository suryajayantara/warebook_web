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
    <div class="bg-white w-[35%] mx-auto px-16 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px]">Jenis Akun</h1>
        <p class="opacity-60 -mt-1 mb-3">Tentukan jenis akun yang akan dibuat</p>
        <div class="flex">
          <a href="{{ route('register.create')}}" class="w-1/2 mr-2 shadow-sm h-44 flex flex-col items-center rounded-xl bg-[#0984E3]">
            <img class="h-32" src="{{asset('img/design/teacher.svg')}}" alt="">
            <h1 class="font-bold text-white text-xl">Pengajar</h1>
          </a>  
          <a href="{{ route('register.create')}}" class="w-1/2 ml-2 shadow-sm h-44 rounded-xl flex flex-col items-center bg-[#E2AA40]">
            <img class="h-32" src="{{asset('img/design/student.svg')}}" alt="">
            <h1 class="font-bold text-white text-xl">Mahasiswa</h1>
          </a>
        </div>        
    </div>
</body>
</html>