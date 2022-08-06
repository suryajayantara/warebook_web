@extends('layouts.app')

@section('contents')

    <div class="bg-white w-[40%] mx-auto  my-10 px-10 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px] leading-7">Lengkapi Data Repositorimu</h1>
        <p class="opacity-60 mt-1">Lengkapi data untuk melanjutkan pembuatan repositori</p>

        <form enctype="multipart/form-data" action="/thesis/update" method="post" class="flex flex-col">
            @csrf
            <input type="hidden" name="thesis_id" value="{{ $thesis->id }}">
            <input class="font-semibold  h-12 mt-3 mb-2 text-slate-500 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Judul" name="title" id="title" value="{{ $thesis->title }}" required>
            <textarea class="font-semibold px-4 text-slate-500 h-32 py-2 outline-none  border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" placeholder="Abstrak" name="abstract" id="abstract" cols="30" rows="10" required>{{ $thesis->abstract }}</textarea>
            <input class="font-semibold  h-12 mt-3 mb-2 text-slate-500 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Kata Kunci" name="tags" id="email" value="{{ $thesis->tags }}" required>
            <input class="font-semibold  h-12 mt-3 mb-2 text-slate-500 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="number" placeholder="Tahun Pembuatan" name="created_year" id="created_year" value="{{ $thesis->created_year }}" required>

            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Simpan</button>
        </form>
        
        
    </div>

@endsection