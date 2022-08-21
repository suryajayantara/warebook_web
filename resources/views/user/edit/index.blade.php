@extends('layouts.app')

@section('contents')
    <div class="container w-[70%] mx-auto">
        <h1 class="text-2xl mt-10 mb-5 font-extrabold opacity-90">Update Your Profile</h1>
        <h2 class="text-lg  my-2 font-bold opacity-90">Nama</h2>
        <p>{{ $data->user->name }}</p>


        <h2 class="text-lg  my-2 font-bold opacity-90">Email</h2>
        <p>{{ $data->user->email }}</p>

        <h2 class="text-lg  my-2 font-bold opacity-90">Nomor Identitas</h2>
        <p>{{ $data->unique_id }}</p>

        <h2 class="text-lg  my-2 font-bold opacity-90">Jurusan</h2>
        <p>{{ $data->departements->departement_name }}</p>

        <h2 class="text-lg  my-2 font-bold opacity-90">Program Studi</h2>
        <p>{{ $data->studies->studies_name }}</p>

        <div class="my-5">
            <a href="{{ route('user.edit', $data->id) }}">
                <button class="bg-blue-600 px-3 py-1 font-extrabold text-white rounded-md">Update Profile</button>
            </a>
            <a href="{{ route('changepassword.edit', ['changepassword' => $data->id]) }}">
                <button class="bg-blue-600 px-3 py-1 font-extrabold text-white rounded-md">Ganti Password</button>

            </a>
        </div>
    </div>

@endsection
