<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAWA - Sistem Informasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .hero-section {
            background-image: url('/images/bg22.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            padding: 100px 0;
        }

        .navbar {
            background-color: #0a8098d8;
            padding: 15px 0;
            color: #333
        }

        .wrapper {
            padding: 80px 0;
        }

        .grid-item-1 {
            padding-right: 2rem;
        }

        .main-heading {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 2rem;
        }

        .info-text {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn_wrapper {
            display: flex;
            gap: 1rem;
        }

        .view_more_btn,
        .documentation_btn {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .view_more_btn {
            background-color: #4a90e2;
            color: white;
            border: none;
        }

        .view_more_btn:hover {
            background-color: #3a7bc8;
        }

        .documentation_btn {
            background-color: transparent;
            color: #4a90e2;
            border: 2px solid #4a90e2;
        }

        .documentation_btn:hover {
            background-color: #4a90e2;
            color: white;
        }

        .team_img_wrapper {
            text-align: center;
        }

        .team_img_wrapper img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .grid-item-1 {
                padding-right: 0;
                margin-bottom: 2rem;
            }
        }

        .features-section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #333;
        }

        .feature-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-wrapper i {
            font-size: 2rem;
            color: #4a90e2;
        }

        .feature-card h3 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .feature-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            background: #4a90e2;
            color: #fff;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .feature-btn:hover {
            background: #3a7bc8;
            color: #fff;
        }

        .announcement-section {
            background: #f8f9fa;
            padding: 40px 0;
        }

        .announcement-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .card-date {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .announcement-link {
            color: #4a90e2;
            text-decoration: none;
        }

        .footer-section {
            background: #333;
            color: #fff;
            padding: 40px 0 20px;
        }

        .footer-content {
            margin-bottom: 30px;
        }

        .footer-info h5,
        .footer-contact h5 {
            margin-bottom: 15px;
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Hero Section -->
    <section class="hero-section wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 grid-item-1">
                    <h1 class="main-heading">
                        Selamat Datang di
                        <br />
                        Sistem Informasi Kemahasiswaan Fakultas Teknik Universitas Bengkulu
                    </h1>
                    <p class="info-text">
                        Portal terpadu untuk mengelola Prestasi, Beasiswa, dan Kegiatan Mahasiswa. Kembangkan potensi
                        Anda bersama kami.
                    </p>

                </div>
                <div class="col-md-6 grid-item-2">
                    <div class="team_img_wrapper">

                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Main Features -->
    <section class="features-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Layanan Kami</h2>
            <div class="row g-4">
                <!-- Prestasi Card -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3>Prestasi</h3>
                        <p>Catat dan dokumentasikan prestasi akademik maupun non-akademik Anda. Tingkatkan portofolio
                            prestasi mahasiswa.</p>
                        <a href="{{ route('account.prestasi') }}" class="feature-btn">
                            Input Prestasi
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Beasiswa Card -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Beasiswa</h3>
                        <p>Akses informasi beasiswa yang tersedia. Daftar dan pantau status pengajuan beasiswa Anda.</p>
                        <a href="{{ route('account.beasiswa.index') }}" class="feature-btn">
                            Cek Beasiswa
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Kegiatan Card -->
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Kegiatan</h3>
                        <p>Informasi dan pendaftaran berbagai kegiatan kemahasiswaan. Tingkatkan soft skill Anda.</p>
                        <a href="{{ route('account.kegiatan.index') }}" class="feature-btn">
                            Lihat Kegiatan
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section Prestasi Mahasiswa -->
<section class="news-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Prestasi Mahasiswa</h2>
        <div class="row g-4">
            @foreach ($prestasi as $item)
                <div class="col-md-4">
                    <div class="news-card">
                        <div class="news-img">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="Berita" class="img-fluid">
                            <div class="news-date">
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ Str::limit($item->konten, 100) }}</p>
                            @if ($item->link)
                                <a href="{{ $item->link }}" class="news-btn" target="_blank">Lihat Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @else
                                <a href="{{ route('admin.berita.show', $item->id) }}" class="news-btn">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Beasiswa -->
<section class="news-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Beasiswa</h2>
        <div class="row g-4">
            @foreach ($beasiswa as $item)
                <div class="col-md-4">
                    <div class="news-card">
                        <div class="news-img">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="Berita" class="img-fluid">
                            <div class="news-date">
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ Str::limit($item->konten, 100) }}</p>
                            <a href="#" class="news-btn">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Kegiatan Mahasiswa -->
