<style>
    .navbar {
        background-color: #0a8098d8;
        padding: 15px 0;
        color: #333;
    }

    .navbar-nav .nav-link {
        color: #fff !important;
    }

    .navbar-brand.logo {
        font-weight: bold;
        color: #fff !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" id="nav_menu">
    <div class="container">
        <a class="navbar-brand logo" href="{{ route('account.dashboard') }}">SIMAWA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto nav_menu_list">
                <li class="nav-item nav_menu_item">
                    <a class="nav-link" href="{{ route('account.dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Minat Penalaran dan Informasi Kemahasiswaan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('account.prestasi') }}">Prestasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.beasiswa.index') }}">Beasiswa</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.kegiatan.index') }}">Kegiatan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="{{ route('account.profile') }}">Profil Saya</a></li>
                        <li>
                            <form action="{{ route('account.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
