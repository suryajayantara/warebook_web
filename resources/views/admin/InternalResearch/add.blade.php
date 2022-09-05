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
                        <form enctype="multipart/form-data" action="{{ route('manageInternalResearch.store') }}"
                            method="post">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Judul Penelitian  atau Pengabdian</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('title') }}" name="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Judul Penelitian atau Pengabdian" />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Pendana</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('budget_type') }}" name="budget_type" type="text"
                                        class="form-control @error('budget_type') is-invalid @enderror"
                                        placeholder="Jenis Pendanaan" />
                                    @error('budget_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jumlah Dana</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('budget') }}" name="budget" type="text"
                                        class="form-control @error('budget') is-invalid @enderror"
                                        placeholder="Jumlah Dana" />
                                    @error('budget')
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
                                <label class="col-sm-2 col-form-label">Awal Proyek</label>
                                <div class="col-sm-10">
                                    <input value="{{ date('Y-m-d', strtotime(old('project_started_at'))) }}"
                                        name="project_started_at" type="date"
                                        class="form-control @error('project_started_at') is-invalid @enderror"
                                        placeholder="Nama Jurusan" />
                                    @error('project_started_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Akhir Proyek</label>
                                <div class="col-sm-10">
                                    <input value="{{ date('Y-m-d', strtotime(old('project_finished_at'))) }}"
                                        name="project_finished_at" type="date"
                                        class="form-control @error('project_finished_at') is-invalid @enderror" />
                                    @error('project_finished_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nomor Kontrak</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('contract_number') }}" name="contract_number" type="text"
                                        class="form-control @error('abstract') is-invalid @enderror"
                                        placeholder="Nomor Kontrak" />
                                    @error('contract_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Anggota Tim</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('team_member') }}" name="team_member" type="text"
                                        class="form-control @error('team_member') is-invalid @enderror"
                                        placeholder="Nama dipisahkan dengan semicolom (,)" />
                                    @error('team_member')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">File Proposal</label>
                                <div class="col-sm-10">
                                    <input name="proposal_url" type="file"
                                        class="form-control @error('proposal_url') is-invalid @enderror" />
                                    @error('proposal_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">File Penelitian</label>
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
                                    <a href="{{ route('manageInternalResearch.index') }}">
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
