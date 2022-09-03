@extends('layouts.app_admin')

@section('contents')
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <form action="{{ route('report.index') }}" class="flex-grow">
                <div class="d-flex">
                    <div class="flex-grow mr-4">
                        <div class="w-full navbar-nav align-items-center">
                            <div class=" w-full nav-item d-flex align-items-center  shadow-sm rounded-sm  ">
                                <select name='type' class=" w-full form-control border-0" required>
                                    <option value="" selected disabled>Pilih Jenis Repositori</option>
                                    <option value="thesis" @if ($type == 'thesis') selected @endif>Tesis</option>
                                    <option value="pkm" @if ($type == 'pkm') selected @endif>PKM</option>
                                    <option value="journal" @if ($type == 'journal') selected @endif>Journal
                                    </option>
                                    <option value="internal" @if ($type == 'internal') selected @endif>Penelitian
                                        Dosen</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-25">
                        <div class="navbar-nav align-items-center w-full ">
                            <div class="nav-item d-flex align-items-center w-full  shadow-sm px-2 rounded-sm">
                                <input required name="date_start" type="date" value="{{ $date_start }}"
                                    class="w-full form-control border-0 shadow-none" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-2
                                    pt-2">
                        S/D
                    </div>
                    <div class="w-25">
                        <div class="w-full navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center w-full shadow-sm px-2 rounded-sm">
                                <input required name="date_end" type="date" value="{{ $date_end }}"
                                    class=" w-full form-control border-0 shadow-none" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            <!-- /Search -->
        </div>
    </nav>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="row mt-2">
                <div class="col-md-10">
                    <h5 class="card-header">Data</h5>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('report.store') }}" class="float-right mr-6" method="post">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="date_start" value="{{ $date_start }}">
                        <input type="hidden" name="date_end" value="{{ $date_end }}">
                        <button class="btn btn-success">Print</button>
                    </form>
                </div>
            </div>

            <div class="">
                <table class="table text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Pengupload</th>
                            <th>Tahun</th>
                            <th>Tanggal Upload</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if ($type == 'internal')
                                        {{ $item->team_member }}
                                    @else
                                        {{ $item->author }}
                                    @endif
                                </td>
                                <td>
                                    @if ($type == 'journal')
                                        {{ $item->user->name }}
                                    @else
                                        {{ $item->users->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($type == 'thesis')
                                        {{ $item->created_year }}
                                    @else
                                        @if ($type == 'internal')
                                            {{ $item->project_finish_at }}
                                        @else
                                            {{ $item->year }}
                                        @endif
                                    @endif
                                </td>
                                <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <div class="mb-3 mt-2">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
