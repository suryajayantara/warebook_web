@extends('layouts.app_admin')

@section('contents')

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
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
        <input
            type="text"
            class="form-control border-0 shadow-none"
            placeholder="Search..."
            aria-label="Search..."
        disabled/>
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
                <h5 class="mb-0">Tambah Data Program Studi</h5>
              </div>
              <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('studies.store') }}" method="post">
                    @csrf

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Nama</label>
                    <div class="col-sm-10">
                        <select name="departement_id" id="id_faculty" class="form-control @error('departement_id') is-invalid @enderror" aria-label="Default select example" required>
                            <option value="" selected>Pilih Jurusan</option>
                            @foreach ($departement_data as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->departement_name }}</option>
                            @endforeach
                        </select>
                        @error('departement_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Nama</label>
                    <div class="col-sm-10">
                        <input name="studies_name" type="text" class="form-control" placeholder="Nama Jurusan" />
                        @error('studies_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Deskripsi</label>
                    <div class="col-sm-10">
                      <textarea 
                        rows="5"
                        name="desc"
                        class="form-control"
                        placeholder="Deskpripsi Jurusan"
                        aria-describedby="basic-icon-default-message2"
                      ></textarea>
                    </div>
                  </div>
                  <div class="row justify-content-end">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Send</button>
                      <a href="{{ route('studies.index') }}">
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