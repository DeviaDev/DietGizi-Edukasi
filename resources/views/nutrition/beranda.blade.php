@extends('nutrition.layouts.appnut')

@section('title', 'Beranda')

@section('content')
<div class="container py-5">

    {{-- HERO SECTION --}}
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <span class="badge bg-success bg-opacity-10 text-success mb-3 px-3 py-2">
                🌿 Nutrisi Optimal, Hidup Optimal
            </span>

            <h1 class="fw-bold display-5 mt-2">
                Halo <strong>{{ Auth::user()->name }}</strong> 👋,<br>
                <span class="text-success">Partner Kesehatan</span><br>
                Nutrisi Harian Anda
            </h1>

            <p class="text-muted mt-3">
                Hitung kalori, lacak status gizi, Baca Artikel tentang kesehatan dan temukan rekomendasi nutrisi
                yang dipersonalisasi khusus untuk tubuhmu.
            </p>

            {{-- <div class="d-flex gap-3 mt-4">
                <a href="{{ route('nutrition.calculator') }}" class="btn btn-success px-4">
                    Mulai Sekarang →
                </a>
                <a href="{{ route('nutrition.recommendations') }}" class="btn btn-outline-success px-4">
                    Jelajahi Fitur
                </a>
            </div> --}}
        </div>

        <div class="col-lg-6 text-center mt-1 mt-lg-0">
            <img src="{{ asset('storage/fotobg.jpg') }}"
                 class="img-fluid rounded-4 shadow-sm w-80"
                 alt="Healthy Lifestyle"  style="max-width: 450px; width: 100%; height: auto;">
        </div>
    </div>

    {{-- FEATURE CARDS --}}
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="mb-3 text-success fs-3">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h6 class="fw-bold">Melacak Kalori</h6>
                    <p class="text-muted small">
                        Pantau kebutuhan kalori harian berdasarkan usia, berat, dan aktivitas.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="mb-3 text-primary fs-3">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h6 class="fw-bold">Status Gizi</h6>
                    <p class="text-muted small">
                        Ketahui apakah status gizimu ideal, kurang, atau berlebih.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="mb-3 text-warning fs-3">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                    <h6 class="fw-bold">Rekomendasi Nutrisi</h6>
                    <p class="text-muted small">
                        Saran gizi harian sesuai kondisi dan tujuan kesehatanmu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ARTIKEL --}}
    {{-- <div class="row">
        <div class="col-12 mb-4">
            <h4 class="fw-bold">📰 Artikel Kesehatan</h4>
            <p class="text-muted">Baca tips dan panduan gizi terbaru</p>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="https://source.unsplash.com/400x250/?balanced-diet"
                     class="card-img-top" alt="">
                <div class="card-body">
                    <h6 class="fw-bold">Pola Makan Seimbang</h6>
                    <p class="text-muted small">
                        Mengenal komposisi gizi yang baik untuk tubuh.
                    </p>
                    <a href="#" class="text-success small fw-semibold">
                        Baca selengkapnya →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="https://source.unsplash.com/400x250/?exercise,health"
                     class="card-img-top" alt="">
                <div class="card-body">
                    <h6 class="fw-bold">Aktivitas Fisik & Gizi</h6>
                    <p class="text-muted small">
                        Hubungan olahraga dan kebutuhan nutrisi harian.
                    </p>
                    <a href="#" class="text-success small fw-semibold">
                        Baca selengkapnya →
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="https://source.unsplash.com/400x250/?nutrition,food"
                     class="card-img-top" alt="">
                <div class="card-body">
                    <h6 class="fw-bold">Cegah Masalah Gizi</h6>
                    <p class="text-muted small">
                        Tips mencegah gizi kurang dan gizi lebih sejak dini.
                    </p>
                    <a href="#" class="text-success small fw-semibold">
                        Baca selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

</div>
@endsection
