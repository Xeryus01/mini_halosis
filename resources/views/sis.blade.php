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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:400,600,700,900" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    <style>
        .table-team td, .table-team th { vertical-align: middle !important; }
        .avatar-sm { width: 48px; height: 48px; object-fit: cover; }
        .team-name { font-size: 1.05rem; font-weight: 600; }
        .team-email { font-size: 0.9rem; color: #6c757d; }
        .team-role { font-size: 1rem; font-weight: 500; }
        .team-grade { font-size: 0.95rem; }
        .btn-edit { font-size: 0.9rem; padding: 3px 14px; }
        @media (max-width: 767.98px) {
            .table-responsive { font-size: 0.97rem; }
            .avatar-sm { width: 36px; height: 36px; }
        }
    </style>
</head>
<body class="g-sidenav-show bg-gray-100">
    @include('part.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('part.navbar')
        <div class="container-fluid py-2">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card my-4 shadow-sm">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-3 pb-2 px-3 d-flex align-items-center">
                                <span class="material-symbols-rounded text-white me-2">groups</span>
                                <h5 class="text-white text-capitalize mb-0">Tim Sistem Informasi Statistik</h5>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-hover table-team mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xs fw-bold">Nama</th>
                                            <th class="text-secondary text-xs fw-bold">Jabatan</th>
                                            <th class="text-center text-secondary text-xs fw-bold">Golongan</th>
                                            <th class="text-center text-secondary text-xs fw-bold">Masa Jabatan</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/assets/img/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 border border-2 border-primary" alt="user1">
                                                    <div>
                                                        <div class="team-name">Bambang Sri Yuwono, S.Si, M.Si</div>
                                                        <div class="team-email">bsyuwono@bps.go.id</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="team-role">Ketua Tim Pengolahan &amp; TI</div>
                                                <div class="text-muted" style="font-size:0.9rem;">Pranata Komputer Ahli Madya</div>
                                            </td>
                                            <td class="text-center team-grade">Pembina Tingkat I / IVb</td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-info text-white">
                                                    {{ date_diff(date_create(date('d-m-Y')), date_create("01-10-2018"))->format('%y Th %m Bln') }}
                                                </span>
                                            </td>
                                            @auth
    @if(auth()->user()->role === 'admin')
<td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                                    <span class="material-symbols-rounded align-middle">edit</span>
                                                </button>
                                            </td>
    @endif
@endauth
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/assets/img/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 border border-2 border-success" alt="user2">
                                                    <div>
                                                        <div class="team-name">Livio Mayesta, SST, M.A.P.</div>
                                                        <div class="team-email">livio@bps.go.id</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="team-role">Koordinator Sub Tim SIS</div>
                                                <div class="text-muted" style="font-size:0.9rem;">Pranata Komputer Ahli Muda BPS Provinsi</div>
                                            </td>
                                            <td class="text-center team-grade">Pembina / IVa</td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-info text-white">
                                                    {{ date_diff(date_create(date('d-m-Y')), date_create("01-10-2023"))->format('%y Th %m Bln') }}
                                                </span>
                                            </td>
                                            @auth
    @if(auth()->user()->role === 'admin')
<td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                                    <span class="material-symbols-rounded align-middle">edit</span>
                                                </button>
                                            </td>
    @endif
@endauth
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/assets/img/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 border border-2 border-warning" alt="user3">
                                                    <div>
                                                        <div class="team-name">Apriela Trirahma, SST</div>
                                                        <div class="team-email">apriela@bps.go.id</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="team-role">Anggota Sub Tim SIS</div>
                                                <div class="text-muted" style="font-size:0.9rem;">Pranata Komputer Ahli Muda</div>
                                            </td>
                                            <td class="text-center team-grade">Penata / IIIc</td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-info text-white">
                                                    {{ date_diff(date_create(date('d-m-Y')), date_create("01-10-2018"))->format('%y Th %m Bln') }}
                                                </span>
                                            </td>
                                            @auth
    @if(auth()->user()->role === 'admin')
<td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                                    <span class="material-symbols-rounded align-middle">edit</span>
                                                </button>
                                            </td>
    @endif
@endauth
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/assets/img/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 border border-2 border-danger" alt="user4">
                                                    <div>
                                                        <div class="team-name">Narezi Febriansa, SST</div>
                                                        <div class="team-email">narezi.febriansa@bps.go.id</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="team-role">Anggota Sub Tim SIS</div>
                                                <div class="text-muted" style="font-size:0.9rem;">Pranata Komputer Ahli Pertama</div>
                                            </td>
                                            <td class="text-center team-grade">Penata Muda Tingkat I / IIIb</td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-info text-white">
                                                    {{ date_diff(date_create(date('d-m-Y')), date_create("01-04-2020"))->format('%y Th %m Bln') }}
                                                </span>
                                            </td>
                                            @auth
    @if(auth()->user()->role === 'admin')
<td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                                    <span class="material-symbols-rounded align-middle">edit</span>
                                                </button>
                                            </td>
    @endif
@endauth
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/assets/img/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 border border-2 border-info" alt="user5">
                                                    <div>
                                                        <div class="team-name">Akhmad Fadil Mubarok, S.Tr.Stat.</div>
                                                        <div class="team-email">akhmadfadil@bps.go.id</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="team-role">Anggota Sub Tim SIS</div>
                                                <div class="text-muted" style="font-size:0.9rem;">Pranata Komputer Ahli Pertama</div>
                                            </td>
                                            <td class="text-center team-grade">Penata Muda / IIIa</td>
                                            <td class="text-center">
                                                <span class="badge bg-gradient-info text-white">
                                                    {{ date_diff(date_create(date('d-m-Y')), date_create("01-02-2023"))->format('%y Th %m Bln') }}
                                                </span>
                                            </td>
                                            @auth
    @if(auth()->user()->role === 'admin')
<td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                                    <span class="material-symbols-rounded align-middle">edit</span>
                                                </button>
                                            </td>
    @endif
@endauth
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('part.footer')
        </div>
    </main>
    @include('part.fixed-plugin')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = { damping: '0.5' }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>
</html>