<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SIMAWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Sidebar Styling */
        #sidebar {
            min-height: 100vh;
            width: 250px;
            background-color: #343a40;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background-color: #2c3136;
            color: #fff;
        }

        #sidebar ul li a {
            padding: 15px 20px;
            display: block;
            color: #ddd;
            text-decoration: none;
            transition: background 0.3s;
        }

        #sidebar ul li a:hover {
            background-color: #495057;
            color: #fff;
        }

        #sidebar ul li a i {
            margin-right: 10px;
        }

        .active {
            background-color: #495057;
        }

        /* Content Styling */
        #content {
            width: calc(100% - 250px);
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: all 0.3s;
            padding: 20px;
        }

        .card-stats {
            transition: transform 0.3s;
            border: none;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-stats .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .font-weight-bold {
            font-size: 1.5rem;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                width: 100%;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="mb-0">SIMAWA Admin</h3>
            </div>
        
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.prestasi.index') }}" class="{{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy"></i> Prestasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.beasiswa.index') }}" class="{{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i> Beasiswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kegiatan.index') }}" class="{{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i> Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                        <i class="fas fa-file-export"></i> Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i> Berita
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}" class="text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        

        <!-- Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="dropdown ms-auto">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::guard('admin')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid p-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(Route::currentRouteName() == 'admin.dashboard')
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-muted">Prestasi</h5>
                                        <span class="font-weight-bold">{{ App\Models\Prestasi::count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle p-3">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-muted">Beasiswa Aktif</h5>
                                        <span class="font-weight-bold">{{ App\Models\Beasiswa::count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle p-3">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-muted">Kegiatan</h5>
                                        <span class="font-weight-bold">{{ App\Models\Kegiatan::count() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle p-3">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar').toggleClass('active');
                    });
                });
            </script>
            <script>
                var ctx = document.getElementById('dashboardChart').getContext('2d');
                var dashboardChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Prestasi', 'Beasiswa Aktif', 'Kegiatan'],
                        datasets: [{
                            label: 'Jumlah',
                            data: [
                                {{ App\Models\Prestasi::where('status', ['approved'])->count() }},
                                {{ App\Models\Beasiswa::where('status_verifikasi', ['terverifikasi'])->count() }},
                                {{ App\Models\Kegiatan::where('status', ['approved'])->count() }}
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(54, 162, 235, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(54, 162, 235, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
            
        </body>
    </html>
