@extends('layouts.app_admin')

@section('contents')
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <form action="{{ route('manageInternalResearch.show', ['manageInternalResearch' => '1']) }}">
                        @csrf
                        @method('PUT')
                        <input name="search" type="text" class="form-control border-0 shadow-none"
                            placeholder="Search..." aria-label="Search..." />
                    </form>
                </div>
            </div>
            <!-- /Search -->
        </div>
    </nav>

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row mt-2">
                <div class="col-md-10">
                    <h5 class="card-header">Data Penelitian & Pengabdian Dosen</h5>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('manageInternalResearch.create') }}" class="btn btn-md btn-primary">Tambah Data</a>
                </div>
            </div>

            <div class="">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Sumber Dana</th>
                            <th>Jumlah Dana</th>
                            <th>Mulai Proyek</th>
                            <th>Akhir Proyek</th>
                            <th>Nomor Kontrak</th>
                            <th>Anggota</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td> {{ $item->budget_type }}</td>
                                <td>{{ 'Rp. ' . number_format($item->budget, 2, ',', '.') }}</td>
                                <td>{{ date('Y-m-d', strtotime($item->project_started_at)) }}</td>
                                <td>{{ date('Y-m-d', strtotime($item->project_finish_at)) }}</td>
                                <td>{{ $item->contract_number }}</td>
                                <td>{{ $item->team_member }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ asset($item->proposal_url) }}">
                                                <i class="bx bx-book-open me-1"></i>Lihat Proposal
                                            </a>
                                            <a class="dropdown-item" href="{{ asset($item->document_url) }}">
                                                <i class="bx bx-book-open me-1"></i>Lihat Dokumen
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('manageInternalResearch.edit', $item->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i>Edit
                                            </a>
                                            <form class="dropdown-item"
                                                action="{{ route('manageInternalResearch.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"><i class="bx bx-trash me-1"></i> Delete
                                            </form></button>
                                        </div>
                                    </div>
                                </td>
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
