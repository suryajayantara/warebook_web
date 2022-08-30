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
                        <h5 class="mb-0">Edit Data Repositori</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('manageThesis.store') }}" method="post">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Penulis</label>
                                <div class="col-sm-10">
                                    <input name="author" type="text" value="{{ old('author') }}"
                                        class="form-control @error('author') is-invalid @enderror"
                                        placeholder="Nama Jurusan" />
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Tesis</label>
                                <div class="col-sm-10">
                                    <select name="thesis_type"
                                        class="form-control @error('thesis_type') is-invalid @enderror"
                                        aria-label="Default select example">
                                        <option value="" selected disabled>Pilih jenis tesis</option>
                                        <option value="Skripsi">Skripsi</option>
                                        <option value="Tugas Akhir">Tugas Akhir</option>
                                    </select>
                                    @error('thesis_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Judul Tesis" />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kata Kunci</label>
                                <div class="col-sm-10">
                                    <input name="tags" type="text" value="{{ old('tags') }}"
                                        class="form-control @error('tags') is-invalid @enderror" placeholder="Kata Kunci" />
                                    @error('tags')
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
                                <label class="col-sm-2 col-form-label">Tahun Pembuatan</label>
                                <div class="col-sm-10">
                                    <input name="created_year" type="number" value="{{ old('created_year') }}"
                                        class="form-control @error('created_year') is-invalid @enderror"
                                        placeholder="Tahun Pembuatan" />
                                    @error('created_year')
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
