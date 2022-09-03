@extends('layouts.app')

@section('contents')
    <br>
    <div class="bg-white w-[30%] mx-auto px-16 pb-8 pt-10 mb-32 shadow-md rounded-sm">
        <h1 class="font-black text-[#333333] text-[30px]">Update Data Diri</h1>
        <p class="opacity-60 -mt-1 mb-3">Masukan Data Dirimu</p>
        <form enctype="multipart/form-data" action="{{ route('user.update', ['user' => $user->id]) }}" method="post"
            class="flex flex-col">
            @csrf
            @method('PUT')
            <input value="{{ $user->user->name }}"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                type="text" placeholder="Nama" name="name">
            <input value="{{ $user->unique_id }}"autocomplete="of"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                type="text" placeholder="No Identitas" name="unique_id">
            <input value="{{ $user->user->email }}"
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                type="email" placeholder="Email" name="email">
            <select
                class="h-12 mt-3 mb-2 px-3 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200 focus:text-[#333333] "
                name="studies_id">
                <option value="" disabled>Pilih Program Studi</option>
                <option value="{{ $user->study_id }}" selected>{{ $user->study->studies_name }} -
                    {{ $user->departements->departement_name }}</option>
                @foreach ($studies as $item)
                    @if ($item->id != $user->study_id)
                        <option value="{{ $item->id }}">{{ $item->studies_name }} -
                            {{ $item->departements->departement_name }}</option>
                    @endif
                @endforeach
            </select>

            <button class="bg-[#0984E3] h-12 rounded-xl my-4 font-bold text-white" type="submit">Update Profile</button>

        </form>
    </div>
@endsection
