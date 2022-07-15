@extends('layouts.app')

@section('contents')
    <div class="bg-[#FBFDFF] h-80 w-full">
        <div class="container w-[75%] flex mx-auto items-center h-80 z-10">
            <div>
                <h1 class="text-6xl font-extrabold">Temukan Inspirasimu</h1>
                <p class="mx-5">Temukan ide ide brilian dari apa yang telah dibuat oleh kakak kakakmu terdahulu</p>
            </div>
            <div class="">
                <img class="h-72 ml-40 " src="{{asset('img/backdrop.svg')}}" alt="">
            </div>
        </div>
        <div class="flex items-center shadow-lg h-16 w-[75%] bg-[#EEEFF3] mx-auto  rounded-md -mt-9 z-20">
            <img class="h-10 mx-5" src="{{asset('img/icon/search.svg')}}" alt="">
            <input class="bg-[#EEEFF3] h-16 w-full" placeholder="Cari Judul Repositori Disini" type="text" name="" id="">
        </div>
    </div>
@endsection