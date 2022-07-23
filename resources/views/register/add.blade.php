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
    <img class="mx-auto my-14" src="{{asset('img/icon/icon.svg')}}">
    <div class="bg-white w-[30%] mx-auto px-16 pb-8 pt-10 mb-32 shadow-md rounded-sm" >
        <h1 class="font-black text-[#333333] text-[30px]">Isi Datamu</h1>
        <p class="opacity-60 -mt-1 mb-3">Daftar untuk mengakses konten</p>
        <form enctype="multipart/form-data" action="{{ route('register.store') }}" method="post" class="flex flex-col">
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Nama" name="name">
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="No Identitas" name="unique_id">
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="email" placeholder="Email" name="email">
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="password" placeholder="Password" name="password">  
            
            <select class="text-slate-400 h-12 mt-3 mb-2 px-3 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200 focus:text-[#333333] " name="departement_id" id="">
                <option class="" value="" disabled selected>Pilih Jurusan</option>
                    @foreach ($departement_data as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->departement_name }}</option>
                    @endforeach
            </select>
            
            <select class="text-slate-400 h-12 mt-3 mb-2 px-3 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200 focus:text-[#333333] " name="departement_id" id="">
                <option value="" selected>Pilih Program Studi</option>
                    @foreach ($studies_data as $item)
                        <option value="{{ $item->id }}">{{ $item->studies_name }}</option>
                    @endforeach
            </select>

            <button class="bg-[#0984E3] h-12 rounded-xl my-4 font-bold text-white" type="submit">Registrasi</button>
            
        </form>        
    </div>
</body>
</html>