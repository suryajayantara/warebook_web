@extends('layouts.app')

@section('contents')

    <div class="bg-white w-[40%] mx-auto  mt-10 px-10 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px] leading-7">Input Your Document</h1>
        <p class="opacity-60 mt-1">Masukkan dokumen yng diperlukan pada repositori</p>

        <form class="flex flex-col" enctype="multipart/form-data" action="{{ route('thesisDocument.store')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$thesis_id}}" name="thesis_id" >
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Nama Bagian" name="document_name" id="document_name" required>
            <input class="border rounded-md file:bg-slate-600 my-2 focus:outline-none cursor-pointer file:text-white file:font-bold file:border-none file:h-12 file:w-[25%]" type="file" name="document" id="document" required>

            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Simpan</button>
        </form>
        
        
    </div>

@endsection