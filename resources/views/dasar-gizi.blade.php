@extends('layouts.app')

@section('title', 'Dasar Gizi')

@push('styles')
<style>
    .tab-content-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .nav-pills .nav-link {
        border-radius: 10px;
        padding: 1rem 1.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s;
        color: var(--dark);
    }
    
    .nav-pills .nav-link:hover {
        background: var(--light);
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
         color: #fff !important;
         box-shadow: 0 4px 12px rgba(46, 204, 113, 0.45);
    }

    .nav-pills .nav-link.active i {
    color: #fff;
}
    
    .table-custom {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .table-custom thead {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<section class="py-5" style="background: linear-gradient(135deg,  #298620 0%, #adfda6  100%); color: white;">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3">Dasar Gizi</h1>
            <p class="lead">Panduan lengkap angka kecukupan gizi dan nilai nutrisi bahan makanan</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4" data-aos="fade-right">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-3">
                        <h6 class="mb-3 px-3">Menu Dasar Gizi</h6>
                        <ul class="nav nav-pills flex-column" id="v-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="akg-tab" data-bs-toggle="pill" href="#akg" role="tab">
                                    <i class="fas fa-chart-pie me-2"></i>AKG Indonesia
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="vitamin-tab" data-bs-toggle="pill" href="#vitamin" role="tab">
                                    <i class="fas fa-pills me-2"></i>Angka Vitamin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="mineral-tab" data-bs-toggle="pill" href="#mineral" role="tab">
                                    <i class="fas fa-gem me-2"></i>Angka Mineral
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="penukar-tab" data-bs-toggle="pill" href="#penukar" role="tab">
                                    <i class="fas fa-exchange-alt me-2"></i>Bahan Penukar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="golongan-tab" data-bs-toggle="pill" href="#golongan" role="tab">
                                    <i class="fas fa-layer-group me-2"></i>8 Golongan Bahan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Content Area -->
            <div class="col-lg-9" data-aos="fade-left">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- AKG Indonesia -->
                    <div class="tab-pane fade show active" id="akg" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-chart-pie text-primary me-2"></i>Angka Kecukupan Gizi (AKG) untuk Masyarakat Indonesia</h3>
                            <p class="text-muted mb-4">Berdasarkan Peraturan Menteri Kesehatan RI tentang Angka Kecukupan Gizi yang Dianjurkan untuk Masyarakat Indonesia</p>
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Kelompok Usia</th>
                                            <th>Energi (kkal)</th>
                                            <th>Protein (g)</th>
                                            <th>Lemak (g)</th>
                                            <th>Karbohidrat (g)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Bayi 0-6 bulan</td>
                                            <td>550</td>
                                            <td>12</td>
                                            <td>34</td>
                                            <td>58</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Bayi 7-11 bulan</td>
                                            <td>725</td>
                                            <td>18</td>
                                            <td>36</td>
                                            <td>82</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Anak 1-3 tahun</td>
                                            <td>1125</td>
                                            <td>26</td>
                                            <td>44</td>
                                            <td>155</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Anak 4-6 tahun</td>
                                            <td>1600</td>
                                            <td>35</td>
                                            <td>62</td>
                                            <td>220</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Anak 7-9 tahun</td>
                                            <td>1850</td>
                                            <td>49</td>
                                            <td>72</td>
                                            <td>254</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 10-12 tahun</td>
                                            <td>2100</td>
                                            <td>56</td>
                                            <td>70</td>
                                            <td>289</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 13-15 tahun</td>
                                            <td>2475</td>
                                            <td>72</td>
                                            <td>83</td>
                                            <td>340</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 16-18 tahun</td>
                                            <td>2675</td>
                                            <td>66</td>
                                            <td>89</td>
                                            <td>368</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 19-29 tahun</td>
                                            <td>2725</td>
                                            <td>65</td>
                                            <td>91</td>
                                            <td>375</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 30-49 tahun</td>
                                            <td>2625</td>
                                            <td>65</td>
                                            <td>73</td>
                                            <td>394</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 10-12 tahun</td>
                                            <td>2000</td>
                                            <td>60</td>
                                            <td>67</td>
                                            <td>275</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 13-15 tahun</td>
                                            <td>2125</td>
                                            <td>69</td>
                                            <td>71</td>
                                            <td>292</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 16-18 tahun</td>
                                            <td>2125</td>
                                            <td>59</td>
                                            <td>71</td>
                                            <td>292</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 19-29 tahun</td>
                                            <td>2250</td>
                                            <td>60</td>
                                            <td>75</td>
                                            <td>309</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 30-49 tahun</td>
                                            <td>2150</td>
                                            <td>60</td>
                                            <td>60</td>
                                            <td>323</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Hamil (+trimester 1)</td>
                                            <td>+180</td>
                                            <td>+20</td>
                                            <td>+6</td>
                                            <td>+25</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Hamil (+trimester 2-3)</td>
                                            <td>+300</td>
                                            <td>+20</td>
                                            <td>+10</td>
                                            <td>+40</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Menyusui (6 bln pertama)</td>
                                            <td>+330</td>
                                            <td>+20</td>
                                            <td>+11</td>
                                            <td>+45</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Vitamin -->
                    <div class="tab-pane fade" id="vitamin" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-pills text-primary me-2"></i>Angka Kecukupan Vitamin yang Dianjurkan</h3>
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Kelompok</th>
                                            <th>Vit A (mcg)</th>
                                            <th>Vit D (mcg)</th>
                                            <th>Vit E (mg)</th>
                                            <th>Vit K (mcg)</th>
                                            <th>Vit B1 (mg)</th>
                                            <th>Vit B2 (mg)</th>
                                            <th>Vit B3 (mg)</th>
                                            <th>Vit B6 (mg)</th>
                                            <th>Vit B12 (mcg)</th>
                                            <th>Vit C (mg)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 19-29 th</td>
                                            <td>650</td>
                                            <td>15</td>
                                            <td>15</td>
                                            <td>65</td>
                                            <td>1.2</td>
                                            <td>1.3</td>
                                            <td>16</td>
                                            <td>1.3</td>
                                            <td>2.4</td>
                                            <td>90</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 30-49 th</td>
                                            <td>650</td>
                                            <td>15</td>
                                            <td>15</td>
                                            <td>65</td>
                                            <td>1.2</td>
                                            <td>1.3</td>
                                            <td>16</td>
                                            <td>1.3</td>
                                            <td>2.4</td>
                                            <td>90</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 19-29 th</td>
                                            <td>600</td>
                                            <td>15</td>
                                            <td>15</td>
                                            <td>55</td>
                                            <td>1.1</td>
                                            <td>1.1</td>
                                            <td>14</td>
                                            <td>1.3</td>
                                            <td>2.4</td>
                                            <td>75</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 30-49 th</td>
                                            <td>600</td>
                                            <td>15</td>
                                            <td>15</td>
                                            <td>55</td>
                                            <td>1.1</td>
                                            <td>1.1</td>
                                            <td>14</td>
                                            <td>1.3</td>
                                            <td>2.4</td>
                                            <td>75</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Hamil</td>
                                            <td>+300</td>
                                            <td>+0</td>
                                            <td>+0</td>
                                            <td>+0</td>
                                            <td>+0.3</td>
                                            <td>+0.3</td>
                                            <td>+4</td>
                                            <td>+0.4</td>
                                            <td>+0.2</td>
                                            <td>+10</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Menyusui</td>
                                            <td>+350</td>
                                            <td>+0</td>
                                            <td>+4</td>
                                            <td>+0</td>
                                            <td>+0.3</td>
                                            <td>+0.4</td>
                                            <td>+3</td>
                                            <td>+0.5</td>
                                            <td>+0.4</td>
                                            <td>+25</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Catatan:</strong> Angka di atas adalah kebutuhan harian yang dianjurkan. Konsumsi berlebihan vitamin tertentu dapat berbahaya.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mineral -->
                    <div class="tab-pane fade" id="mineral" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-gem text-primary me-2"></i>Angka Kecukupan Mineral yang Dianjurkan</h3>
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Kelompok</th>
                                            <th>Kalsium (mg)</th>
                                            <th>Fosfor (mg)</th>
                                            <th>Magnesium (mg)</th>
                                            <th>Natrium (mg)</th>
                                            <th>Kalium (mg)</th>
                                            <th>Besi (mg)</th>
                                            <th>Seng (mg)</th>
                                            <th>Selenium (mcg)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 19-29 th</td>
                                            <td>1000</td>
                                            <td>700</td>
                                            <td>350</td>
                                            <td>1500</td>
                                            <td>4700</td>
                                            <td>13</td>
                                            <td>13</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Laki-laki 30-49 th</td>
                                            <td>1000</td>
                                            <td>700</td>
                                            <td>350</td>
                                            <td>1500</td>
                                            <td>4700</td>
                                            <td>13</td>
                                            <td>13</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 19-29 th</td>
                                            <td>1000</td>
                                            <td>700</td>
                                            <td>310</td>
                                            <td>1500</td>
                                            <td>4700</td>
                                            <td>26</td>
                                            <td>10</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Perempuan 30-49 th</td>
                                            <td>1000</td>
                                            <td>700</td>
                                            <td>320</td>
                                            <td>1500</td>
                                            <td>4700</td>
                                            <td>26</td>
                                            <td>10</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Hamil</td>
                                            <td>+200</td>
                                            <td>+0</td>
                                            <td>+40</td>
                                            <td>+0</td>
                                            <td>+0</td>
                                            <td>+9</td>
                                            <td>+2</td>
                                            <td>+5</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Ibu Menyusui</td>
                                            <td>+200</td>
                                            <td>+0</td>
                                            <td>+0</td>
                                            <td>+0</td>
                                            <td>+400</td>
                                            <td>+3</td>
                                            <td>+5</td>
                                            <td>+10</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bahan Penukar -->
                    <div class="tab-pane fade" id="penukar" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-exchange-alt text-primary me-2"></i>Daftar Bahan Makanan Penukar</h3>
                            <p class="text-muted mb-4">Bahan makanan yang dapat saling menggantikan dalam satu kelompok dengan nilai gizi yang setara</p>
                            
                            <div class="accordion" id="accordionPenukar">
                                <!-- Sumber Karbohidrat -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#carbs">
                                            <i class="fas fa-bread-slice text-warning me-2"></i> Sumber Karbohidrat (1 Penukar = 175 kkal)
                                        </button>
                                    </h2>
                                    <div id="carbs" class="accordion-collapse collapse show" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Nasi putih: 100 gram (3/4 gelas)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Nasi merah: 100 gram (3/4 gelas)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Roti tawar: 70 gram (3 lembar)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kentang: 200 gram (2 buah sedang)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Singkong: 120 gram</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Ubi jalar: 135 gram (1 buah kecil)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Jagung: 125 gram (1 tongkol besar)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Mie basah: 200 gram (2 gelas)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Havermout: 40 gram (4 sdm)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Crackers: 50 gram (5 keping besar)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Protein Hewani -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#protein-hewani">
                                            <i class="fas fa-drumstick-bite text-danger me-2"></i> Protein Hewani (1 Penukar = 75 kkal)
                                        </button>
                                    </h2>
                                    <div id="protein-hewani" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Daging sapi: 50 gram (1 potong sedang)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Daging ayam: 50 gram (1 potong sedang)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Ikan segar: 50 gram (1 potong sedang)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Telur ayam: 55 gram (1 butir)</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Udang segar: 50 gram (5 ekor sedang)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Cumi-cumi: 50 gram</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Hati sapi: 40 gram</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i>Keju: 30 gram (2 lembar)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Protein Nabati -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#protein-nabati">
                                            <i class="fas fa-seedling text-success me-2"></i> Protein Nabati (1 Penukar = 80 kkal)
                                        </button>
                                    </h2>
                                    <div id="protein-nabati" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Tempe: 50 gram (2 potong sedang)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Tahu: 100 gram (2 potong besar)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kacang hijau: 25 gram (2.5 sdm)</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kacang merah: 25 gram (2.5 sdm)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kacang kedelai: 25 gram (2.5 sdm)</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kacang tanah: 20 gram (1.5 sdm)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 8 Golongan Bahan -->
                    <div class="tab-pane fade" id="golongan" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-layer-group text-primary me-2"></i>Rata-rata Nilai Gizi 8 Golongan Bahan Makanan</h3>
                            
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #f39c12, #e67e22); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-bread-slice fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan I</h6>
                                            <p class="text-muted small mb-2">Sumber Karbohidrat</p>
                                            <p class="mb-0 small">Nasi, roti, mie, kentang, singkong</p>
                                            <hr>
                                            <small class="text-muted">175 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #e74c3c, #c0392b); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-drumstick-bite fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan II</h6>
                                            <p class="text-muted small mb-2">Protein Hewani</p>
                                            <p class="mb-0 small">Daging, ayam, ikan, telur, susu</p>
                                            <hr>
                                            <small class="text-muted">75 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #2ecc71, #27ae60); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-seedling fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan III</h6>
                                            <p class="text-muted small mb-2">Protein Nabati</p>
                                            <p class="mb-0 small">Tempe, tahu, kacang-kacangan</p>
                                            <hr>
                                            <small class="text-muted">80 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #27ae60, #229954); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-carrot fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan IV</h6>
                                            <p class="text-muted small mb-2">Sayuran</p>
                                            <p class="mb-0 small">Bayam, kangkung, wortel, tomat</p>
                                            <hr>
                                            <small class="text-muted">25 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #e67e22, #d35400); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-apple-alt fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan V</h6>
                                            <p class="text-muted small mb-2">Buah-buahan</p>
                                            <p class="mb-0 small">Pisang, apel, jeruk, pepaya</p>
                                            <hr>
                                            <small class="text-muted">50 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #f1c40f, #f39c12); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-oil-can fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan VI</h6>
                                            <p class="text-muted small mb-2">Minyak & Lemak</p>
                                            <p class="mb-0 small">Minyak goreng, margarin, santan</p>
                                            <hr>
                                            <small class="text-muted">50 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-glass-whiskey fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan VII</h6>
                                            <p class="text-muted small mb-2">Susu</p>
                                            <p class="mb-0 small">Susu sapi, susu kedelai, yogurt</p>
                                            <hr>
                                            <small class="text-muted">Variasi kalori</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #9b59b6, #8e44ad); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-candy-cane fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan VIII</h6>
                                            <p class="text-muted small mb-2">Gula</p>
                                            <p class="mb-0 small">Gula pasir, madu, sirup</p>
                                            <hr>
                                            <small class="text-muted">20 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Banner -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h3 class="mb-3">Butuh Bantuan Memahami Kebutuhan Gizi Anda?</h3>
                <p class="mb-lg-0">Gunakan fitur Cek Status Gizi kami untuk mendapatkan analisis personal berdasarkan kondisi kesehatan Anda</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 rounded-pill">
                    <i class="fas fa-calculator me-2"></i>Cek Status Gizi
                </a>
            </div>
        </div>
    </div>
</section>

@endsection