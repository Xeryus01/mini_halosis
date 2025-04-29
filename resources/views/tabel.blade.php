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
        Material Dashboard 3 by Creative Tim
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
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('part\sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('part\navbar')

        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Permintaan Layanan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Layanan</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengirim</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Timestamp</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i = 1)
                                        @foreach($layanan as $lay)
                                        <tr>
                                            <td>
                                                <div class="d-flex py-1">
                                                    <div class="mx-auto">
                                                        <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $lay->kat_layanan }}</p>
                                                <p class="text-xs text-secondary mb-0" style="  display:inline-block;  white-space: nowrap;   overflow: hidden;  text-overflow: ellipsis;  max-width: 45ch;">{{ $lay->desc_layanan }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">{{ $lay->nama }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                            @if($lay->state == 0)
                                                <span class="badge badge-sm bg-gradient-warning">Diajukan</span>
                                            @elseif($lay->state == 1)
                                                <span class="badge badge-sm bg-gradient-info">Diproses</span>
                                            @elseif($lay->state == 2)
                                                <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                            @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $lay->timestamp }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <!-- Button trigger modal -->
                                                @if($lay->state == 0)
                                                    <form action=" {{ route('layanan.proses', [$lay->tiket_number, '1']) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                                                    </form>
                                                @elseif($lay->state == 1)
                                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal" 
                                                        data-form-action="{{ route('layanan.proses', [$lay->tiket_number, '2']) }}">
                                                        Selesaikan
                                                    </button>
                                                    <a type="button" class="btn btn-sm btn-info"  data-bs-toggle="modal" data-bs-target="#permintaanModal" data-bs-tiket="{{ $lay->tiket_number }}" data-bs-nama="{{ $lay->nama }}" data-bs-layanan="{{ $lay->kat_layanan }}" data-bs-desc="{{ $lay->desc_layanan }}">
                                                    Tindak Lanjut
                                                    </a>
                                                @elseif($lay->state == 2)
                                                    <a type="button" class="btn btn-sm btn-info"  data-bs-toggle="modal" data-bs-target="#detailModal" data-bs-tiket="{{ $lay->tiket_number }}" data-bs-nama="{{ $lay->nama }}" data-bs-desc="{{ $lay->desc_layanan }}" data-bs-tl="{{ $lay->tindak_lanjut }}">
                                                    Detail
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @php($i++)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Laporan Gangguan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tim Kerja</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i = 1)
                                        @foreach($gangguan as $gang)
                                        <tr>
                                        <td>
                                                <div class="d-flex py-1">
                                                    <div class="mx-auto">
                                                        <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $gang->nama }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">
                                                @if($gang->tim_kerja == 1)
                                                    Kepala BPS
                                                @elseif($gang->tim_kerja == 2)
                                                    Sekretaris
                                                @elseif($gang->tim_kerja == 3)
                                                    Neraca
                                                @elseif($gang->tim_kerja == 4)
                                                    Sosial
                                                @elseif($gang->tim_kerja == 5)
                                                    Distribusi
                                                @elseif($gang->tim_kerja == 6)
                                                    Produksi
                                                @elseif($gang->tim_kerja == 7)
                                                    PTI
                                                @elseif($gang->tim_kerja == 8)
                                                    Diseminasi
                                                @elseif($gang->tim_kerja == 9)
                                                    Pembinaan Sektoral
                                                @elseif($gang->tim_kerja == 10)
                                                    Umum Atas
                                                @elseif($gang->tim_kerja == 11)
                                                    Umum Bawah
                                                @else
                                                    Tidak Diketahui
                                                @endif
                                                </span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0" style="  display:inline-block;  white-space: nowrap;   overflow: hidden;  text-overflow: ellipsis;  max-width: 70ch">{{ $gang->desc_gangguan }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($gang->state == 0)
                                                    <span class="badge badge-sm bg-gradient-warning">Diajukan</span>
                                                @elseif($gang->state == 1)
                                                    <span class="badge badge-sm bg-gradient-info">Diproses</span>
                                                @elseif($gang->state == 2)
                                                    <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <!-- Button trigger modal -->
                                                @if($gang->state == 0)
                                                    <form action=" {{ route('gangguan.proses', [$gang->tiket_number, '1']) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                                                    </form>
                                                @elseif($gang->state == 1)
                                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal" 
                                                        data-form-action="{{ route('gangguan.proses', [$gang->tiket_number, '2']) }}">
                                                        Selesaikan
                                                    </button>
                                                    <a type="button" class="btn btn-sm btn-info"  data-bs-toggle="modal" data-bs-target="#gangguanModal" data-bs-tiket="{{ $gang->tiket_number }}" data-bs-nama="{{ $gang->nama }}" data-bs-desc="{{ $gang->desc_gangguan }}">
                                                    Tindak Lanjut
                                                    </a>
                                                @elseif($gang->state == 2)
                                                    <a type="button" class="btn btn-sm btn-info"  data-bs-toggle="modal" data-bs-target="#detailModal" data-bs-tiket="{{ $gang->tiket_number }}" data-bs-nama="{{ $gang->nama }}" data-bs-desc="{{ $gang->desc_gangguan }}" data-bs-tl="{{ $gang->tindak_lanjut }}">
                                                    Detail
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        
                                        @php($i++)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

    <!-- Permintaan Modal -->
    <div class="modal fade" id="permintaanModal" tabindex="-1" role="dialog" aria-labelledby="permintaanModalLabel" aria-hidden="true">
        <form action=" {{ route('layanan.tl') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="permintaanModalLabel">Modal Permintaan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="token" id="permintaan_token">

                    <div>
                        <div class="input-group input-group-static mb-3">
                            <label>Pemohon</label>
                            <input id="permintaan_nama" type="text" class="form-control" value="Fadil" readonly>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label>Kategori Layanan</label>
                            <input id="permintaan_layanan" type="text" class="form-control" value="Permintaan Piranti Lunak" readonly>
                        </div>
                        <div class="input-group input-group-static">
                            <label>Deskripsi Permintaan</label>
                            <div id="permintaan_desc" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="py-4">
                        <p class="font-weight-bold mt-2 mb-1">Tindak Lanjut</p>
                        <div class="input-group input-group-outline mb-4">
                        <textarea class="form-control" name="tindak_lanjut" rows="5" value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Gangguan Modal -->
    <div class="modal fade" id="gangguanModal" tabindex="-1" role="dialog" aria-labelledby="gangguanModalLabel" aria-hidden="true">
        <form action=" {{ route('gangguan.tl') }} " method="post">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="gangguanModalLabel">Modal Gangguan  </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="token" id="gangguan_token">
                    <div class="input-group input-group-static mb-3">
                        <label>Pelapor</label>
                        <input id="gangguan_nama" type="text" class="form-control" value="Fadil" readonly>
                    </div>
                    <div class="input-group input-group-static">
                        <label>Deskripsi Masalah</label>
                        <div id="gangguan_desc" class="form-control">
                        </div>
                    </div>

                    <div class="py-4">
                        <p class="font-weight-bold mt-2 mb-1">Tindak Lanjut</p>
                        <div class="input-group input-group-outline mb-4">
                        <textarea class="form-control" name="tindak_lanjut" rows="5" value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                </div>
                </div>
            </div>
        </form>
    </div>

    
    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <form action="" method="post">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="detailModalLabel">Modal Gangguan</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-static mb-3">
                            <label>Pemohon</label>
                            <input id="detail_nama" type="text" class="form-control" value="Fadil" readonly>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label>Deskripsi Masalah</label>
                            <div id="detail_desc" class="form-control">
                            </div>
                        </div>
                        <div class="input-group input-group-static">
                            <label>Tindak Lanjut</label>
                            <div id="detail_tl" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="py-4">
                            <p class="font-weight-bold mt-2 mb-1">Tindak Lanjut</p>
                            <div class="input-group input-group-outline mb-4">
                            <textarea id="detail_tl" class="form-control" name="tindak_lanjut" rows="5" value=""></textarea>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Benarkah ingin menyelesaikan tanpa tindak lanjut?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="confirmForm" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Ya, Selesaikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('part\fixed-plugin')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var confirmModal = document.getElementById('confirmModal');
            confirmModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Tombol yang memicu modal
                var formAction = button.getAttribute('data-form-action'); // Ambil URL dari tombol
                var confirmForm = document.getElementById('confirmForm');
                confirmForm.setAttribute('action', formAction); // Set URL ke form
            });
        });
    </script>

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

        $('#permintaanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this)

            const tiket = button[0].getAttribute('data-bs-tiket');
            const nama = button[0].getAttribute('data-bs-nama');
            const layanan = button[0].getAttribute('data-bs-layanan');
            const desc_layanan = button[0].getAttribute('data-bs-desc');

            $('#permintaan_token').val(tiket);
            $('#permintaan_nama').val(nama);
            $('#permintaan_layanan').val(layanan);
            $('#permintaan_desc').text(desc_layanan);
            $('#permintaanModalLabel').text("Tiket: " + tiket)
        })

        $('#gangguanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this)

            const tiket = button[0].getAttribute('data-bs-tiket');
            const nama = button[0].getAttribute('data-bs-nama');
            const desc_gangguan = button[0].getAttribute('data-bs-desc');

            $('#gangguan_token').val(tiket);
            $('#gangguan_nama').val(nama);
            $('#gangguan_desc').text(desc_gangguan);
            $('#gangguanModalLabel').text("Tiket: " + tiket);
        })

        $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this)

            const tiket = button[0].getAttribute('data-bs-tiket');
            const nama = button[0].getAttribute('data-bs-nama');
            const desc_detail = button[0].getAttribute('data-bs-desc');
            const tl = button[0].getAttribute('data-bs-tl');

            $('#detail_nama').val(nama);
            $('#detail_desc').text(desc_detail);
            $('#detail_tl').text(tl);
            $('#detailModalLabel').text("Tiket: " + tiket);
        })
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>

</html>