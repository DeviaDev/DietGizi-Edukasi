<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DietGizi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2ecc71;
            --secondary: #12b648;
            --accent: #3498db;
            --dark: #09752d;
            --light: #ecf0f1;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }
        
        .navbar-brand i {
            color: var(--secondary);
        }
        
        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .nav-link.active {
            color: var(--primary) !important;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #24a135, #36c248);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s;
        }
        
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }


       .logo-icon {
    width: 38px;
    height: 38px;
    background: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-icon i {
    font-size: 1.2rem;
    color: white;
}

.logo-text {
    font-weight: 700;
    font-size: 1.4rem;
    color: var(--primary);
    line-height: 1;
}



.navbar-toggler {
    border: none;
    font-size: 1.6rem;
    color: var(--dark);
}


        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }
        
        footer a {
            color: var(--light);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        footer a:hover {
            color: var(--primary);
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            margin: 0 5px;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
    </style>
    @stack('styles')
</head>
<body>

    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky">

        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('about') }}">
    <span class="logo-icon">
        <i class="fas fa-utensils"></i>
    </span>
    <span class="logo-text">DietGizi</span>
</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    ☰
</button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i>Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('edukasi') ? 'active' : '' }}" href="{{ route('edukasi') }}">
                            <i class="fas fa-book-open me-1"></i>Edukasi Gizi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dasar-gizi') ? 'active' : '' }}" href="{{ route('dasar-gizi') }}">
                            <i class="fas fa-chart-bar me-1"></i>Dasar Gizi
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cek-diet') ? 'active' : '' }}" href="{{ route('cek-diet') }}">
                            <i class="fas fa-calculator me-1"></i>Cek Diet
                        </a>
                    </li> --}}
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-logout"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3"><i class="fas fa-utensils me-2"></i>DietGizi</h5>
                    <p>Platform edukasi gizi terpercaya untuk membantu Anda mencapai gaya hidup sehat dan seimbang.</p>
                    <div class="social-links mt-3">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('edukasi') }}">Edukasi Gizi</a></li>
                        <li class="mb-2"><a href="{{ route('dasar-gizi') }}">Dasar Gizi</a></li>
                        {{-- <li class="mb-2"><a href="{{ route('cek-diet') }}">Cek Diet</a></li> --}}
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3">Layanan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="login">Cek Status Gizi</a></li>
                        <li class="mb-2"><a href="login">Panduan Gizi</a></li>
                        {{-- <li class="mb-2"><a href="#">Artikel Kesehatan</a></li>
                        <li class="mb-2"><a href="#">FAQ</a></li> --}}
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3">Kontak</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@dietgizi.com</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+62 812-3456-7890</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Yogjakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center py-3">
                <p class="mb-0">&copy; 2026 DietGizi. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
    @stack('scripts')
</body>
</html>