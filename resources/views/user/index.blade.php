@extends('layouts.app')

@section('contents')
    <div class="bg-[#FBFDFF] h-80 w-full">
        <div class="container w-[75%] flex mx-auto items-center h-80 z-10">
            <div class="w-1/2">
                <h1 class="text-5xl font-extrabold">Temukan Inspirasimu</h1>
                <p class="lg:mr-24 text-[#828284] sm:mr-0">Temukan ide ide brilian dari apa yang telah dibuat oleh kakak kakakmu terdahulu</p>
            </div>
            <div class="w-1/2">
                <img class="h-72 ml-40 " src="{{asset('img/design/backdrop.svg')}}" alt="">
            </div>
        </div>
        <div class="flex items-center shadow-lg h-16 w-[75%] bg-[#EEEFF3] mx-auto  rounded-md -mt-9 z-20">
            <img class="h-10 mx-5 rounded-l-md" src="{{asset('img/icon/search.svg')}}" alt="">
            <input class="bg-[#EEEFF3] h-16 w-full rounded-r-md focus:outline-none" placeholder="Cari Judul Repositori Disini" type="text" name="" id="">
        </div>
    </div>
    <div class="container w-[75%] flex flex-col items-center mx-auto mb-80">
        <h1 class="mt-16 font-bold text-[#828284] text-4xl">Jurnal Jurusanmu</h1>
        <div class="mt-14 grid grid-cols-5 gap-4">
            @if (Auth::user()->hasRole('student'))
                @foreach ($thesis as $item)
                <a href="{{'thesis/'. $item->id}}" class="block overflow-hidden rounded-md shadow-sm">
                    <img class="object-cover w-full h-36" src="{{asset('img/design/background.png')}}" alt="" />
                
                    <div class="p-4 bg-white h-40">
                    <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ $item->thesis_type }}</p>
                
                    <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>
                
                    </div>
                </a>
                @endforeach
            @else
                @foreach ($journal as $item)
                <a href="/dosen/journalTopic/index/{{$item->id}}" class="block overflow-hidden rounded-md shadow-sm">
                    <img class="object-cover w-full h-36" src="{{asset('img/design/background.png')}}" alt="" />
                
                    <div class="p-4 bg-white h-40">
                    <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'journal' }}</p>
                
                    <h5 class="text-xs mt-2 font-bold">{{$item->title}}</h5>
                
                    </div>
                </a>
                @endforeach
            @endif
        </div>
    </div>
    
@endsection