@extends('layouts.app')

@section('title', 'Edukasi Gizi')

@push('styles')
<style>
    .diet-card {
        transition: all 0.3s;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .diet-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .diet-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .badge-custom {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<section class="py-5" style="background: linear-gradient(135deg,  #298620 0%, #adfda6  100%); color: white;">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3">Edukasi Gizi</h1>
            <p class="lead mb-0">Pelajari berbagai jenis diet dan makanan khusus untuk kesehatan optimal</p>
        </div>
    </div>
</section>

<!-- Diet Categories -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Diet Standar -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">
                            <i class="fas fa-utensils fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Standar</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #2ecc71; color: white;">Umum</span>
                        <p class="text-muted">Diet seimbang untuk orang sehat dengan kebutuhan gizi normal. Mengandung semua zat gizi dalam proporsi yang tepat.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Karbohidrat 50-60%</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Protein 10-15%</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Lemak 25-30%</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Rendah Kalori -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                            <i class="fas fa-weight fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Rendah Kalori</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #3498db; color: white;">Penurunan BB</span>
                        <p class="text-muted">Untuk menurunkan berat badan dengan mengurangi asupan kalori namun tetap memenuhi kebutuhan gizi.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>1200-1500 kkal/hari</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Tinggi protein</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Rendah lemak jenuh</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Diabetes Mellitus -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                            <i class="fas fa-heartbeat fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Diabetes Mellitus</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #e74c3c; color: white;">Medis</span>
                        <p class="text-muted">Diet khusus untuk penderita diabetes dengan kontrol gula darah dan karbohidrat yang ketat.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-danger me-2"></i>Karbohidrat terkontrol</li>
                            <li class="mb-2"><i class="fas fa-check text-danger me-2"></i>Indeks glikemik rendah</li>
                            <li class="mb-2"><i class="fas fa-check text-danger me-2"></i>Serat tinggi</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Hipertensi -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                            <i class="fas fa-heart fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Hipertensi (DASH)</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #9b59b6; color: white;">Kardiovaskular</span>
                        <p class="text-muted">Diet rendah garam untuk menurunkan tekanan darah dan menjaga kesehatan jantung.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-purple me-2"></i>Garam <5g/hari</li>
                            <li class="mb-2"><i class="fas fa-check text-purple me-2"></i>Kaya kalium</li>
                            <li class="mb-2"><i class="fas fa-check text-purple me-2"></i>Banyak sayur & buah</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Rendah Protein -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                            <i class="fas fa-ban fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Rendah Protein</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #f39c12; color: white;">Ginjal</span>
                        <p class="text-muted">Untuk penderita penyakit ginjal dengan pembatasan protein untuk mengurangi beban kerja ginjal.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i>Protein 0.6-0.8g/kg BB</li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i>Batasi kalium</li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i>Kontrol cairan</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Rendah Lemak -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #1abc9c, #16a085);">
                            <i class="fas fa-oil-can fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Rendah Lemak</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #1abc9c; color: white;">Kolesterol</span>
                        <p class="text-muted">Untuk menurunkan kolesterol dan mencegah penyakit jantung dengan membatasi lemak jenuh.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-info me-2"></i>Lemak <25% kalori</li>
                            <li class="mb-2"><i class="fas fa-check text-info me-2"></i>Kolesterol <200mg</li>
                            <li class="mb-2"><i class="fas fa-check text-info me-2"></i>Serat tinggi</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Tinggi Kalori Protein -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #e67e22, #d35400);">
                            <i class="fas fa-dumbbell fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Tinggi Kalori Protein</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #e67e22; color: white;">Pemulihan</span>
                        <p class="text-muted">Untuk pemulihan pasca sakit, luka bakar, atau peningkatan massa otot.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i>2500-3000 kkal/hari</li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i>Protein 1.5-2g/kg BB</li>
                            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i>Makan sering</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Rendah Garam -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #34495e, #2c3e50);">
                            <i class="fas fa-ban fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Rendah Garam</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #34495e; color: white;">Edema</span>
                        <p class="text-muted">Untuk penderita edema, gagal jantung, atau penyakit hati dengan pembatasan natrium.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-dark me-2"></i>Garam <2-3g/hari</li>
                            <li class="mb-2"><i class="fas fa-check text-dark me-2"></i>Hindari MSG</li>
                            <li class="mb-2"><i class="fas fa-check text-dark me-2"></i>Batasi makanan olahan</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Diet Rendah Purin -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card diet-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="diet-icon" style="background: linear-gradient(135deg, #c0392b, #a93226);">
                            <i class="fas fa-bone fa-2x text-white"></i>
                        </div>
                        <h4 class="text-center mb-3">Diet Rendah Purin</h4>
                        <span class="badge badge-custom mb-3 d-block text-center" style="background: #c0392b; color: white;">Asam Urat</span>
                        <p class="text-muted">Untuk penderita hiperurisemia dan gout dengan pembatasan makanan tinggi purin.</p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-danger me-2"></i>Hindari jeroan</li>
                            <li class="mb-2"><i class="fas fa-check text-danger me-2"></i>Batasi seafood</li>
                            <li class="mb-2"><i class="fas fa-check text-danger me-2"></i>Banyak minum air</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tips Section -->
<section class="py-5" style="background: var(--light);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold mb-3">Tips Memilih Diet yang Tepat</h2>
            <div class="underline mx-auto" style="width: 80px; height: 4px; background: var(--primary);"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-md text-white fa-lg"></i>
                                </div>
                            </div>
                            <h5 class="mb-0 ms-3">Konsultasi dengan Ahli</h5>
                        </div>
                        <p class="text-muted mb-0">Selalu konsultasikan dengan dokter atau ahli gizi sebelum memulai diet khusus, terutama jika memiliki kondisi medis tertentu.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-clipboard-check text-white fa-lg"></i>
                                </div>
                            </div>
                            <h5 class="mb-0 ms-3">Sesuaikan Kebutuhan</h5>
                        </div>
                        <p class="text-muted mb-0">Pilih diet yang sesuai dengan kondisi kesehatan, aktivitas fisik, dan tujuan kesehatan Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-clock text-white fa-lg"></i>
                                </div>
                            </div>
                            <h5 class="mb-0 ms-3">Konsisten dan Sabar</h5>
                        </div>
                        <p class="text-muted mb-0">Hasil yang optimal membutuhkan waktu dan konsistensi. Jangan mengharapkan perubahan instan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-chart-line text-white fa-lg"></i>
                                </div>
                            </div>
                            <h5 class="mb-0 ms-3">Monitor Progress</h5>
                        </div>
                        <p class="text-muted mb-0">Lakukan pemeriksaan rutin dan catat perkembangan untuk mengevaluasi efektivitas diet Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5">
    <div class="container">
        <div class="text-center" data-aos="zoom-in">
            <h3 class="fw-bold mb-3">Ingin Tahu Diet yang Cocok untuk Anda?</h3>
            <p class="text-muted mb-4">Gunakan fitur Cek Status Gizi kami untuk mendapatkan rekomendasi diet yang sesuai dengan kondisi Anda</p>
            <a href="{{ route('login') }}" class="btn btn-lg px-5 rounded-pill" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                <i class="fas fa-calculator me-2"></i>Cek Status Gizi
            </a>
        </div>
    </div>
</section>
@endsection