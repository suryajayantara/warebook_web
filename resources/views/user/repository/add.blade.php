@extends('layouts.app')

@section('contents')


<div class="container w-[85%] mx-auto">
  {{-- <img class="mx-auto my-8" src="{{asset('img/icon/icon.svg')}}" alt=""> --}}
  <div class="bg-white w-[45%] mx-auto mt-8 px-16 pb-8 pt-10 shadow-md rounded-sm" >
      <h1 class="font-black opacity-90 text-[30px]">Pilih Tipe Repositorimu</h1>
      <p class="opacity-60 -mt-1 mb-3">Pilih tipe repositori penelitianmu untuk di publish</p>
      <div class="grid grid-cols-1 gap-2">
        @php
            if(Auth::user()->hasRole('student')):
        @endphp
          <a href="/thesis/create/Tugas Akhir" class="w-full mr-2 shadow-sm h-28 py-2 px-3 flex justify-between items-center rounded-xl bg-[#0984E3]">
            <div class="flex flex-col">
              <h1 class="font-extrabold text-white text-lg">Tugas Akhir</h1>
              <p class="text-xs w-[90%] text-white font-light">Tugas akhir merupakan puncak akhir dari perjalanan mu di perkuliahan, tanpa disadari , kamu memilih untuk menuntaskan perjalanannmu</p>
            </div>
            <img class="h-32" src="{{asset('img/design/thesis.svg')}}" alt="">
          </a>
          <a href="/creativity/create" class="w-full mr-2 shadow-sm h-28 py-2 px-3 flex justify-between items-center rounded-xl bg-[#FFB52C]">
            <div class="flex flex-col">
              <h1 class="font-extrabold text-white text-lg">PKM</h1>
              <p class="text-xs w-[90%] text-white font-light">Tugas akhir merupakan puncak akhir dari perjalanan mu di perkuliahan, tanpa disadari , kamu memilih untuk menuntaskan perjalanannmu</p>
            </div>
            <img class="h-32" src="{{asset('img/design/thesis.svg')}}" alt="">
          </a>
          <a href="/thesis/create/Skripsi" class="w-full mr-2 shadow-sm h-28 py-2 px-3 flex justify-between items-center rounded-xl bg-[#D9D9D9]">
            <div class="flex flex-col">
              <h1 class="font-extrabold text-white text-lg">Skripsi</h1>
              <p class="text-xs w-[90%] text-white font-light">Tugas akhir merupakan puncak akhir dari perjalanan mu di perkuliahan, tanpa disadari , kamu memilih untuk menuntaskan perjalanannmu</p>
            </div>
            <img class="h-32" src="{{asset('img/design/thesis.svg')}}" alt="">
          </a>
        @php
            else :
        @endphp
          <a href="/journalTopic/create" class="w-full mr-2 shadow-sm h-28 py-2 px-3 flex justify-between items-center rounded-xl bg-[#0984E3]">
            <div class="flex flex-col">
              <h1 class="font-extrabold text-white text-lg">Jurnal</h1>
              <p class="text-xs w-[90%] text-white font-light">Tugas akhir merupakan puncak akhir dari perjalanan mu di perkuliahan, tanpa disadari , kamu memilih untuk menuntaskan perjalanannmu</p>
            </div>
            <img class="h-32" src="{{asset('img/design/thesis.svg')}}" alt="">
          </a>
          <a href="{{route('internalResearch.create')}}" class="bg-[#FFB52C] w-full mr-2 shadow-sm h-28 py-2 px-3 flex justify-between items-center rounded-xl">
            <div class="flex flex-col">
              <h1 class="font-extrabold text-white text-lg">Penelitian Dosen</h1>
              <p class="text-xs w-[90%] text-white font-light">Tugas akhir merupakan puncak akhir dari perjalanan mu di perkuliahan, tanpa disadari , kamu memilih untuk menuntaskan perjalanannmu</p>
            </div>
            <img class="h-32" src="{{asset('img/design/thesis.svg')}}" alt="">
          </a>
        @php
            endif
        @endphp
      </div>        
  </div>
</div>


@endsection