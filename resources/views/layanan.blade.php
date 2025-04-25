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
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Material Dashboard 3 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
    <link href="../assets/scss/form.scss" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-100">

    @include('part\sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('part\navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class=" mt-4 mb-4">
                    <form action="/post_layanan" method="post">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @csrf <!-- {{ csrf_field() }} -->

                        <div class="card">
                            <div class="card-body">

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

                                <div class="nice-form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" placeholder="Masukkan nama" value="" />
                                </div>

                                <div class="nice-form-group">
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

                                <div class="nice-form-group">
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

                                <div class="nice-form-group">
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

                                <button type="submit" class="btn btn-success">Submit</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
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

    @include('part\fixed-plugin')

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
    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
    <script src="../assets/js/form.js"></script>
</body>

</html>