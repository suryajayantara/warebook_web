@extends('layouts.app_admin')

@section('contents')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-7">
                            <div class="card-body">
                                <h1 class="card-title text-primary">Selamat Datang Admin 🎉</h1>
                                <p class="mb-4">
                                    Masalah adalah cara Tuhan tuk membuatmu dewasa, jangan lari darinya tapi hadapilah.
                                    Hanya mereka yang membuatmu bijaksana
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-3 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Tesis</span>
                                <h3 class="card-title mb-2">{{ $data['thesis'] }}</h3>
                                <small class="text-success fw-semibold">Repositori</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">PKM</span>
                                <h3 class="card-title mb-2">{{ $data['creativity'] }}</h3>
                                <small class="text-success fw-semibold">Dokumen</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="d-block mb-1">Jurnal</span>
                                <h3 class="card-title text-nowrap mb-2">{{ $data['journal'] }}</h3>
                                <small class="text-success fw-semibold">Dokumen</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Penelitian</span>
                                <h3 class="card-title mb-2">{{ $data['internal'] }}</h3>
                                <small class="text-success fw-semibold">Repositori</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Jumlah Pengguna</h5>
                                    <div class="mt-sm-auto">
                                        <h3 class="mb-0">{{ $data['user'] }}</h3>
                                    </div>
                                </div>
                                <span class="badge bg-label-warning rounded-pill">Pengguna Baru</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
