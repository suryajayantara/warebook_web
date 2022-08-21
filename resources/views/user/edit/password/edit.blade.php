@extends('layouts.app')

@section('contents')
    <br>
    <div class="bg-white w-[30%] mx-auto px-16 pb-8 pt-10 mb-32 shadow-md rounded-sm">
        <h1 class="font-black text-[#333333] text-[30px]">Ganti Password</h1>
        <p class="opacity-60 -mt-1 mb-3">Masukkan data password baru !</p>
        <form enctype="multipart/form-data" action="{{ route('changepassword.store') }}" method="post" class="flex flex-col">
            @csrf
            <input
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                type="password" placeholder="Password Lama" name="old_password">
            @error('old_password')
                <div class="px-4 py-2 mt-2  text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <input
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200"
                type="password" placeholder="Password Baru" name="password">
            @error('password')
                <div class="px-4 py-2 mt-2  text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <input
                class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150
                focus:border-slate-600 focus:outline-none duration-200"
                type="password" placeholder="Konfirmasi Password" name="password_confirmation">

            <button class="bg-[#0984E3] h-12 rounded-xl my-4 font-bold text-white" type="submit">Update Profile</button>

        </form>
    </div>
@endsection
