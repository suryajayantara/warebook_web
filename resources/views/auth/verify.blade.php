@extends('layouts.app')

@section('contents')
    <img class="mx-auto my-14" src="{{ asset('img/icon/icon.svg') }}">
    <div class="bg-white w-[35%] mx-auto px-16 pb-8 pt-10 mb-32 shadow-md rounded-sm">
        <h1 class="font-black text-[#333333] text-[30px]">Verifikasi Email</h1>

        @if (session('resent'))
            <div class="px-4 py-2 mt-2  text-green-700 border rounded border-green-900/10 bg-green-50" role="alert">
                {{ __('Link verifikasi baru sudah kami kirimkan ke alamat email anda') }}
            </div>
        @endif
        <p class="opacity-60 mt-2 mb-3">
            {{ __('Kami telah mengirimkan link verifikasi ke email anda.') }}
            {{ __('Jika anda belum menerima pesan verifikasi') }}</p>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
                class="text-[#0984E3] mx-auto font-bold hover:bg-blue-50 ">{{ __('Klik disini') }}</button>.
        </form>
    </div>
@endsection
