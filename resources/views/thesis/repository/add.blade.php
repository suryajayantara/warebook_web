@extends('layouts.app')

@section('contents')

    <div class="bg-white w-[40%] mx-auto  mt-10 px-10 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px] leading-7">Lengkapi Data Repositorimu</h1>
        <p class="opacity-60 mt-1">Lengkapi data untuk melanjutkan pembuatan repositori</p>

        <form enctype="multipart/form-data" action="" method="post" class="flex flex-col">
            <input class="font-semibold  h-12 mt-3 mb-2 text-slate-500 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="email" placeholder="Judul" name="email" id="email">
            <textarea name="" class="font-semibold px-4 text-slate-500 h-32 py-2 outline-none  border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" placeholder="Abstrak" id="" cols="30" rows="10"></textarea>
            <input class="font-semibold  h-12 mt-3 mb-2 text-slate-500 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="email" placeholder="Kata Kunci" name="email" id="email">

            <label class="font-semibold opacity-80 ml-4 mt-3" for="thumbnail">Gambar Cover</label>
            <input accept="image/png, image/gif, image/jpeg" class="border rounded-md file:bg-slate-600 my-2 focus:outline-none cursor-pointer file:text-white file:font-bold file:border-none file:h-12 file:w-[25%]" type="file" name="" id="thumbnail">

            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Simpan</button>
        </form>
        
        
    </div>

@endsection