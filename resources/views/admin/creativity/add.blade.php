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
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                        aria-label="Search..." disabled />
                </div>
            </div>
            <!-- /Search -->
        </div>
    </nav>

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row  mt-10">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Data Repositori</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('manageCreativity.store') }}" method="post">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Penulis</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('author') }}" name="author" type="text"
                                        class="form-control @error('author') is-invalid @enderror"
                                        placeholder="Penulis PKM" />
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tipe PKM</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('creativity_type') }}" name="creativity_type" type="text"
                                        class="form-control @error('creativity_type') is-invalid @enderror"
                                        placeholder="Jenis PKM" />
                                    @error('creativity_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('title') }}" name="title" type="text"
                                        class="@error('title') is-invalid @enderror form-control" placeholder="Judul PKM" />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Alias</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('aliases') }}" name="aliases" type="text"
                                        class="form-control @error('aliases') is-invalid @enderror"
                                        placeholder="Nama Alias" />
                                    @error('aliases')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Abstrak</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" name="abstract" class="form-control @error('abstract') is-invalid @enderror"
                                        placeholder="Deskpripsi Jurusan" aria-describedby="basic-icon-default-message2">{{ old('abstract') }}</textarea>
                                    @error('abstract')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('year') }}" name="year" type="number"
                                        class="form-control @error('abstract') is-invalid @enderror"
                                        placeholder="Tahun Pembuatan" />
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pembimbing</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('supervisor') }}" name="supervisor" type="text"
                                        class="form-control @error('supervisor') is-invalid @enderror"
                                        placeholder="Nama Pembimbing  " />
                                    @error('supervisor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <input name="document_url" type="file"
                                        class="form-control @error('document_url') is-invalid @enderror" />
                                    @error('document_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    <a href="{{ route('manageThesis.index') }}">
                                        {{-- kembali --}}
                                        <button type="button" class="btn btn-warning">Kembali</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
