@extends('layouts.app')

@section('contents')

    <div class="container mx-auto w-[70%] ">
        <div class="flex flex-col mt-20">
            <div class="flex flex-col">
                <div class="">
                    <h1 class="text-4xl font-extrabold">Pembuatan Jaje Bali Berbasis Machine Learning dengan Tensorflow dengan bantuan Crytograph</h1>
                </div>
                
                <div class="flex mx-1 my-4 items-center">
                    <img class="rounded-full h-8 w-8" src="{{asset('img/design/panji.svg')}}" alt="">
                    <div class="text-sm mx-2">
                        <h1 class="font-bold opacity-90">I Nyoman Arya Candrayana</h1>
                        <p class="-mt-1 text-[12px]">Diterbitkan tahun 2019</p>
                    </div>
                </div>
                <div class="text-lg font-bold opacity-90">
                      Abstrak
                </div>
                <div class="py-2">
                    <div class="duration-300 opacity-80 " id="abstract">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos voluptates amet odio aliquam. Magnam ut labore deserunt doloremque, numquam fugiat quae quasi quis vitae itaque. A aperiam impedit nulla nostrum eum quasi blanditiis atque veritatis commodi. Ratione, cupiditate ut consequuntur, libero animi voluptatem saepe, eveniet esse quae dignissimos exercitationem sapiente accusantium repellendus assumenda vitae deserunt praesentium vero ullam amet asperiores placeat maxime. Architecto pariatur nulla suscipit quae? Voluptas omnis consectetur cum cupiditate iste beatae perspiciatis quas, architecto quia perferendis nam magnam nobis eaque accusantium, obcaecati earum dolorem fugiat maxime excepturi adipisci qui inventore dignissimos molestiae provident? Consequatur at cupiditate possimus.
                    </div>
                </div>
                <div class="text-lg font-bold opacity-90">
                      Kata Kunci
                </div>
                <div class="duration-300 opacity-80" id="abstract">
                    Panga, sandang, papan, tulis
                </div>          
            </div>
            
            <div class="text-2xl mt-5 mb-2  font-bold opacity-90">
                Dokumen Jurnal
            </div>
            
            <div class="grid grid-cols-1 gap-3 overflow-auto duration-300 mb-20" id="document">
                <a href="" class="flex h-[5rem] w-full bg-slate-50 shadow-sm rounded-md items-center">
                <img class="bg-[#FF7675] p-2 h-[3.5rem] w-[3.5rem] m-2 mx-2 rounded-md" src="{{asset('img/icon/document.svg')}}" alt="">
                    <div class="overflow-hidden mt-1">
                        <h1 class="text-lg font-black ml-2">Dokumen Journal</h1>
                    </div>
                 </a>
             </div>

        </div>        
    </div>
@endsection