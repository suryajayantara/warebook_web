@extends('layouts.app')
@section('contents')
    <div class="container mx-auto w-[85%]">
        <form method="GET">
            <div class="flex w-full mt-5">
                <div class="w-[20%] p-4 bg-white mr-2 shadow-sm rounded-md h-[80vh]">
                    <h1 class="font-bold opacity-90 text-lg">Jenis Repositori</h1>
                    <select name="type" id="" class="w-full ml-2">
                        <option value="" selected>Pilih Jenis Repositori</option>
                        <option value="thesis" @if ($type == 'thesis') selected @endif>Tesis</option>
                        <option value="pkm" @if ($type == 'pkm') selected @endif>PKM</option>
                        <option value="journal" @if ($type == 'journal') selected @endif>Journal</option>
                        <option value="topic" @if ($type == 'topic') selected @endif>Repositori Jurnal</option>
                    </select>
                    <h1 class="font-bold opacity-90 text-lg">Tahun Terbit</h1>
                    <select name="year" id="" class="w-full ml-2">
                        <option value="" selected>Pilih Tahun</option>
                        @for ($i = date('Y', strtotime('now')); $i >= 2015; $i--)
                            <option value="{{ $i }}" @if ($year == $i) selected @endif>
                                {{ $i }}</option>
                        @endfor
                    </select>

                </div>
                <div class="w-[80%]">
                    <div class="flex items-center shadow-sm h-16 w-full bg-[#FFFFFF] mx-auto  rounded-md">
                        <img class="h-10 mx-5 rounded-l-md" src="{{ asset('img/icon/search.svg') }}" alt="">
                        <input class="bg-[#FFFFFF] h-16 w-[80%] focus:outline-none"
                            placeholder="Cari Judul Repositori Disini" type="text" value="{{ $search }}"
                            name="search" id="">
                    </div>
        </form>

        <div class="grid grid-cols-4 gap-3 pt-3">
            @if (!empty($thesis))
                @foreach ($thesis as $item)
                    <a href="{{ route('thesis.show', $item->id) }}" class="block overflow-hidden rounded-md shadow-sm">
                        <div class="bg-blue-600">
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
            @endif
            @if (!empty($creativity))
                @foreach ($creativity as $item)
                    <a href="{{ route('creativity.show', $item->id) }}" class="block overflow-hidden rounded-md shadow-sm">
                        <div class="bg-blue-500">
                            <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                                alt="" />
                        </div>

                        <div class="p-4 bg-white h-40">
                            <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">
                                {{ 'PKM' }}
                            </p>

                            <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                        </div>
                    </a>
                @endforeach
            @endif
            @if (!empty($journal))
                @foreach ($journal as $item)
                    <a href="{{ route('studentJournalDocument.show', $item->id) }}"
                        class="block overflow-hidden rounded-md shadow-sm">
                        <div class="bg-blue-500">
                            <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/book.svg') }}"
                                alt="" />
                        </div>

                        <div class="p-4 bg-white h-40">
                            <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">
                                {{ 'Jurnal' }}
                            </p>

                            <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                        </div>
                    </a>
                @endforeach
            @endif
            @if (!empty($topic))
                @foreach ($topic as $item)
                    <a href="{{ route('studentJournalTopic.show', $item->id) }}"
                        class="block overflow-hidden rounded-md shadow-sm">
                        <div class="bg-blue-500">
                            <img class="object-cover h-36 mx-auto py-1 " src="{{ asset('/img/icon/folder.svg') }}"
                                alt="" />
                        </div>

                        <div class="p-4 bg-white h-40">
                            <p class="text-[9px] text-white bg-blue-700 w-max px-3 py-0.5 rounded-lg">{{ 'Repositori' }}
                            </p>

                            <h5 class="text-xs mt-2 font-bold">{{ $item->title }}</h5>

                        </div>
                    </a>
                @endforeach
        </div>
        @endif
    </div>

    </div>
    </div>
    <div class="container w-[75%] mx-auto mb-32">
        <br>
        {{ $pagination->links() }}
    </div>

    <br><br>
@endsection
