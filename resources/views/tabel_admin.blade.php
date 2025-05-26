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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    <style>
        /* Responsive table for mobile */
        @media (max-width: 767.98px) {
            .table-responsive-stack tr {
                display: flex;
                flex-direction: column;
                border-bottom: 1px solid #e0e0e0;
                margin-bottom: 1rem;
            }
            .table-responsive-stack td, .table-responsive-stack th {
                display: block;
                width: 100%;
                text-align: left !important;
                border: none !important;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            .table-responsive-stack thead {
                display: none;
            }
        }
    </style>
</head>
<body class="g-sidenav-show bg-gray-100">
    @include('part.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('part.navbar')
        <div class="container-fluid py-2">
            {{-- Permintaan Layanan Table --}}
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                <h6 class="text-white text-capitalize ps-3 mb-2 mb-md-0">Permintaan Layanan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive table-responsive-stack p-0">
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
                                        @forelse($layanan as $i => $lay)
                                        <tr>
                                            <td class="text-center" data-label="No">{{ $i+1 }}</td>
                                            <td data-label="Layanan">
                                                <p class="text-xs font-weight-bold mb-0">{{ $lay->kat_layanan }}</p>
                                                <p class="text-xs text-secondary mb-0" style="display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:45ch;">{{ $lay->desc_layanan }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm" data-label="Pengirim">
                                                <span class="badge badge-sm bg-gradient-success">{{ $lay->nama }}</span>
                                            </td>
                                            <td class="align-middle text-center" data-label="Status">
                                                @if($lay->state == 0)
                                                    <span class="badge badge-sm bg-gradient-warning">Diajukan</span>
                                                @elseif($lay->state == 1)
                                                    <span class="badge badge-sm bg-gradient-info">Diproses</span>
                                                @elseif($lay->state == 2)
                                                    <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center" data-label="Timestamp">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $lay->timestamp }}</span>
                                            </td>
                                            <td class="align-middle" data-label="Aksi">
                                                @if($lay->state == 0)
                                                    <form action="{{ route('layanan.proses', [$lay->tiket_number, '1']) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                                                    </form>
                                                @elseif($lay->state == 1)
                                                    <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#permintaanModal"
                                                        data-bs-tiket="{{ $lay->tiket_number }}"
                                                        data-bs-nama="{{ $lay->nama }}"
                                                        data-bs-layanan="{{ $lay->kat_layanan }}"
                                                        data-bs-desc="{{ $lay->desc_layanan }}">
                                                        Tindak Lanjut
                                                    </a>
                                                @elseif($lay->state == 2)
                                                    <a type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal"
                                                        data-bs-tiket="{{ $lay->tiket_number }}"
                                                        data-bs-nama="{{ $lay->nama }}"
                                                        data-bs-desc="{{ $lay->desc_layanan }}"
                                                        data-bs-tl="{{ $lay->tindak_lanjut }}">
                                                        Detail
                                                    </a>
                                                @endif
                                                @auth
                                                    @if(auth()->user()->role === 'admin')
                                                        <form action="{{ route('layanan.destroy', $lay->tiket_number) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                                <span class="material-symbols-rounded align-middle">delete</span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Tidak ada data layanan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Laporan Gangguan Table --}}
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                <h6 class="text-white text-capitalize ps-3 mb-2 mb-md-0">Laporan Gangguan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive table-responsive-stack p-0">
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
                                        @forelse($gangguan as $i => $gang)
                                        <tr>
                                            <td class="text-center" data-label="No">{{ $i+1 }}</td>
                                            <td data-label="Nama">
                                                <p class="text-sm font-weight-bold mb-0">{{ $gang->nama }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm" data-label="Tim Kerja">
                                                <span class="badge badge-sm bg-gradient-success">
                                                    @switch($gang->tim_kerja)
                                                        @case(1) Kepala BPS @break
                                                        @case(2) Sekretaris @break
                                                        @case(3) Neraca @break
                                                        @case(4) Sosial @break
                                                        @case(5) Distribusi @break
                                                        @case(6) Produksi @break
                                                        @case(7) PTI @break
                                                        @case(8) Diseminasi @break
                                                        @case(9) Pembinaan Sektoral @break
                                                        @case(10) Umum Atas @break
                                                        @case(11) Umum Bawah @break
                                                        @default Tidak Diketahui
                                                    @endswitch
                                                </span>
                                            </td>
                                            <td data-label="Deskripsi">
                                                <p class="text-xs font-weight-bold mb-0" style="display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:70ch;">{{ $gang->desc_gangguan }}</p>
                                            </td>
                                            <td class="align-middle text-center" data-label="Status">
                                                @if($gang->state == 0)
                                                    <span class="badge badge-sm bg-gradient-warning">Diajukan</span>
                                                @elseif($gang->state == 1)
                                                    <span class="badge badge-sm bg-gradient-info">Diproses</span>
                                                @elseif($gang->state == 2)
                                                    <span class="badge badge-sm bg-gradient-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="align-middle" data-label="Aksi">
                                                @if($gang->state == 0)
                                                    <form action="{{ route('gangguan.proses', [$gang->tiket_number, '1']) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">Proses</button>
                                                    </form>
                                                @elseif($gang->state == 1)
                                                    <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#gangguanModal"
                                                        data-bs-tiket="{{ $gang->tiket_number }}"
                                                        data-bs-nama="{{ $gang->nama }}"
                                                        data-bs-desc="{{ $gang->desc_gangguan }}">
                                                        Tindak Lanjut
                                                    </a>
                                                @elseif($gang->state == 2)
                                                    <a type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal"
                                                        data-bs-tiket="{{ $gang->tiket_number }}"
                                                        data-bs-nama="{{ $gang->nama }}"
                                                        data-bs-desc="{{ $gang->desc_gangguan }}"
                                                        data-bs-tl="{{ $gang->tindak_lanjut }}">
                                                        Detail
                                                    </a>
                                                @endif
                                                @auth
                                                    @if(auth()->user()->role === 'admin')
                                                        <form action="{{ route('gangguan.destroy', $gang->tiket_number) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus laporan gangguan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                                <span class="material-symbols-rounded align-middle">delete</span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Tidak ada data gangguan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Footer --}}
            @include('part.footer')
        </div>
    </main>

    {{-- Modals --}}
    <!-- Permintaan Modal -->
    <div class="modal fade" id="permintaanModal" tabindex="-1" role="dialog" aria-labelledby="permintaanModalLabel" aria-hidden="true">
        <form action="{{ route('layanan.tl') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="permintaanModalLabel">Modal Permintaan</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="token" id="permintaan_token">
                        <div class="input-group input-group-static mb-3">
                            <label>Pemohon</label>
                            <input id="permintaan_nama" type="text" class="form-control" readonly>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label>Kategori Layanan</label>
                            <input id="permintaan_layanan" type="text" class="form-control" readonly>
                        </div>
                        <div class="input-group input-group-static">
                            <label>Deskripsi Permintaan</label>
                            <div id="permintaan_desc" class="form-control"></div>
                        </div>
                        <div class="py-4">
                            <p class="font-weight-bold mt-2 mb-1">Tindak Lanjut</p>
                            <div class="input-group input-group-outline mb-4">
                                <textarea class="form-control" name="tindak_lanjut" rows="5"></textarea>
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
        <form action="{{ route('gangguan.tl') }}" method="post">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="gangguanModalLabel">Modal Gangguan</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="token" id="gangguan_token">
                        <div class="input-group input-group-static mb-3">
                            <label>Pelapor</label>
                            <input id="gangguan_nama" type="text" class="form-control" readonly>
                        </div>
                        <div class="input-group input-group-static">
                            <label>Deskripsi Masalah</label>
                            <div id="gangguan_desc" class="form-control"></div>
                        </div>
                        <div class="py-4">
                            <p class="font-weight-bold mt-2 mb-1">Tindak Lanjut</p>
                            <div class="input-group input-group-outline mb-4">
                                <textarea class="form-control" name="tindak_lanjut" rows="5"></textarea>
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
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-static mb-3">
                            <label>Pemohon</label>
                            <input id="detail_nama" type="text" class="form-control" readonly>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label>Deskripsi Masalah</label>
                            <div id="detail_desc" class="form-control"></div>
                        </div>
                        <div class="input-group input-group-static">
                            <label>Tindak Lanjut</label>
                            <div id="detail_tl" class="form-control"></div>
                        </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            var confirmModal = document.getElementById('confirmModal');
            if (confirmModal) {
                confirmModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var formAction = button.getAttribute('data-form-action');
                    var confirmForm = document.getElementById('confirmForm');
                    confirmForm.setAttribute('action', formAction);
                });
            }

            @if(session('success'))
                var successToast = new bootstrap.Toast(document.getElementById('successToast'));
                successToast.show();
            @endif

            @if(session('error'))
                var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                errorToast.show();
            @endif
        });

        $('#permintaanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            $('#permintaan_token').val(button.data('bs-tiket'));
            $('#permintaan_nama').val(button.data('bs-nama'));
            $('#permintaan_layanan').val(button.data('bs-layanan'));
            $('#permintaan_desc').text(button.data('bs-desc'));
            $('#permintaanModalLabel').text("Tiket: " + button.data('bs-tiket'));
        });

        $('#gangguanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            $('#gangguan_token').val(button.data('bs-tiket'));
            $('#gangguan_nama').val(button.data('bs-nama'));
            $('#gangguan_desc').text(button.data('bs-desc'));
            $('#gangguanModalLabel').text("Tiket: " + button.data('bs-tiket'));
        });

        $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            $('#detail_nama').val(button.data('bs-nama'));
            $('#detail_desc').text(button.data('bs-desc'));
            $('#detail_tl').text(button.data('bs-tl'));
            $('#detailModalLabel').text("Tiket: " + button.data('bs-tiket'));
        });

        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = { damping: '0.5' }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>
</html>