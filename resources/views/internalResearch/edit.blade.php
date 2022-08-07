
@extends('layouts.app')

@section('contents')

    <div class="bg-white w-[40%] mx-auto  mt-10 px-10 pb-8 pt-10 shadow-md rounded-sm" >
        <h1 class="font-black text-[30px] leading-7">Input Your Document</h1>
        <p class="opacity-60 mt-1">Masukkan dokumen yng diperlukan pada repositori</p>

        <form class="flex flex-col" enctype="multipart/form-data" action="{{ route('internalResearch.update', ['internalResearch' => $data->id])}}" method="POST">
            @csrf
            @method('PUT')
            <input value="{{$data->title}}" class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Judul Penelitian" name="title" id="title" required>
            <textarea class="font-semibold px-4 text-slate-500 h-32 py-2 outline-none  border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" placeholder="Abstrak" name="abstract" id="abstract" cols="30" rows="10" required>{{$data->abstract}}</textarea>
            <input value="{{$data->budget_type}}" class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Jenis Pendanaan" name="budget_type" id="budget_type" required>
            <input value="{{$data->budget}}" class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Jumlah Biaya" name="budget" id="budget" required>
            <input value="{{date('Y-m-d', strtotime($data->project_started_at))}}"class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="date" placeholder="Waktu Mulai Penelitian" name="project_started_at" id="project_started_at" required>
            <input value="{{date('Y-m-d', strtotime($data->project_finish_at))}}" class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="date" placeholder="Waktu Mulai Penelitian" name="project_finish_at" id="project_finish_at" required>
            <input value="{{$data->contract_number}}"class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Nomor Kontrak" name="contract_number" id="contract_number" required>
            <input value="{{$data->team_member}}" class="h-12 mt-3 mb-2 px-4 border-b-2 ease-in-out delay-150 focus:border-slate-600 focus:outline-none duration-200" type="text" placeholder="Tim Penelitian" name="team_member" id="team_member" required>

            <label for="" class="px-4 mt-3 font-semibold opacity-80">File Proposal</label>
            <input class="border rounded-md file:bg-slate-600 my-2 focus:outline-none cursor-pointer file:text-white file:font-bold file:border-none file:h-12 file:w-[25%]" type="file" name="proposal_url" id="proposal_url">

            <label for="" class="px-4 font-semibold opacity-80">File Hasil Penelitian</label>
            <input class="border rounded-md file:bg-slate-600 my-2 focus:outline-none cursor-pointer file:text-white file:font-bold file:border-none file:h-12 file:w-[25%]" type="file" name="document_url" id="document_url">

            <button class="bg-[#0984E3] h-12 rounded-xl my-3 font-bold text-white" type="submit">Simpan</button>
        </form>
        
        
    </div>

@endsection