<section class="news-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Kegiatan Mahasiswa</h2>
        <div class="row g-4">
            @foreach ($kegiatan as $item)
                <div class="col-md-4">
                    <div class="news-card">
                        <div class="news-img">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="Berita" class="img-fluid">
                            <div class="news-date">
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</span>
                            </div>
                        </div>
                        <div class="news-content">
                            <h3>{{ $item->judul }}</h3>
                            <p>{{ Str::limit($item->konten, 100) }}</p>
                            <a href="#" class="news-btn">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- Announcements -->
    <section class="announcement-section py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Video</h2>
            <div class="d-block aos-init aos-animate" data-aos="fade-up">
                <div class="main-nav--line-graphic gold"></div>
                <div class="section section-bg section-xxlg"
                    style="padding: 0; padding-top: 1%; padding-bottom: 2%; /*background-image: url('./assets/new_version/images/image-cta-1.png')*/;">
                    <div class="container" style="max-width: 95%;">
                        <br>
                        <h4 class="section-title" style="color:white">Video </h4>
                        <div class="row justify-content-center" style="padding: 0px">
                            <div class="col-md-3 text-center">

                                <hr class="blue">

                                <iframe width="100%" height="180px" class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/rrpUYPT1crM?si=7cciqmpsmcpYJbQt"
                                    allowfullscreen=""></iframe>


                            </div>
                            <div class="col-md-3 text-center">

                                <hr class="blue">

                                <iframe width="100%" height="180px" class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/qz9UWL5O-l4?si=kx7KEWOZTFDh0QHp"
                                    allowfullscreen=""></iframe>


                            </div>
                            <div class="col-md-3 text-center">

                                <hr class="blue">

                                <iframe width="100%" height="180px" class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/oCPINaBHscw?si=YhPgJYauwSM5Gxio" allowfullscreen=""></iframe>


                            </div>
                            <div class="col-md-3 text-center">

                                <hr class="blue">

                                <iframe width="100%" height="180px" class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/Fp0ANHuXb3I?si;autoplay=1&amp;mute=1"
                                    allowfullscreen=""></iframe>
                            </div>
                        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-info">
                            <h5>SIMAWA</h5>
                            <p>© 2024 - Faculty of Engineering University of Bengkulu</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-contact">
                            <h5>Kontak</h5>
                            <p><i class="fas fa-envelope"></i> ft@unib.ac.id</p>
                            <p><i class="fas fa-phone"></i> +62 736 21170</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 - Faculty of Engineering University of Bengkulu</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const navId = document.getElementById("nav_menu"),
            ToggleBtnId = document.getElementById("toggle_btn"),
            CloseBtnId = document.getElementById("close_btn");

        // ==== SHOW MENU ==== //
        ToggleBtnId.addEventListener("click", () => {
            navId.classList.toggle("show");
        });

        // ==== Animate on Scroll Initialize  ==== //
        AOS.init();

        // ==== GSAP Animations ==== //
        // ==== LOGO  ==== //
        gsap.from(".logo", {
            opacity: 0,
            y: -10,
            delay: 1,
            duration: 0.5,
        });
        // ==== NAV-MENU ==== //
        gsap.from(".nav_menu_list .nav_menu_item", {
            opacity: 0,
            y: -10,
            delay: 1.4,
            duration: 0.5,
            stagger: 0.3,
        });
        // ==== TOGGLE BTN ==== //
        gsap.from(".toggle_btn", {
            opacity: 0,
            y: -10,
            delay: 1.4,
            duration: 0.5,
        });
        // ==== MAIN HEADING  ==== //
        gsap.from(".main-heading", {
            opacity: 0,
            y: 20,
            delay: 2.4,
            duration: 1,
        });
        // ==== INFO TEXT ==== //
        gsap.from(".info-text", {
            opacity: 0,
            y: 20,
            delay: 2.8,
            duration: 1,
        });
        // ==== CTA BUTTONS ==== //
        gsap.from(".btn_wrapper", {
            opacity: 0,
            y: 20,
            delay: 2.8,
            duration: 1,
        });
        // ==== TEAM IMAGE ==== //
        gsap.from(".team_img_wrapper img", {
            opacity: 0,
            y: 20,
            delay: 3,
            duration: 1,
        });
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>

</html>