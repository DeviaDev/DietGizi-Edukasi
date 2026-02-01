@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg, #298620 0%, #adfda6 100%); padding: 5rem 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">Selamat Datang di DietGizi</h1>
                <p class="lead mb-4">Platform edukasi gizi terpercaya untuk membantu Anda mencapai gaya hidup sehat dan seimbang melalui pemahaman nutrisi yang tepat.</p>
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 rounded-pill">
                    <i class="fas fa-calculator me-2"></i>Cek Status Gizi
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=600" class="img-fluid rounded-4 shadow-lg" alt="Healthy Food">
            </div>
        </div>
    </div>
</section>

<!-- Apa itu Gizi -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold mb-3" style="color: var(--dark);">Apa itu Gizi?</h2>
            <div class="underline mx-auto mb-4" style="width: 80px; height: 4px; background: var(--primary);"></div>
        </div>
        
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="icon-box mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-apple-alt fa-2x text-white"></i>
                        </div>
                        <h4 class="mb-3">Definisi Gizi</h4>
                        <p class="text-muted">Gizi adalah zat dalam makanan yang diperlukan organisme untuk dapat tumbuh dan berkembang dengan baik sesuai dengan fungsinya. Gizi mencakup proses pengambilan zat-zat makanan penting (nutrient) atau proses menerima bahan-bahan dari lingkungan hidupnya dalam bentuk makanan untuk kelangsungan hidup.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="icon-box mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-heartbeat fa-2x text-white"></i>
                        </div>
                        <h4 class="mb-3">Pentingnya Gizi</h4>
                        <p class="text-muted">Gizi yang baik sangat penting untuk kesehatan, pertumbuhan, dan perkembangan optimal. Asupan gizi yang seimbang membantu mencegah berbagai penyakit, meningkatkan sistem kekebalan tubuh, dan mendukung fungsi organ-organ vital dalam tubuh kita.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dasar Kebutuhan Gizi Harian -->
<section class="py-5" style="background: var(--light);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold mb-3" style="color: var(--dark);">Dasar Kebutuhan Gizi Harian</h2>
            <div class="underline mx-auto mb-4" style="width: 80px; height: 4px; background: var(--primary);"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="icon-box mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-bread-slice fa-2x text-white"></i>
                        </div>
                        <h5 class="mb-3">Karbohidrat</h5>
                        <p class="text-muted small">Sumber energi utama (45-65% kalori harian). Pilih karbohidrat kompleks seperti nasi merah, roti gandum.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="icon-box mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-drumstick-bite fa-2x text-white"></i>
                        </div>
                        <h5 class="mb-3">Protein</h5>
                        <p class="text-muted small">Pembentuk dan pemelihara sel (10-35% kalori). Dari daging, ikan, telur, kacang-kacangan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="icon-box mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #9b59b6, #8e44ad); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-oil-can fa-2x text-white"></i>
                        </div>
                        <h5 class="mb-3">Lemak</h5>
                        <p class="text-muted small">Energi dan vitamin larut lemak (20-35% kalori). Pilih lemak sehat dari alpukat, kacang, minyak zaitun.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="icon-box mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #1abc9c, #16a085); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-tint fa-2x text-white"></i>
                        </div>
                        <h5 class="mb-3">Vitamin & Mineral</h5>
                        <p class="text-muted small">Mikronutrien penting untuk fungsi tubuh optimal. Dari sayur, buah, dan sumber alami.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pedoman Gizi Seimbang -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold mb-3" style="color: var(--dark);">Pedoman Gizi Seimbang</h2>
            <div class="underline mx-auto mb-4" style="width: 80px; height: 4px; background: var(--primary);"></div>
            <p class="text-muted">10 Pesan Gizi Seimbang untuk Hidup Sehat</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">1</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Syukuri dan nikmati anekaragam makanan</h6>
                        <p class="text-muted small mb-0">Konsumsi berbagai jenis makanan untuk memenuhi kebutuhan gizi</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">2</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Banyak makan sayuran dan cukup buah-buahan</h6>
                        <p class="text-muted small mb-0">3-5 porsi sayur dan 2-3 porsi buah setiap hari</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">3</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Biasakan mengonsumsi lauk pauk berprotein tinggi</h6>
                        <p class="text-muted small mb-0">Protein hewani dan nabati untuk pertumbuhan optimal</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">4</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Biasakan mengonsumsi aneka ragam makanan pokok</h6>
                        <p class="text-muted small mb-0">Variasi sumber karbohidrat untuk energi seimbang</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">5</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Batasi konsumsi pangan manis, asin, dan berlemak</h6>
                        <p class="text-muted small mb-0">Kurangi gula, garam, dan lemak jenuh</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">6</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Biasakan sarapan pagi</h6>
                        <p class="text-muted small mb-0">Energi untuk memulai aktivitas harian</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">7</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Biasakan minum air putih yang cukup dan aman</h6>
                        <p class="text-muted small mb-0">Minimal 8 gelas (2 liter) per hari</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">8</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Biasakan membaca label pada kemasan pangan</h6>
                        <p class="text-muted small mb-0">Kenali kandungan gizi dan bahan makanan</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">9</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Cuci tangan dengan sabun dan air mengalir</h6>
                        <p class="text-muted small mb-0">Cegah penyakit dengan kebersihan</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="number-badge" style="width: 50px; height: 50px; background: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">10</div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>Lakukan aktivitas fisik yang cukup</h6>
                        <p class="text-muted small mb-0">Minimal 30 menit setiap hari</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Proses Asuhan Gizi Standar -->
<section class="py-5" style="background: var(--light);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold mb-3" style="color: var(--dark);">Proses Asuhan Gizi Standar (PAGS)</h2>
            <div class="underline mx-auto mb-4" style="width: 80px; height: 4px; background: var(--primary);"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="process-number mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.5rem;">1</div>
                        <h5 class="mb-3">Asesmen</h5>
                        <p class="text-muted small">Pengumpulan, verifikasi, dan analisis data untuk identifikasi masalah gizi</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="process-number mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.5rem;">2</div>
                        <h5 class="mb-3">Diagnosis</h5>
                        <p class="text-muted small">Identifikasi dan penamaan masalah gizi berdasarkan data asesmen</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="process-number mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.5rem;">3</div>
                        <h5 class="mb-3">Intervensi</h5>
                        <p class="text-muted small">Perencanaan dan implementasi tindakan gizi untuk mengatasi masalah</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="400">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="process-number mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.5rem;">4</div>
                        <h5 class="mb-3">Monitoring & Evaluasi</h5>
                        <p class="text-muted small">Pemantauan progress dan evaluasi efektivitas intervensi gizi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;" data-aos="zoom-in">
            <div class="card-body text-center p-5">
                <h2 class="fw-bold mb-3">Siap Memulai Perjalanan Gizi Sehat Anda?</h2>
                <p class="lead mb-4">Cek kebutuhan diet dan gizi Anda sekarang juga!</p>
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 rounded-pill">
                    <i class="fas fa-calculator me-2"></i>Cek Status Gizi
                </a>
            </div>
        </div>
    </div>
</section>
@endsection