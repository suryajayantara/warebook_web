@extends('layouts.app')

@section('contents')

    <div class="container mx-auto w-[80%]">
        <div class="flex mt-24">
            <div class="rounded-md w-[25%] h-[26rem]">
                <div class=" w-full h-[25rem] bg-blue-300 overflow-hidden rounded-md">
                    <img class="-z-20" src="{{asset('img/design/panji.svg')}}" alt="1">
                </div>
                <a href="http://">
                    <img  class="scale-50 rounded-full p-6 float-right  -mt-12 bg-[#FDCB6E] hover:scale-[60%] hover:p-4 hover:-mt-10 hover:mr-2 duration-200 hover:bg-[#eab758]" src="{{asset('img/icon/favorite.svg')}}" alt="2">
                </a>
            </div>
            <div class="flex w-[75%] pl-14">
                <div class="flex flex-col w-full">
                    <div class="max-h-[7.5rem] overflow-hidden">
                        <h1 class="text-4xl font-extrabold" >{{$thesis->title}}</h1>
                    </div>
                    <div class="flex mx-1 my-2 items-center">
                        <img class="rounded-full h-8 w-8" src="{{asset('img/design/panji.svg')}}" alt="">
                        <div class="text-sm mx-2">
                            <h1 class="font-bold opacity-90">{{ $thesis->user->name}}</h1>
                            <p class="-mt-1 text-[12px]">Diterbitkan tahun {{$thesis->created_year}}</p>
                        </div>
                    </div>
                    <nav class="flex text-lg font-bold border-b border-gray-100">
                        <div class="div flex-grow">
                            <button id="abstractButton" onclick="tabsView('abstract')" class="px-4 pb-2 border-b border-current  hover:opacity-100 duration-100">
                                Abstrak
                              </button>
                              <button id="documentButton" onclick="tabsView('document')" class="px-4 pb-2 border-b  hover:opacity-100 duration-100">
                                Dokumen
                              </button>
                        </div>
                        @php
                            if ($thesis->user->id == Auth::user()->id) :
                        @endphp
                                <form id='button' action="/thesisDocument/create" class="mx-1 float-right" method="post">
                                    @csrf
                                    <input type="hidden" name="thesis_id" value="{{$thesis->id}}">
                                    <button type="submit"  class=" inline-block px-4 py-2 text-xs bg-blue-600 text-white font-bold leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Tambah Dokumen
                                    </button>
                                </form>
                                <form action="{{ url('/thesis', ['id' => $thesis->id]) }}" method="post">
                                    <input class="mx-1 float-right  px-4 py-2 text-xs bg-[#FF7675] text-white font-bold  leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" type="submit" value="Delete" />
                                    @method('delete')
                                    @csrf
                                </form>

                                <a href="{{route('thesis.edit', ['thesi' => $thesis->id])}}">
                                    <button type="button" class="mx-1 float-right px-4 py-2 text-xs bg-[#FDCB6E] text-white font-bold  leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Edit Repo
                                    </button>
                                </a>
                                
                        @php
                            endif
                        @endphp
                    </nav>
                    <div class="py-5">
                        <div class="h-36 overflow-hidden duration-300 " id="abstract">
                            {{$thesis->abstract}}
                        </div>
                        <div class="grid grid-cols-2 gap-3 h-[9rem] overflow-auto duration-300" id="document">
                            {{-- @for ($i = 0; $i < 3 $i++); --}}
                            @foreach ($document as $item)
                                <div  class="flex h-16 w-full bg-slate-50 shadow-sm rounded-md">
                                    <a href="{{asset($item->document_url)}}" class="flex flex-grow  items-center">
                                        <img class="bg-[#FF7675] p-3 m-2 mr-1 rounded-md" src="{{asset('img/icon/document.svg')}}" alt="">
                                        <h1 class="text-[18px] mx-2 font-black">{{$item->document_name}}</h1>
                                    </a>
                                    <button id="dropdownDefault" data-dropdown-toggle="dropdown{{$item->id}}" class="mx-8" type="button">
                                        <svg width="5" height="22" viewBox="0 0 5 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="5" height="5" rx="2" fill="#D9D9D9"/>
                                        <rect y="9" width="5" height="5" rx="2" fill="#D9D9D9"/>
                                        <rect y="17" width="5" height="5" rx="2" fill="#D9D9D9"/>
                                        </svg>
                                    </button>
                    
                                    <!-- Dropdown menu -->
                                    <div id="dropdown{{$item->id}}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                        <li>
                                            <a href="{{route('thesisDocument.edit', ['thesisDocument' => $item->id])}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ url('/thesisDocument', ['id' => $item->id]) }}" method="post">
                                                <input class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="submit" value="Delete" />
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </li>
                                        </ul>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>                    
                </div>
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

<script src="{{asset('js/tabs.js')}}"></script>
    
@endsection