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
                <h5 class="mb-0">Tambah Data Jurusan</h5>
              </div>
              <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('users.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Ubah Jenis akun</label>
                    <div class="col-sm-10">
                        <select name="role" id="id_faculty" class="form-control @error('departement_id') is-invalid @enderror" aria-label="Default select example">
                            <option value="" selected>Pilih Jenis Akun</option>
                            <option value="student">Mahasiswa</option>
                            <option value="lecture">Dosen</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Nama</label>
                    <div class="col-sm-10">
                        <input value="{{$data->user->name}}" name="name" type="text" class="form-control" placeholder="Nama Jurusan" required />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >email</label>
                    <div class="col-sm-10">
                        <input value="{{$data->user->email}}" name="email" type="email" class="form-control" placeholder="Email" required />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >No. Identitas</label>
                    <div class="col-sm-10">
                        <input value="{{$data->unique_id}}"name="unique_id" type="text" class="form-control" placeholder="Nomor Idntitas" required/>
                        @error('unique_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Program Studi</label>
                    <div class="col-sm-10">
                        <select name="studies_id" id="id_faculty" class="form-control @error('studies_id') is-invalid @enderror" aria-label="Default select example" required>
                            <option value="" selected>Program Studi</option>
                            <option value="{{$data->study_id}}" selected>{{$data->studies->studies_name}}</option>
                            @foreach ($studies_data as $studies)
                                @if ($studies->id != $data->study_id)
                                    <option value="{{ $studies->id }}">{{ $studies->studies_name }} - {{ $studies->departements->departement_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('studies_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" >Password Baru</label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" placeholder="Password"/>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
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