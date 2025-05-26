<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">
    <title>
        @yield('title', 'mini Halo-SIS') | {{ config('app.name') }}
    </title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="{{ asset('/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="{{ asset('/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
    @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('part.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('part.navbar')

        <div class="container-fluid py-2">
            {{-- Judul halaman dinamis --}}
            <div class="row">
                <div class="ms-3">
                    <h3 class="mb-0 h4 font-weight-bolder">@yield('page-title', 'Dashboard')</h3>
                    @hasSection('page-subtitle')
                        <p class="text-sm text-secondary">@yield('page-subtitle')</p>
                    @endif
                </div>
            </div>

            {{-- Konten utama dinamis --}}
            @yield('content')

            {{-- Dashboard cards (bisa di-@section-kan jika ingin custom) --}}
            @section('dashboard-cards')
            <div class="row">
                @php
                    $states = [
                        ['label' => 'Diajukan', 'icon' => 'event_upcoming', 'state' => 0],
                        ['label' => 'Diproses', 'icon' => 'update', 'state' => 1],
                        ['label' => 'Selesai', 'icon' => 'event_available', 'state' => 2],
                    ];
                @endphp
                @foreach($states as $idx => $state)
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-sm mb-0 text-capitalize">{{ $state['label'] }}</p>
                                    <h4 class="mb-0">
                                        {{ optional($progress->firstWhere('state', $state['state']))->pelayanan ?? 0 }}
                                    </h4>
                                </div>
                                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                    <i class="material-symbols-rounded opacity-10">{{ $state['icon'] }}</i>
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                    </div>
                </div>
                @endforeach
            </div>
            @show

            {{-- Chart section --}}
            @section('dashboard-charts')
            <div class="row">
                <div class="mt-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-0">Monitoring Perbaikan</h6>
                            <p class="text-sm">berdasarkan layanan yang diberikan</p>
                            <div class="pe-2">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @show

            {{-- Footer --}}
            @include('part.footer')
        </div>
    </main>

    @include('part.fixed-plugin')

    {{-- Chart JS --}}
    <script>
        var ctx = document.getElementById("chart-bars")?.getContext("2d");
        if (ctx) {
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [
                        "Layanan Koneksi Jaringan",
                        "Layanan Komunikasi",
                        "Layanan Hosting",
                        "Layanan Penyimpanan dan Berbagi Data",
                        "Layanan Piranti Lunak",
                        "Layanan Perangkat Keras",
                        "Layanan Pembangunan dan Pengembangan Aplikasi",
                        "Layanan Pengolahan"
                    ],
                    datasets: [{
                        label: "Views",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#43A047",
                        data: @json($chart ?? []),
                        barThickness: 'flex'
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    interaction: { intersect: false, mode: 'index' },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: '#e5e5e5'
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 10,
                                font: { size: 14, lineHeight: 2 },
                                color: "#737373"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#737373',
                                padding: 10,
                                font: { size: 14, lineHeight: 2 },
                            }
                        },
                    },
                },
            });
        }
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
    @stack('scripts')
</body>
</html>