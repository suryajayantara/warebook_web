<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('assets/js/config.js') }}"></script>

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <span class="app-brand-logo demo">
                        <img src="{{ asset('img/icon/icon.svg') }}" alt="">
                    </span>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item ">
                        <a href="{{ route('dashboard.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-data"></i>
                            <div data-i18n="Layouts">Master Data</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('departements.index') }}" class="menu-link">
                                    <div data-i18n="Without menu">Jurusan</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('studies.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Program Studi</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('users.index') }}" class="menu-link">
                                    <div data-i18n="Container">Pengguna</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('report.index') }}" class="menu-link">
                                    <div data-i18n="Container">Laporan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Mahasiswa</span>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Layouts">Tesis</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('manageThesis.index') }}" class="menu-link">
                                    <div data-i18n="Without menu">Repositori</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('manageThesisDoc.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Dokumen</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item ">
                        <a href="{{ route('manageCreativity.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-dock-bottom"></i>
                            <div data-i18n="Analytics">Program Kreativitas Mahasiswa</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Dosen</span>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Layouts">Jurnal Dosen</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('manageJournal.index') }}" class="menu-link">
                                    <div data-i18n="Without menu">Repositori</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('manageJournalDoc.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Dokumen</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item ">
                        <a href="{{ route('manageInternalResearch.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-detail"></i>
                            <div data-i18n="Analytics">Penelitian & Pengabdian Dosen</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Sistem</span>
                    </li>

                    <li class="menu-item ">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="menu-link">
                            @csrf
                            <i class="menu-icon tf-icons bx bx-power-off"></i>
                            <button type="submit">Logout</button>
                        </form>
                    </li>




                </ul>
            </aside>


            <div class="layout-page">

                <div class="content-wrapper">
                    @yield('contents')
                </div>


            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
