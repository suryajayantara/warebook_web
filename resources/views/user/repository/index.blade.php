@extends('layouts.app')

@section('contents')

    <div class="container w-[85%] mx-auto">
        <div class="flex justify-between mt-10">
            <h1 class="text-2xl opacity-80  font-extrabold">Repository mu</h1>
            <a href="
            @if (Auth::user()->hasRole('student')) {{ route('studentRepository.create') }}
            @else
              {{ route('lectureRepository.create') }} @endif
            "
                class=" bg-blue-200">
                <button class="bg-blue-600 px-3 py-1 font-extrabold text-white rounded-md">Tambah Repositori</button>
            </a>
        </div>


        @if (Auth::user()->hasRole('student'))
            :

            <h1 class="mt-10 text-xl opacity-80  font-extrabold">Tugas Akhir dan Skripsi</h1>
            <div class="mt-2 grid grid-cols-5 gap-4">
                @foreach ($thesis as $item)
                    <a href="{{ route('thesis.show', ['thesi' => $item->id]) }}"
                        class="block overflow-hidden rounded-md shadow-sm">
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
            </div>
            <br>
            {{ $thesis->links() }}
            <h1 class="mt-5 text-xl opacity-80  font-extrabold">Program Kreativitas Mahasiswa</h1>
            <div class="mt-10 grid grid-cols-5 gap-4">
                @foreach ($creativity as $item)
                    <a href="{{ 'creativity/' . $item->id }}" class="block overflow-hidden rounded-md shadow-sm">
                        <div class="bg-[#ffa502]">
                            <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                                alt="" />
                        </div>
                        <div class="p-4 bg-white h-40">
                            <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">
                                {{ 'PKM' }}</p>
                            <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                        </div>
                    </a>
                @endforeach

            </div>
            <br>
            {{ $creativity->links() }}
        @else
            @if (!empty($topic))
                <h1 class="mt-5 text-xl opacity-80  font-extrabold">Repository Journal Dosen</h1>
                <div class="mt-10 grid grid-cols-5 gap-4">
                    @foreach ($topic as $item)
                        <a href="{{ route('journalTopic.show', $item->id) }}"
                            class="block overflow-hidden rounded-md shadow-sm">
                            <div class="bg-[#1e90ff]">
                                <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/folder.svg') }}"
                                    alt="" />
                            </div>
                            <div class="p-4 bg-white h-40">
                                <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">
                                    {{ 'Repositori journal' }}
                                </p>
                                <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                            </div>
                        </a>
                    @endforeach
                </div>
                <br>
                @if ($topic->total() > 5)
                    {{ $topic->links() }}
                @endif
            @endif
            @if (!empty($internalresearch))
                <h1 class="mt-5 text-xl opacity-80  font-extrabold">Penelitian & Pengabdian Dosen</h1>
                <div class="mt-10 grid grid-cols-5 gap-4">
                    @foreach ($internalresearch as $item)
                        <a href="{{ route('internalResearch.show', $item->id) }}"
                            class="block overflow-hidden rounded-md shadow-sm">
                            <div class="bg-[#70a1ff]">
                                <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                                    alt="" />
                            </div>
                            <div class="p-4 bg-white h-40">
                                <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">
                                    {{ 'Penelitian Dosen' }}
                                </p>
                                <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                            </div>
                        </a>
                    @endforeach
                </div>
                @if ($internalresearch->total() > 5)
                    {{ $internalresearch->links() }}
                @endif
            @endif
            {{-- {{ $internalresearch->links() }} --}}
        @endif

        @if (Auth::user()->hasRole('lecture') && !empty($journal))
            <h1 class="text-2xl opacity-80  mt-10 font-extrabold">Jurnal mu</h1>

            <div class="mt-10 grid grid-cols-5 gap-4">
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
            </div>
            <br>
            @if ($journal->total() > 5)
                {{ $journal->links() }}
            @endif
        @endif
    </div>
    <br>

@endsection
