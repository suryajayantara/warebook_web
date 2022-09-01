@extends('layouts.app')

@section('contents')

    <div class="container mx-auto w-[80%] ">
        <div class="flex mt-20 items-center">
            <div class="flex w-[75%]">
                <div class="flex flex-col">
                    <div class="">
                        <h1 class="text-4xl font-extrabold">{{ $data->title }}</h1>
                    </div>
                    <nav class="flex text-lg font-bold border-b border-gray-100">
                        <div class="mt-2 border-b  duration-100">
                            Bidang
                        </div>
                    </nav>
                    <div class="duration-300 opacity-80" id="abstract">
                        {{ $data->subject }}
                    </div>

                    <nav class="flex text-lg font-bold border-b border-gray-100">
                        <div class="mt-2 border-b  duration-100">
                            Deskripsi
                        </div>
                    </nav>
                    <div class="py-2">
                        <div class="duration-300 opacity-80" id="abstract">
                            {{ $data->description }}
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
                @if (Auth::user()->hasRole('lecture'))
                    @if (Auth::user()->id == $data->users_id)
                        <form action="{{ route('journalTopic.destroy', ['journalTopic' => $data->id]) }}" method="post">
                            <input
                                class="mx-1 float-right inline-block px-6 py-2.5 bg-[#FF7675] text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                type="submit" value="Delete" />
                            @method('delete')
                            @csrf
                        </form>

                        <a href="{{ route('journalTopic.edit', $data->id) }}">
                            <button type="button"
                                class="mx-1 float-right inline-block px-6 py-2.5 bg-[#FDCB6E] text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                Edit Repo
                            </button>
                        </a>
                    @endif
                    <a href="{{ route('journalDocument.create', ['id' => $data->id]) }}">
                        <button type="button"
                            class="mx-1 float-right inline-block px-6 py-2.5 bg-blue-600 text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Tambah Jurnal
                        </button>
                    </a>
                @endif
            </div>
        </div>

        <div class="grid gap-3 overflow-auto duration-300 mb-20" id="document">
            @foreach ($document as $item)
                <div class="flex min-h-[4.5rem] w-full bg-slate-50 shadow-sm rounded-md">
                    <a href=" 
                @if (Auth::user()->hasRole('student')) {{ route('studentJournalDocument.show', $item->id) }}
                @else {{ route('journalDocument.show', $item->id) }} @endif"
                        class="flex-grow flex">
                        <div class="flex items-start py-2 mr-4">
                            <img class="bg-[#FF7675]  min-h-[3rem] min-w-[3rem] p-2 ml-2 rounded-md"
                                src="{{ asset('img/icon/document.svg') }}" alt="">
                        </div>
                        <div class="py-2 flex flex-col justify-center w-90% ">
                            <div class="mt-1">
                                <h1 class="text-sm font-black">{{ $item->title }}</h1>
                            </div>
                            <p class="text-xs">{{ $item->author }}</p>
                        </div>
                    </a>

                    @if ($item->user_id == Auth::user()->id or $data->user_id == Auth::user()->id)
                        <button id="dropdownDefault" data-dropdown-toggle="dropdown{{ $item->id }}" class="mx-8"
                            type="button">
                            <svg width="5" height="22" viewBox="0 0 5 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="5" height="5" rx="2" fill="#D9D9D9" />
                                <rect y="9" width="5" height="5" rx="2" fill="#D9D9D9" />
                                <rect y="17" width="5" height="5" rx="2" fill="#D9D9D9" />
                            </svg>
                        </button>
                    @endif

                    <!-- Dropdown menu -->
                    <div id="dropdown{{ $item->id }}"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                            <li>
                                <a href="{{ route('journalDocument.edit', ['journalDocument' => $item->id]) }}"
                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('journalDocument.destroy', ['journalDocument' => $item->id]) }}"
                                    method="post">
                                    <input
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        type="submit" value="Delete" />
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

    {{-- <script src="{{asset('js/tabs.js')}}"></script> --}}
@endsection
