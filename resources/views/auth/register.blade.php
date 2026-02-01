

@extends('layouts.applogin')

@section('title', 'Register')

@push('styles')
<style>
    /* Auth Styles - Login & Register */
:root {
    --primary: #2ecc71;
    --primary-dark: #27ae60;
    --bg-light: #e8f5e9;
    --text-dark: #2c3e50;
    --border-color: #e0e0e0;
    --shadow: rgba(0, 0, 0, 0.1);
}

.auth-page {
    background-color: var(--bg-light);
    min-height: calc(100vh - 120px); /* navbar + footer */
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 80px;
    padding-bottom: 80px;
}


.auth-container {
    width: 100%;
    max-width: 450px;
    margin: 0 auto;
}

.auth-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px var(--shadow);
    padding: 3rem 2.5rem;
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Logo & Header */
.auth-logo {
    text-align: center;
    margin-bottom: 2rem;
}

.logo-icon {
    width: 80px;
    height: 80px;
    background: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.logo-icon i {
    font-size: 2.5rem;
    color: white;
}

.auth-logo h1 {
    color: var(--primary);
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
}

.auth-logo p {
    color: #666;
    font-size: 0.95rem;
    margin: 0;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    background: #ffffff;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    background: white;
    box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.1);
}

.form-control::placeholder {
    color: #99999969;
}

/* Submit Button */
.btn-submit {
    width: 100%;
    padding: 0.875rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
}

/* Links */
.auth-link {
    text-align: center;
    margin-top: 1.5rem;
    color: #666;
    font-size: 0.9rem;
}

.auth-link a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
}

.auth-link a:hover {
    text-decoration: underline;
}

/* Alert Messages */
.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.alert-danger {
    background: #fee;
    border: 1px solid #fcc;
    color: #c33;
}

.alert-danger ul {
    margin: 0;
    padding-left: 1.2rem;
}

.alert-danger li {
    margin: 0.25rem 0;
}

/* Help Icon */
.help-icon {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: var(--text-dark);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 10px var(--shadow);
    transition: all 0.3s ease;
}

.help-icon:hover {
    background: var(--primary);
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 576px) {
    .auth-card {
        padding: 2rem 1.5rem;
    }
    
    .auth-logo h1 {
        font-size: 1.75rem;
    }
    
    .logo-icon {
        width: 70px;
        height: 70px;
    }
    
    .logo-icon i {
        font-size: 2rem;
    }
}

</style>
@endpush

@section('content')

<section class="auth-page">
        <div class="auth-container">
        <div class="auth-card">
            <!-- Logo & Header -->
            <div class="auth-logo">
                <div class="logo-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h1>DietGizi</h1>
                <p>Buat akun baru untuk memulai</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Deandra Avinash"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-control"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="btn-submit">
                    Daftar
                </button>
            </form>

            <!-- Login Link -->
            <div class="auth-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>

    <!-- Help Icon -->
    <div class="help-icon">
        <i class="fas fa-question"></i>
    </div>
</section>


@endsection

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    
    <!-- Font Awesome -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> --}}

    <!-- Custom JavaScript -->
    {{-- <script src="{{ asset('js/auth.js') }}"></script> --}}

