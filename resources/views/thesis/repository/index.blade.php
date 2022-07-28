@extends('layouts.app')

@section('contents')

    <div class="container mx-auto w-[80%] ">
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
                <div class="flex flex-col">
                    <div class="h-[7.5rem] overflow-hidden">
                        <h1 class="text-4xl font-extrabold" >Pembuatan Jaje Bali Berbasis Machine Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi atque non quisquam vel quibusdam corporis alias aut laboriosam laborum, harum aliquid libero voluptates, neque expedita officia, provident enim beatae dolores! Learning dengan Tensorflow dengan bantuan Crytograph</h1>
                    </div>
                    <div class="flex mx-1 my-2 items-center">
                        <img class="rounded-full h-8 w-8" src="{{asset('img/design/panji.svg')}}" alt="">
                        <div class="text-sm mx-2">
                            <h1 class="font-bold opacity-90">I Nyoman Arya Candrayana</h1>
                            <p class="-mt-1 text-[12px]">Diterbitkan tahun 2019</p>
                        </div>
                    </div>
                    <nav class="flex text-lg font-bold border-b border-gray-100">
                        <button id="abstractButton" onclick="tabsView('abstract')" class="px-4 pb-2 border-b border-current  hover:opacity-100 duration-100">
                          Abstrak
                        </button>
                        <button id="documentButton" onclick="tabsView('document')" class="px-4 pb-2 border-b  hover:opacity-100 duration-100">
                          Dokumen
                        </button>
                        <div id="add" class="hidden w-full">
                            <a href="">
                                <button  class="float-right inline-block px-6 py-2.5 bg-blue-600 text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Tambah Dokumen
                                </button>
                            </a>
                        </div>
                    </nav>
                    <div class="py-5">
                        <div class="h-36 overflow-hidden duration-300 " id="abstract">
                            Lorem ipsum dolor sit Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda, quos. amet consectetur adipisicing elit. Dignissimos voluptates amet odio aliquam. Magnam ut labore deserunt doloremque, numquam fugiat quae quasi quis vitae itaque. A aperiam impedit nulla nostrum eum quasi blanditiis atque veritatis commodi. Ratione, cupiditate ut consequuntur, libero animi voluptatem saepe, eveniet esse quae dignissimos exercitationem sapiente accusantium repellendus assumenda vitae deserunt praesentium vero ullam amet asperiores placeat maxime. Architecto pariatur nulla suscipit quae? Voluptas omnis consectetur cum cupiditate iste beatae perspiciatis quas, architecto quia perferendis nam magnam nobis eaque accusantium, obcaecati earum dolorem fugiat maxime excepturi adipisci qui inventore dignissimos molestiae provident? Consequatur at cupiditate possimus.
                        </div>
                        <div class="grid grid-cols-2 gap-3 h-[9rem] overflow-auto duration-300" id="document">
                            {{-- @for ($i = 0; $i < 3 $i++); --}}
                            @for ($i = 0; $i < 5; $i++)
                                <a href="" class="flex h-16 w-full bg-slate-50 shadow-sm rounded-md">
                                    <img class="bg-[#FF7675] p-3 m-2 mr-1 rounded-md" src="{{asset('img/icon/document.svg')}}" alt="">
                                    <div class="p-2 h-14 overflow-hidden ">
                                        <h1 class="text-[18px]  font-black">BAB I</h1>
                                        <p class="text-sm -mt-1">Cover</p>
                                    </div>
                                </a>
                            @endfor
                            
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