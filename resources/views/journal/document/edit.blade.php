
@extends('layouts.app')

@section('contents')

    <div class="bg-white w-[40%] mx-auto  mt-10 px-10 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px] leading-7">Update Your Document</h1>
        <p class="opacity-60 mt-1">Masukkan data document baru yng diperlukan pada repositori</p>

        <form class="flex flex-col" enctype="multipart/form-data" action="/journalDocument/update" method="POST">
            @csrf
            <input type="hidden" value="{{$journal_document->id}}" name="journal_document_id" >
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Judul Jurnal" name="title" id="title" value="{{$journal_document->title}}" required>
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Penulis" name="author" id="author" value="{{$journal_document->author}}" required>
            <textarea class="font-semibold px-4 text-slate-500 h-32 py-2 outline-none  border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" placeholder="Abstrak" name="abstract" id="abstract" cols="30" rows="10" required>{{$journal_document->title}}</textarea>
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Kata Kunci" name="tags" id="tags" value="{{$journal_document->tags}}" required>
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Tahun Terbit" name="year" id="year" value="{{$journal_document->year}}" required>
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="DOI" name="doi" id="doi" value="{{$journal_document->doi}}">
            
            <input class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Link Jurnal Asli" name="original_url" id="original_url" value="{{$journal_document->original_url}}">
            <label for="document" class="mt-2 font-bold opacity-80">File Baru</label>
            <input class="border rounded-md file:bg-slate-600 my-2 focus:outline-none cursor-pointer file:text-white file:font-bold file:border-none file:h-12 file:w-[25%]" type="file" name="document" id="document">

            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Simpan</button>
        </form>
        
        
    </div>

@endsection