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
                    <form action="{{ route('manageJournal.show', '1') }}">
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
                    <h5 class="card-header">Data Tesis</h5>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('manageJournal.create') }}" class="btn btn-md btn-primary">Tambah Data</a>
                </div>
            </div>

            <div class="">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Subject</th>
                            <th>Pemilik</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td> {{ $item->subject }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('manageJournal.edit', $item->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i>Edit
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('manageJournalDoc.create', ['journal_topics_id' => $item->id]) }}">
                                                <i class="bx bx-book-open me-1"></i>Add doc
                                            </a>
                                            <form class="dropdown-item"
                                                action="{{ route('manageJournal.destroy', $item->id) }}" method="POST">
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
