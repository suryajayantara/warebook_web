@extends('layouts.app')

@section('contents')
    <div class="bg-[#FBFDFF] h-80 w-full">
        <div class="container w-[75%] flex mx-auto items-center h-80 z-10">
            <div class="w-1/2">
                <h1 class="text-5xl font-extrabold">Temukan & Simpan Inspirasimu</h1>
                <p class="lg:mr-24 text-[#828284] sm:mr-0">“Sebagai pusat kajian ilmu pengetahuan dan teknologi terapan menuju pada peningkatan daya saing dan kesejahteraan masyarakat pada tahun 2025”.</p>
            </div>
            <div class="w-1/2">
                <img class="h-72 ml-40 " src="{{ asset('img/design/backdrop.svg') }}" alt="">
            </div>
        </div>
        <form action="{{ route('lectureDashboard.show', '1') }}" method="GET"
            class="flex items-center shadow-lg h-16 w-[75%] bg-[#EEEFF3] mx-auto  rounded-md -mt-9 z-20">
            {{-- @csrf --}}
            <img class="h-10 mx-5 rounded-l-md" src="{{ asset('img/icon/search.svg') }}" alt="">
            <select class="bg-[#EEEFF3] h-16 w-[15%] mr-10 font-semibold text-gray-500 rounded-r-md focus:outline-none"
                name="type">
                <option value="" disabled selected>Jenis Repositori</option>
                <option value="thesis">Tesis</option>
                <option value="pkm">PKM</option>
                <option value="journal">Jurnal</option>
                <option value="internal">Penelitian & Pengabdian Dosen</option>


            </select>
            <input class="bg-[#EEEFF3] h-16 w-[80%] focus:outline-none" placeholder="Cari Judul Repositori Disini"
                type="text" name="search" id="">
        </form>
    </div>
    <div class="container w-[75%] flex flex-col items-center mx-auto mb-10">
        <h1 class="mt-16 font-bold text-[#828284] text-4xl">Repositori Terbaru</h1>
        <div class="mt-14 grid grid-cols-5 gap-4">
            @foreach ($internal as $item)
                <a href="{{ route('internalResearch.show', $item->id) }}"
                    class="block overflow-hidden rounded-md shadow-sm">
                    <div class="bg-[#70a1ff]">
                        <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                            alt="" />
                    </div>
                    <div class="p-4 bg-white h-40">
                        <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'Penelitian Dosen' }}
                        </p>
                        <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                    </div>
                </a>
            @endforeach
            @foreach ($thesis as $item)
                <a href="{{ route('lectureThesis.show', $item->id) }}" class="block overflow-hidden rounded-md shadow-sm">
                    <div class="bg-[#2ed573]">
                        <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/folder.svg') }}"
                            alt="" />
                    </div>
                    <div class="p-4 bg-white h-40">
                        <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">
                            {{ $item->thesis_type }}</p>
                        <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                    </div>
                </a>
            @endforeach
            @foreach ($creativity as $item)
                <a href="{{ route('lectureCreativity.show', $item->id) }}"
                    class="block overflow-hidden rounded-md shadow-sm">
                    <div class="bg-[#ffa502]">
                        <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                            alt="" />
                    </div>
                    <div class="p-4 bg-white h-40">
                        <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'PKM' }}
                        </p>

                        <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                    </div>
                </a>
            @endforeach
            @foreach ($journal as $item)
                <a href="{{ route('journalDocument.show', $item->id) }}"
                    class="block overflow-hidden rounded-md shadow-sm">
                    <div class="bg-[#ff4757]">
                        <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                            alt="" />
                    </div>
                    <div class="p-4 bg-white h-40">
                        <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'Journal' }}
                        </p>

                        <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                    </div>
                </a>
            @endforeach
            @foreach ($topic as $item)
                <a href="{{ route('journalTopic.show', $item->id) }}" class="block overflow-hidden rounded-md shadow-sm">
                    <div class="bg-[#3742fa]">
                        <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/folder.svg') }}"
                            alt="" />
                    </div>
                    <div class="p-4 bg-white h-40">
                        <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'Repositori Jurnal' }}
                        </p>

                        <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="container w-[75%] mx-auto mb-32">
        {{ $paginate->links() }}
    </div>
@endsection
