<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2 shadow-sm" id="sidenav-main" style="min-height:100vh;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0 d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('/assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-2 text-sm text-dark fw-bold">mini Halo-SIS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @php
                $menus = [
                    [
                        'label' => 'Dashboard',
                        'route' => 'home',
                        'icon' => 'dashboard',
                        'auth' => false,
                    ],
                    [
                        'label' => 'Tabel',
                        'route' => 'tabel',
                        'icon' => 'table_view',
                        'auth' => true,
                    ],
                    [
                        'label' => 'Permintaan Layanan',
                        'route' => 'permintaan_layanan',
                        'icon' => 'library_add',
                        'auth' => true,
                    ],
                    [
                        'label' => 'Lapor Gangguan',
                        'route' => 'lapor_gangguan',
                        'icon' => 'brightness_alert',
                        'auth' => true,
                    ],
                ];
            @endphp

            @foreach ($menus as $menu)
                @if (!$menu['auth'] || Auth::check())
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 text-dark {{ request()->routeIs($menu['route']) ? 'active bg-gradient-dark text-white shadow-sm' : '' }} sidebar-link" href="{{ route($menu['route']) }}">
                            <i class="material-symbols-rounded opacity-5">{{ $menu['icon'] }}</i>
                            <span class="nav-link-text">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

            {{-- Menu Manajemen User khusus admin --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 text-dark {{ request()->routeIs('manage.index') ? 'active bg-gradient-dark text-white shadow-sm' : '' }} sidebar-link" href="{{ route('manage.index') }}">
                            <i class="material-symbols-rounded opacity-5">manage_accounts</i>
                            <span class="nav-link-text">Manajemen User</span>
                        </a>
                    </li>
                @endif
            @endauth

            @php
                $descMenus = [
                    [
                        'label' => 'Tim Metodologi',
                        'route' => 'pmss',
                    ],
                    [
                        'label' => 'Tim SIS',
                        'route' => 'sis',
                    ],
                ];
                $descActive = collect($descMenus)->pluck('route')->contains(fn($r) => request()->routeIs($r));
            @endphp

            @php
                $descActive = collect($descMenus)->pluck('route')->contains(fn($r) => request()->routeIs($r));
            @endphp

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-between text-dark collapsed sidebar-link" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="{{ $descActive ? 'true' : 'false' }}">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1">&nbsp; Deskripsi</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="collapse{{ $descActive ? ' show' : '' }}" id="dashboard-collapse">
                    <ul class="fw-normal pb-1 small list-unstyled ms-4">
                        @foreach($descMenus as $desc)
                            <li>
                                <a href="{{ route($desc['route']) }}"
                                   class="link-dark rounded d-block py-1 px-2 sidebar-link {{ request()->routeIs($desc['route']) ? 'bg-gradient-dark text-white shadow-sm' : '' }}">
                                    {{ $desc['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
            </li>

            @auth
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-dark {{ request()->routeIs('profile') ? 'active bg-gradient-dark text-white shadow-sm' : '' }} sidebar-link" href="{{ route('profile') }}">
                        <i class="material-symbols-rounded opacity-5">person</i>
                        <span class="nav-link-text">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-dark sidebar-link" href="{{ route('logout') }}">
                        <i class="material-symbols-rounded opacity-5">logout</i>
                        <span class="nav-link-text">Log Out</span>
                    </a>
                </li>
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-dark {{ request()->routeIs('login') ? 'active bg-gradient-dark text-white shadow-sm' : '' }} sidebar-link" href="{{ route('login') }}">
                        <i class="material-symbols-rounded opacity-5">login</i>
                        <span class="nav-link-text">Sign In</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-dark {{ request()->routeIs('register') ? 'active bg-gradient-dark text-white shadow-sm' : '' }} sidebar-link" href="{{ route('register') }}">
                        <i class="material-symbols-rounded opacity-5">assignment</i>
                        <span class="nav-link-text">Sign Up</span>
                    </a>
                </li>
            @endguest
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn btn-outline-dark mt-4 w-100" href="#" type="button">Documentation</a>
        </div>
    </div>
</aside>
