@extends('layouts.app')

@section('contents')

<div class="container w-[85%] mx-auto">
    <div class="flex justify-between mt-10">
        <h1 class="text-2xl opacity-80  font-extrabold">Repository mu</h1>
            <a href="
            {{ route('repository.create')}}" class=" bg-blue-200">
                <button class="bg-blue-600 px-3 py-1 font-extrabold text-white rounded-md">Tambah Repositori</button>
            </a>
    </div>

    <div class="mt-10 grid grid-cols-5 gap-4">
        @php
            if (Auth::user()->hasRole('student')) :
        @endphp
            @foreach ($thesis as $item)
            <a href="{{'thesis/'. $item->id}}" class="block overflow-hidden rounded-md shadow-sm">
                <img class="object-cover w-full h-36" src="{{asset('/img/design/background.png')}}" alt="" />
                <div class="p-4 bg-white h-40">
                    <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ $item->thesis_type }}</p>
                    <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>

                </div>
            </a>
            @endforeach

            @foreach ($creativity as $item)
            <a href="{{'creativity/'. $item->id}}" class="block overflow-hidden rounded-md shadow-sm">
                <img class="object-cover w-full h-36" src="{{asset('/img/design/background.png')}}" alt="" />
                <div class="p-4 bg-white h-40">
                    <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'Proposal Kretivitas Mahasiswa'}}</p>
                    <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>

                </div>
            </a>
            @endforeach
            
        @php
            else :
        @endphp
            @foreach ($topic as $item)
            <a href="{{'journalTopic/index/'. $item->id}}" class="block overflow-hidden rounded-md shadow-sm">
                <img class="object-cover w-full h-36" src="{{asset('/img/design/background.png')}}" alt="" />
                <div class="p-4 bg-white h-40">
                  <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'journal' }}</p>
                  <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>

                </div>
            </a>
            @endforeach

            @foreach ($internalresearch as $item)
            <a href="internalResearch/{{$item->id}}" class="block overflow-hidden rounded-md shadow-sm">
                <img class="object-cover w-full h-36" src="{{asset('/img/design/background.png')}}" alt="" />
                <div class="p-4 bg-white h-40">
                  <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'penelitian' }}</p>
                  <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>

                </div>
              </a>
            @endforeach


        @php
            endif
        @endphp
    </div>

    @if (Auth::user()->hasRole('lecture'))
        <h1 class="text-2xl opacity-80  mt-10 font-extrabold">Jurnal mu</h1>
        
        <div class="mt-10 grid grid-cols-5 gap-4">
        @foreach ($journal  as $item)
            <a href="{{'journalDocument/index/'. $item->id}}" class="block bg-red-400 overflow-hidden rounded-md shadow-sm">
                <img class="object-cover w-[47%] my-2 mx-auto h-32 " src="{{asset('img/icon/document.svg');}}" alt="" />
                
                <div class="p-4 bg-white h-40">
                    <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'journal' }}</p>
                    <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>

                </div>
              </a>
        @endforeach
        </div>
    @endif
</div>


@endsection