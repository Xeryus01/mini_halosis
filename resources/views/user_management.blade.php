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
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                <span><span class="material-symbols-rounded align-middle me-2">manage_accounts</span> Manajemen User</span>
                <a href="{{ route('manage.create') }}" class="btn btn-sm btn-success">
                    <span class="material-symbols-rounded align-middle">person_add</span> Tambah User
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-xs text-secondary fw-bold">Nama</th>
                                <th class="text-xs text-secondary fw-bold">Email</th>
                                <th class="text-xs text-secondary fw-bold">Role</th>
                                <!-- <th class="text-xs text-secondary fw-bold">Status</th> -->
                                <th class="text-xs text-secondary fw-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->photo_url ? asset('code/storage/app/public/' . $user->photo_url) : asset('assets/img/avatar.png') }}"
                                            class="avatar avatar-sm rounded-circle me-2 border border-2 border-primary" alt="user">
                                        <div>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <div class="text-muted small">{{ $user->username ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-gradient-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'pj' ? 'warning' : ($user->role === 'user' ? 'info' : 'secondary')) }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <!-- <td>
                                    @if($user->is_active)
                                        <span class="badge bg-gradient-success">Aktif</span>
                                    @else
                                        <span class="badge bg-gradient-secondary">Nonaktif</span>
                                    @endif
                                </td> -->
                                <td class="text-center">
                                    <a href="{{ route('manage.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <span class="material-symbols-rounded align-middle">edit</span>
                                    </a>
                                    @if(auth()->user()->id !== $user->id)
                                    <form action="{{ route('manage.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <span class="material-symbols-rounded align-middle">delete</span>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('part.footer')
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
            var options = { damping: '0.5' }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>
</html>