<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Sistem Gizi & Nutrisi</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Base Styles -->
    <style>
        :root {
    --primary: #059669;
    --secondary: #10b981;
    --accent: #34d399;
    --dark: #1f2937;
    --light: #f9fafb;
    --danger: #e74c3c;
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: #f9fafb;
        }

        /* Navigation */
        .navbar {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #059669;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .navbar-menu a {
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            padding: 0.5rem 0;
        }

        .navbar-menu a:hover,
        .navbar-menu a.active {
            color: #059669;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #4b5563;
        }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            padding: 3rem 1rem 1.5rem;
            margin-top: 4rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    color: var(--secondary);
    letter-spacing: 0.3px;
}


        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-section a:hover {
    color: var(--accent);
}


        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .btn{
            background: #000;
        }

        .btn-logout {
    background: linear-gradient(135deg, var(--danger), var(--danger));
    border: none;
    color: white;
    padding: 0.5rem 1.4rem;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}


.btn-logout:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 25, 0, 0.3);
}



.logo-icon {
    width: 36px;
    height: 36px;
    background: #22c55e; /* hijau kayak contoh */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-icon i {
    font-size: 1rem;
    color: #fff;
}

.logo-text {
    font-weight: 700;
    font-size: 1.25rem;
    color: #16a34a;
    line-height: 1;
}




        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                gap: 0;
            }

              .btn-logout {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }

            .navbar-menu.show {
                display: flex;
            }

            .navbar-menu li {
                padding: 0.75rem 0;
                border-bottom: 1px solid #e5e7eb;
            }

            .navbar-menu li:last-child {
                border-bottom: none;
            }

            .mobile-menu-toggle {
                display: block;
            }


            .navbar-menu a.active {
    color: var(--primary);
    position: relative;
}

.navbar-menu a.active::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    width: 28px;
    height: 3px;
    background: var(--primary);
    border-radius: 2px;
}

 .logo-text {
        font-size: 1.05rem;



    }

    .logo-icon {
        width: 34px;
        height: 34px;
    }

    .logo-icon i {
        font-size: 1.05rem;
    }

        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky">
        <div class="navbar-container">
<a class="navbar-brand" href="{{ route('nutrition.calculator') }}">
    <span class="logo-icon">
        <i class="fas fa-utensils"></i>
    </span>
    <span class="logo-text">Sistem Gizi dan Nutrisi</span>
</a>



            
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                ☰
            </button>
            
            <ul class="navbar-menu" id="navbarMenu">
                <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('nutrition.calculator') }}" class="{{ Request::is('nutrition/calculator') ? 'active' : '' }}">Kalkulator Gizi</a></li>
                <li><a href="{{ route('nutrition.recommendations') }}" class="{{ Request::is('nutrition/recommendations') ? 'active' : '' }}">Panduan Gizi</a></li>
                <li><a href="{{ route('diet.calculate') }}" class="{{ Request::is('diet*') ? 'active' : '' }}">Cek Diet</a></li>
                 <li>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-logout">
            <i class="fas fa-sign-out-alt me-1"></i>Logout
        </button>
    </form>
</li>

        
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p style="color: #d1d5db; line-height: 1.6;">
                    Sistem Kalkulator Gizi & Nutrisi berbasis web yang membantu Anda menganalisis status gizi dan mendapatkan rekomendasi diet yang tepat.
                </p>
            </div>
            
            <div class="footer-section">
                <h3>Fitur</h3>
                <ul>
                    <li><a href="{{ route('nutrition.calculator') }}">Kalkulator Status Gizi</a></li>
                    <li><a href="{{ route('nutrition.calculator') }}">Analisis Antropometri</a></li>
                    <li><a href="{{ route('nutrition.recommendations') }}">Panduan Gizi Lengkap</a></li>
                    <li><a href="{{ route('diet.calculate') }}">Rekomendasi Diet</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Panduan</h3>
                <ul>
                    <li><a href="{{ route('nutrition.recommendations') }}#gizi-kurang">Gizi Kurang</a></li>
                    <li><a href="{{ route('nutrition.recommendations') }}#gizi-lebih">Gizi Lebih/Obesitas</a></li>
                    <li><a href="{{ route('nutrition.recommendations') }}#diabetes">Diabetes</a></li>
                    <li><a href="{{ route('nutrition.recommendations') }}#hipertensi">Hipertensi</a></li>
                    <li><a href="{{ route('nutrition.recommendations') }}#kolesterol">Kolesterol</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Kontak</h3>
                <ul>
                    <li>Email: info@sistemgizi.com</li>
                    <li>Phone: +62 123 4567 890</li>
                    <li>WhatsApp: +62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Sistem Gizi & Nutrisi. All rights reserved.</p>
            <p style="margin-top: 0.5rem; font-size: 0.75rem;">
                Disclaimer: Hasil kalkulator adalah estimasi. Konsultasikan dengan ahli gizi atau dokter untuk diagnosis dan rencana diet yang tepat.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('navbarMenu');
            menu.classList.toggle('show');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar-container');
            const menu = document.getElementById('navbarMenu');
            
            if (!navbar.contains(event.target) && menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });

        // CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            window.axios = {
                defaults: {
                    headers: {
                        common: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                }
            };
        }
    </script>
    
    @yield('scripts')
</body>
</html>
