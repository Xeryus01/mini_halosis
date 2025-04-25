<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" / " target="_blank">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <!-- Logo -->
            <span class="ms-1 text-sm text-dark">Nama Aplikasi</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <!-- <a class="nav-link active bg-gradient-dark text-white" href="/"> -->
                <a class="nav-link text-dark" href="/">
                    <!-- symbol logo -->
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <!-- text menu -->
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            @auth
            <!-- tidak bisa dilihat user biasa -->
            <li class="nav-item">
                <a class="nav-link text-dark" href="/tabel">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Tabel</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="/permintaan_layanan">
                    <i class="material-symbols-rounded opacity-5">library_add</i>
                    <span class="nav-link-text ms-1">Permintaan Layanan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="/lapor_gangguan">
                    <i class="material-symbols-rounded opacity-5">brightness_alert</i>
                    <span class="nav-link-text ms-1">Lapor Gangguan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/notifications.html">
                    <i class="material-symbols-rounded opacity-5">notifications</i>
                    <span class="nav-link-text ms-1">Notifications</span>
                </a>
            </li>
            <!-- end tidak bisa dilihat user biasa -->
            @endauth

            <li class="nav-item">
                <a class="nav-link text-dark collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1">Deskripsi</span>
                </a>
                <div class="collapse" id="dashboard-collapse" bis_skin_checked="1">
                    <ul class="fw-normal pl-2 pb-1 small">
                        <li><a href="/pmss" class="link-dark rounded">Tim Metodologi</a></li>
                        <li><a href="/sis" class="link-dark rounded">Tim SIS</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
            </li>

            @auth
            <li class="nav-item">
                <a class="nav-link text-dark" href="/profile">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('logout') }}">
                    <i class="material-symbols-rounded opacity-5">logout</i>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </li>
            @endauth

            @guest
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('login') }}">
                    <i class="material-symbols-rounded opacity-5">login</i>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('register') }}">
                    <i class="material-symbols-rounded opacity-5">assignment</i>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>
            @endguest

        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn btn-outline-dark mt-4 w-100" href="" type="button">Documentation</a>
        </div>
    </div>
</aside>