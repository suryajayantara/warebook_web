@extends('layouts.app')

@section('contents')

    <div class="container mx-auto w-[80%] ">
        <div class="flex mt-20 items-center">
            <div class="rounded-md w-[25%] h-[22rem]">
                <div class=" w-full h-[22rem] bg-blue-300 overflow-hidden rounded-md">
                    <img class="-z-20" src="{{asset('img/design/panji.svg')}}" alt="1">
                </div>
            </div>
            <div class="flex w-[75%] pl-14">
                <div class="flex flex-col">
                    <div class="">
                        <h1 class="text-4xl font-extrabold" >Journal Penelitian Teknologi Komunikasi</h1>
                    </div>
                    <nav class="flex text-lg font-bold border-b border-gray-100">
                        <div  class="mt-2 border-b  duration-100">
                          Bidang
                        </div>
                    </nav>
                    <div class="duration-300 opacity-80" id="abstract">
                        Ilmu Kehidupan & Biologi, Pertanian & Ketahanan Pangan
                    </div>
                    
                    <nav class="flex text-lg font-bold border-b border-gray-100">
                        <div  class="mt-2 border-b  duration-100">
                          Deskripsi
                        </div>
                    </nav>
                    <div class="py-2">
                        <div class="h-36 overflow-hidden duration-300 opacity-80" id="abstract">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos voluptates amet odio aliquam.psum dolor sit amet consectetur adipisicing elit. Dignissimos voluptates amet odio aliquam. Magnam ut labore deserunt doloremque, numquam fugiat quae quasi quis vitae itaque. A aperiam impedit nulla nostrum eum quasi blanditiis atque veritatis commodi. Ratione, cupiditate ut consequuntur, libero animi voluptatem saepe, eveniet esse quae dignissimos exercitationem sapiente accusantium repellendus assumenda vitae deserunt praesentium vero ullam amet asperiores placeat maxime. Architecto pariatur nulla suscipit quae? Voluptas omnis consectetur cum cupiditate iste beatae perspiciatis quas, architecto quia perferendis nam magnam nobis eaque accusantium, obcaecati earum dolorem fugiat maxime excepturi adipisci qui inventore dignissimos molestiae provident? Consequatur at cupiditate possimus.
                        </div>
                        
                    </div>                    
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 my-7">
            <div class="text-2xl  font-bold opacity-90">
                Jurnal dalam Repositori
            </div>
            <div>
                <a href="http://">
                    <button type="button" class="float-right inline-block px-6 py-2.5 bg-blue-600 text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Tambah Jurnal
                    </button>
                </a>
            </div>
        </div>

        <div class="grid gap-3 overflow-auto duration-300 mb-20" id="document">
           @for ($i = 0; $i < 5; $i++)
           <a href="" class="flex min-h-[5rem] w-full bg-slate-50 shadow-sm rounded-md">
            <div class="flex items-start py-4 mr-4">
                <img class="bg-[#FF7675]  min-h-[3rem] min-w-[3rem] p-2 ml-2 rounded-md" src="{{asset('img/icon/document.svg')}}" alt="">
            </div>
            <div class="py-2 flex flex-col w-90% ">
                <div class="mt-1">
                    <h1 class="text-sm font-black">Pembuatan Jaje Bali Berbasis Machine Learning dengan Tensorflow dengan bantuan Crytograph Pembuatan Jaje Bali Berbasis Machine Learning dengan Tensorflow dengan bantuan Crytograph Pembuatan Jaje Bali Berbasis Machine Learning dengan Tensorflow dengan bantuan Crytograph Pembuatan Jaje Bali Berbasis Machine Learning dengan </h1>
                </div>
                <p class="text-xs">I Nyoman Arya Candrayana</p>
            </div>
            </a>
           @endfor
        </div>
    </div>

{{-- <script src="{{asset('js/tabs.js')}}"></script>
     --}}
@endsection