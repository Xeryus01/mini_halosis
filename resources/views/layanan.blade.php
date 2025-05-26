<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        @yield('title', 'mini Halo-SIS') | {{ config('app.name') }}
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    <link href="{{ asset('assets/scss/form.scss') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>

<body class="g-sidenav-show  bg-gray-100">

    @include('part.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('part.navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class=" mt-4 mb-4">
                    <form action="{{ route('post_layanan') }}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger d-flex align-items-start gap-3 py-3 px-4 mb-4 rounded-3 shadow-sm border-0" role="alert" style="background: #fff0f1;">
                                <span class="material-symbols-rounded flex-shrink-0 text-danger" style="font-size:2.2rem;line-height:1;">error</span>
                                <div>
                                    <div class="fw-bold mb-2 text-danger" style="font-size:1.1rem;">Terjadi Kesalahan</div>
                                    <ul class="mb-0 ps-3 small" style="list-style-type: disc;">
                                        @foreach ($errors->all() as $error)
                                            <li class="mb-1">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @csrf <!-- {{ csrf_field() }} -->

                        <div class="card">
                            <div class="card-body row g-3">

                                <h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify">
                                        <line x1="21" y1="10" x2="3" y2="10" />
                                        <line x1="21" y1="6" x2="3" y2="6" />
                                        <line x1="21" y1="14" x2="3" y2="14" />
                                        <line x1="21" y1="18" x2="3" y2="18" />
                                    </svg>
                                    Permintaan Layanan
                                </h1>
                                <br>
                                <p>Masukan informasi yang dibutuhkan untuk pembuatan layanan</p>

                                <div class="nice-form-group col-md-6">
                                    <label>Nama</label>
                                    <input type="text" name="nama" placeholder="Masukkan nama" value="" />
                                </div>

                                <div class="nice-form-group col-md-6">
                                    <label>No Telepon</label>
                                    <input type="tel" name="no_telp" placeholder="Masukkan no telepon" value="" />
                                </div>

                                <!-- <div class="nice-form-group">
                                <label>Email</label>
                                <input type="email" placeholder="Your email" value="" />
                            </div> -->

                                <div class="nice-form-group">
                                    <label>Tim Kerja</label>
                                    <select name="tim_kerja">
                                        <option disabled>pilih satu bidang</option>
                                        <option value="1">Kepala BPS</option>
                                        <option value="2">Sekretaris</option>
                                        <option value="3">Neraca</option>
                                        <option value="4">Sosial</option>
                                        <option value="5">Distribusi</option>
                                        <option value="6">Produksi</option>
                                        <option value="7">PTI</option>
                                        <option value="8">Diseminasi</option>
                                        <option value="9">Pembinaan Sektoral</option>
                                        <option value="10">Umum Atas</option>
                                        <option value="11">Umum Bawah</option>
                                    </select>
                                </div>

                                <div class="nice-form-group col-md-6">
                                    <label>Kategori Layanan</label>
                                    <select name="kat_layanan" id="kat_layanan">
                                        <option disabled selected>pilih satu layanan</option>
                                        <option value="1">Koneksi Jaringan</option>
                                        <option value="2">Komunikasi</option>
                                        <option value="3">Hosting</option>
                                        <option value="4">Penyimpanan dan Berbagi Data</option>
                                        <option value="5">Piranti Lunak</option>
                                        <option value="6">Perangkat Keras</option>
                                        <option value="7">Pembangunan dan Pengembangan Aplikasi</option>
                                        <option value="8">Pengolahan</option>
                                    </select>
                                </div>

                                <div class="nice-form-group col-md-6">
                                    <label>Nama Layanan</label>
                                    <select name="subkat_layanan" id="nama_layanan">
                                        <option disabled selected>pilih satu layanan</option>
                                    </select>
                                </div>

                                <div class="nice-form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="desc_layanan" rows="5" value=""></textarea>
                                </div>

                                <br>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2">
                                        <span class="material-symbols-rounded align-middle me-1" style="font-size: 1.2rem;">send</span>
                                        Submit
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('part.footer')
        </div>
    </main>

    <!-- Toast Notification -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div class="toast align-items-center text-white bg-success border-0" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div class="toast align-items-center text-white bg-danger border-0" id="errorToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    @include('part.fixed-plugin')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                var successToast = new bootstrap.Toast(document.getElementById('successToast'));
                successToast.show();
            @endif

            @if(session('error'))
                var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                errorToast.show();
            @endif
        });
    </script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
    <script src="{{ asset('/assets/js/form.js') }}"></script>
</body>

</html>