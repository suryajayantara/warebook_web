@extends('layouts.app')

@section('contents')
    <div class="container w-[75%] flex flex-col mx-auto mb-80">
        <div class="flex mt-16 w-full">
            <h1 class="font-bold text-[#828284] text-4xl">Repositorimu</h1>
            <div class="w-full">
                <a href="{{route('thesis.create')}}">
                    <button type="button" class="float-right inline-block px-6 py-2.5 bg-blue-600 text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Tambah Repositori
                    </button>
                </a>
            </div>
        </div>
        <div class="mt-14 grid grid-cols-5 gap-4">
            <a href="" class="block overflow-hidden rounded-md shadow-sm">
                <img class="object-cover w-full h-36" src="{{asset('img/design/background.png')}}" alt="" />
              
                <div class="p-4 bg-white h-40">
                  <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">Penelitian</p>
              
                  <h5 class="text-xs mt-2 font-bold">How to position your furniture for positivity</h5>
              
                </div>
              </a>
        </div>
    </div>
    
@endsection