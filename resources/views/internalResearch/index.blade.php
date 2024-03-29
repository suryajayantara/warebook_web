@extends('layouts.app')

@section('contents')
    <div class="container mx-auto w-[70%] ">
        <div class="flex flex-col mt-20">
            <div class="flex flex-col">
                <div class="">
                    <h1 class="text-4xl font-extrabold">{{ $data->title }}</h1>
                </div>

                <div class="flex mx-1 my-4 items-center">
                    <img class="rounded-full h-8 w-8" src="{{ asset('assets/img/avatars/6.png') }}" alt="">
                    <div class="text-sm mx-2">
                        <h1 class="font-bold opacity-90">{{ $data->users->name }}</h1>
                        <p class="-mt-1 text-[12px]">{{ $data->users->email }}</p>
                    </div>
                </div>
                <div class="text-lg font-bold opacity-90">
                    Tim Peneliti
                </div>
                <div class="pb-2">
                    <div class=" opacity-80 " id="abstract">
                        {{ $data->team_member }}
                    </div>
                </div>
                <div class="text-lg font-bold opacity-90">
                    Abstrak
                </div>
                <div class="py-2">
                    <div class=" opacity-80 " id="abstract">
                        {{ $data->abstract }}
                    </div>
                </div>

                <div class="text-lg font-bold opacity-90">
                    Waktu Pengerjaan Projek
                </div>
                <div class=" opacity-80" id="abstract">
                    {{ date('l, d F Y', strtotime($data->project_started_at)) }} -
                    {{ date('l, d F Y', strtotime($data->project_finish_at)) }}
                </div>

                <div class="text-lg mt-2 font-bold opacity-90">
                    Nomor Kontrak Penelitian
                </div>
                <div class=" opacity-80" id="abstract">
                    {{ $data->contract_number }}
                </div>
            </div>

            <div class="flex mt-5 mb-2">
                <div class="flex-grow text-2xl mb-2  font-bold opacity-90">
                    Dokumen Penelitian
                </div>
                @if (Auth::user()->id == $data->users_id)
                    <form action="{{ route('internalResearch.destroy', ['internalResearch' => $data->id]) }}"
                        method="post">
                        <input
                            class="mx-1 float-right inline-block px-4 py-2 bg-[#FF7675] text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            type="submit" value="Delete" />
                        @method('delete')
                        @csrf
                    </form>

                    <a href="{{ route('internalResearch.edit', ['internalResearch' => $data->id]) }}">
                        <button type="button"
                            class="mx-1 float-right inline-block px-4 py-2 bg-[#FDCB6E] text-white font-bold text-sm leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Edit Repo
                        </button>
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-3 overflow-auto  mb-3" id="document">
                <a href="{{ asset($data->proposal_url) }}"
                    class="flex h-[5rem] w-full bg-slate-50 shadow-sm rounded-md items-center">
                    <img class="bg-[#FF7675] p-2 h-[3.5rem] w-[3.5rem] m-2 mx-2 rounded-md"
                        src="{{ asset('img/icon/document.svg') }}" alt="">
                    <div class="overflow-hidden mt-1">
                        <h1 class="text-lg font-semibold opacity-90 ml-2">Dokumen Proposal Penelitian</h1>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-3 overflow-auto  mb-20" id="document">
                <a href="{{ asset($data->document_url) }}"
                    class="flex h-[5rem] w-full bg-slate-50 shadow-sm rounded-md items-center">
                    <img class="bg-[#FF7675] p-2 h-[3.5rem] w-[3.5rem] m-2 mx-2 rounded-md"
                        src="{{ asset('img/icon/document.svg') }}" alt="">
                    <div class="overflow-hidden mt-1">
                        <h1 class="text-lg font-semibold opacity-90 ml-2">Dokumen Hasil Penelitian</h1>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
