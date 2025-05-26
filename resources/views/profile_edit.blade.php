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
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('part.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('part.navbar')

        <div class="container-fluid py-2">
            @section('content')
            <div class="container-fluid px-2 px-md-4">
                <div class="page-header min-height-200 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?auto=format&fit=crop&w=1920&q=80');">
                    <span class="mask bg-gradient-dark opacity-6"></span>
                </div>
                <div class="row mt-n6 justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="card card-body shadow-lg">
                            <div class="d-flex align-items-center mb-4">
                                <span class="material-symbols-rounded text-primary me-2" style="font-size:2rem;">edit</span>
                                <h4 class="mb-0">Edit Profil</h4>
                            </div>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-4">
                                @csrf
                                @method('PUT')

                                @if ($errors->any())
                                    <div class="alert alert-danger d-flex align-items-start gap-3 py-3 px-4 mb-4 rounded-3 shadow-sm border-0" style="background: #fff6f6; border-left: 6px solid #e53935;">
                                        <span class="material-symbols-rounded flex-shrink-0 text-danger" style="font-size:2.2rem;line-height:1;">error</span>
                                        <div>
                                            <div class="fw-bold mb-2 text-danger" style="font-size:1.1rem;">Terjadi Kesalahan</div>
                                            <ul class="mb-0 ps-3 small" style="list-style-type: disc;">
                                                @foreach ($errors->all() as $error)
                                                    <li class="mb-1" style="line-height:1.7;">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 col-md-6">
                                    <label class="form-label">Nama</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><span class="material-symbols-rounded text-primary">person</span></span>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><span class="material-symbols-rounded text-primary">mail</span></span>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">No Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><span class="material-symbols-rounded text-primary">call</span></span>
                                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Foto Profil</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($user->photo_url)
                                            <img src="{{ asset('code/storage/app/public/' . $user->photo_url) }}" alt="Foto Profil" class="rounded shadow-sm border border-2 border-primary" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <div class="rounded bg-secondary d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                <span class="material-symbols-rounded text-white" style="font-size:2.5rem;">person</span>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1 text-end">
                                            <label class="btn btn-primary btn-sm mb-0" style="cursor:pointer;">
                                                <span class="material-symbols-rounded align-middle me-1">upload</span> Pilih Foto
                                                <input type="file" name="photo" class="d-none" onchange="this.form.submit()">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Bio / Tentang Saya</label>
                                    <textarea name="bio" rows="3" class="form-control" placeholder="Ceritakan tentang dirimu...">{{ old('bio', $user->bio) }}</textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary me-2">
                                        <span class="material-symbols-rounded align-middle">arrow_back</span> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-rounded align-middle">save</span> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
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
</body>

</html>