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
    
    .food-item-card {
        background: #f8f9fa;
        border-left: 3px solid #059669;
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        border-radius: 5px;
        transition: all 0.2s;
    }
    
    .food-item-card:hover {
        background: #e8f5f1;
        transform: translateX(5px);
    }
    
    .badge-kalium {
        background: #ffc107;
        color: #000;
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
        border-radius: 3px;
        margin-left: 0.5rem;
    }
    
    .badge-natrium {
        background: #dc3545;
        color: #fff;
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
        border-radius: 3px;
        margin-left: 0.5rem;
    }
    
    .badge-purin {
        background: #6f42c1;
        color: #fff;
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
        border-radius: 3px;
        margin-left: 0.5rem;
    }
    
    .food-category-header {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .info-box {
        background: #e3f2fd;
        border-left: 4px solid #2196f3;
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 5px;
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<section class="py-5" style="background: linear-gradient(135deg, #298620 0%, #adfda6 100%); color: white;">
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
                    
                    <!-- Bahan Penukar - ENHANCED WITH COMPLETE DATA FROM PDF -->
                    <div class="tab-pane fade" id="penukar" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-exchange-alt text-primary me-2"></i>Daftar Bahan Makanan Penukar Lengkap</h3>
                            <p class="text-muted mb-4">Bahan makanan yang dapat saling menggantikan dalam satu kelompok dengan nilai gizi yang setara (sumber: RS UGM)</p>
                            
                            <div class="info-box">
                                <h6><i class="fas fa-info-circle me-2"></i>Keterangan Simbol:</h6>
                                <p class="mb-1"><span class="badge-kalium">K+</span> = Kadar Kalium sedang | <span class="badge-kalium">K++</span> = Kadar Kalium tinggi (>300 mg/100g)</p>
                                <p class="mb-1"><span class="badge-natrium">Na+</span> = Kadar Natrium sedang | <span class="badge-natrium">Na++</span> = Kadar Natrium tinggi</p>
                                <p class="mb-0"><span class="badge-purin">Pr+</span> = Kadar Purin sedang | <span class="badge-purin">Pr++</span> = Kadar Purin tinggi</p>
                            </div>

                            <div class="accordion" id="accordionPenukar">
                                <!-- GOLONGAN I: SUMBER KARBOHIDRAT -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#golongan1">
                                            <i class="fas fa-bread-slice text-warning me-2"></i> <strong>Golongan I: Sumber Karbohidrat</strong>
                                            <span class="ms-2 badge bg-warning text-dark">1 Penukar = 175 Kkal, 4g protein, 40g KH</span>
                                        </button>
                                    </h2>
                                    <div id="golongan1" class="accordion-collapse collapse show" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Bihun: 50g (½ gelas)</div>
                                                    <div class="food-item-card">Biskuit: 40g (4 buah besar)<span class="badge-natrium">Na+</span></div>
                                                    <div class="food-item-card">Havermout: 45g (5½ sdm)</div>
                                                    <div class="food-item-card">Jagung Segar: 125g (3 buah sedang)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Kentang: 210g (2 buah sedang)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Maizena: 50g (10 sdm)</div>
                                                    <div class="food-item-card">Macaroni: 50g (½ gelas)</div>
                                                    <div class="food-item-card">Mie basah: 200g (2 gelas)<span class="badge-natrium">Na++</span></div>
                                                    <div class="food-item-card">Mie kering: 50g (1 gelas)<span class="badge-natrium">Na++</span></div>
                                                    <div class="food-item-card">Nasi putih: 100g (¾ gelas)</div>
                                                    <div class="food-item-card">Nasi tim: 200g (1 gelas)</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Nasi Ketan Hitam: 100g (¾ gelas)</div>
                                                    <div class="food-item-card">Nasi Ketan Putih: 100g (¾ gelas)</div>
                                                    <div class="food-item-card">Roti Tawar: 70g (2 lembar)<span class="badge-natrium">Na+</span></div>
                                                    <div class="food-item-card">Singkong: 120g (1½ potong)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Sukun: 150g (3 potong sedang)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Talas: 125g (½ biji sedang)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Tape Beras Ketan: 100g (5 sdm)</div>
                                                    <div class="food-item-card">Tape Singkong: 100g (1 potong sedang)</div>
                                                    <div class="food-item-card">Tepung Terigu: 50g (5 sdm)</div>
                                                    <div class="food-item-card">Ubi jalar Kuning: 135g (1 biji sedang)<span class="badge-kalium">K++</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN II: PROTEIN HEWANI -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan2">
                                            <i class="fas fa-drumstick-bite text-danger me-2"></i> <strong>Golongan II: Protein Hewani</strong>
                                        </button>
                                    </h2>
                                    <div id="golongan2" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="food-category-header">
                                                A. Rendah Lemak (1 Penukar = 50 Kkal, 7g protein, 2g lemak)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Daging ayam tanpa kulit: 40g (1 potong kecil)</div>
                                                    <div class="food-item-card">Cumi-cumi: 45g (1 ekor kecil)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Ikan Kembung: 30g (⅓ ekor sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Ikan Lele: 40g (½ ekor sedang)</div>
                                                    <div class="food-item-card">Ikan Pindang: 25g (½ ekor sedang)</div>
                                                    <div class="food-item-card">Ikan Segar: 40g (1 potong sedang)</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Kepiting: 50g (⅓ gelas)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Kerang: 90g (½ gelas)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Putih Telur Ayam: 65g (2½ butir)</div>
                                                    <div class="food-item-card">Rebon Kering: 10g (2 sdm)</div>
                                                    <div class="food-item-card">Teri Kering: 20g (1 sdm)</div>
                                                    <div class="food-item-card">Udang Segar: 35g (5 ekor sedang)<span class="badge-purin">Pr++</span></div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                B. Lemak Sedang (1 Penukar = 75 Kkal, 7g protein, 5g lemak)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Bakso: 170g (10 biji sedang)<span class="badge-purin">Pr+</span></div>
                                                    <div class="food-item-card">Daging kambing: 40g (1 potong sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Daging sapi: 35g (1 potong sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Hati Ayam: 30g (1 buah sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Hati Sapi: 35g (1 potong sedang)<span class="badge-purin">Pr++</span></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Otak: 65g (1 potong besar)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Telur Ayam: 55g (1 butir)</div>
                                                    <div class="food-item-card">Telur Bebek Asin: 50g (1 butir)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Telur Puyuh: 65g (5 butir)<span class="badge-purin">Pr++</span></div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                C. Lemak Tinggi (1 Penukar = 150 Kkal, 7g protein, 13g lemak)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Ayam dengan kulit: 40g (1 potong sedang)<span class="badge-purin">Pr+</span></div>
                                                    <div class="food-item-card">Bebek: 45g (1 potong sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Belut: 45g (3 ekor kecil)</div>
                                                    <div class="food-item-card">Corned beef: 45g (1 potong sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Daging babi: 50g (1½ potong kecil)</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Ham: 40g (½ potong sedang)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Sarden: 35g (½ potong)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Sosis: 50g (4 butir)<span class="badge-purin">Pr++</span></div>
                                                    <div class="food-item-card">Kuning telur ayam: 45g (1 butir)</div>
                                                    <div class="food-item-card">Telur Ikan: 40g (1 potong sedang)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN III: PROTEIN NABATI -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan3">
                                            <i class="fas fa-seedling text-success me-2"></i> <strong>Golongan III: Protein Nabati</strong>
                                            <span class="ms-2 badge bg-success">1 Penukar = 75 Kkal, 5g protein, 3g lemak, 7g KH</span>
                                        </button>
                                    </h2>
                                    <div id="golongan3" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Kacang hijau: 20g (2 sdm)</div>
                                                    <div class="food-item-card">Kacang kedelai: 25g (2½ sdm)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Kacang merah: 20g (2 sdm)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Kacang mete: 15g (1½ sdm)</div>
                                                    <div class="food-item-card">Kacang tanah kupas: 15g (2 sdm)</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Kacang tolo: 20g (2 sdm)</div>
                                                    <div class="food-item-card">Pete Segar: 55g (½ gelas)</div>
                                                    <div class="food-item-card">Sari kedelai bubuk: 185g (2½ sdm)</div>
                                                    <div class="food-item-card">Tahu: 110g (1 biji besar)</div>
                                                    <div class="food-item-card">Tempe: 50g (2 potong sedang)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN IV: SAYURAN -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan4">
                                            <i class="fas fa-carrot text-success me-2"></i> <strong>Golongan IV: Sayuran</strong>
                                        </button>
                                    </h2>
                                    <div id="golongan4" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="food-category-header">
                                                A. Sayuran A (Bebas dikonsumsi - minim kalori)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <span class="badge bg-light text-dark border">Gambas</span>
                                                        <span class="badge bg-light text-dark border">Jamur kuping segar <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-light text-dark border">Ketimun</span>
                                                        <span class="badge bg-light text-dark border">Labu air</span>
                                                        <span class="badge bg-light text-dark border">Lobak</span>
                                                        <span class="badge bg-light text-dark border">Oyong</span>
                                                        <span class="badge bg-light text-dark border">Slada air</span>
                                                        <span class="badge bg-light text-dark border">Slada <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-light text-dark border">Tomat</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                B. Sayuran B (1 Penukar = 1 gelas/100g = 25 Kkal, 1g protein, 5g KH)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <span class="badge bg-success text-white">Bayam <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Bit <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Buncis <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Brokoli</span>
                                                        <span class="badge bg-success text-white">Caisim</span>
                                                        <span class="badge bg-success text-white">Daun pakis</span>
                                                        <span class="badge bg-success text-white">Daun Waluh</span>
                                                        <span class="badge bg-success text-white">Genjer</span>
                                                        <span class="badge bg-success text-white">Jagung muda</span>
                                                        <span class="badge bg-success text-white">Jantung pisang</span>
                                                        <span class="badge bg-success text-white">Kol</span>
                                                        <span class="badge bg-success text-white">Kembang kol</span>
                                                        <span class="badge bg-success text-white">Kapri muda <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Kucai</span>
                                                        <span class="badge bg-success text-white">Kacang panjang <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Kecipir</span>
                                                        <span class="badge bg-success text-white">Labu siam</span>
                                                        <span class="badge bg-success text-white">Labu waluh</span>
                                                        <span class="badge bg-success text-white">Lembayung <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Pare</span>
                                                        <span class="badge bg-success text-white">Pepaya muda</span>
                                                        <span class="badge bg-success text-white">Rebung <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Sawi <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Seledri <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-success text-white">Terong</span>
                                                        <span class="badge bg-success text-white">Wortel</span>
                                                        <span class="badge bg-success text-white">Kangkung</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                C. Sayuran C (1 Penukar = 1 gelas/100g = 50 Kkal, 3g protein, 10g KH)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <span class="badge bg-warning text-dark">Bayam merah <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Daun katuk <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Daun melinjo <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Daun pepaya <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Melinjo</span>
                                                        <span class="badge bg-warning text-dark">Nangka muda</span>
                                                        <span class="badge bg-warning text-dark">Daun singkong <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Daun talas</span>
                                                        <span class="badge bg-warning text-dark">Kacang kapri <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Kluwih <span class="badge-kalium">**</span></span>
                                                        <span class="badge bg-warning text-dark">Taoge kacang kedelai <span class="badge-kalium">**</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN V: BUAH -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan5">
                                            <i class="fas fa-apple-alt text-danger me-2"></i> <strong>Golongan V: Buah dan Gula</strong>
                                            <span class="ms-2 badge bg-danger">1 Penukar = 50 Kkal, 12g KH</span>
                                        </button>
                                    </h2>
                                    <div id="golongan5" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Anggur: 165g (10 buah)</div>
                                                    <div class="food-item-card">Apel Merah: 85g (¾ buah sedang)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Apel Malang: 75g (1 buah kecil)</div>
                                                    <div class="food-item-card">Belimbing: 140g (1 buah sedang)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Bengkoang: 75g (¼ buah besar)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Blewah: 70g (1 potong sedang)</div>
                                                    <div class="food-item-card">Duku: 80g (8 buah)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Durian: 35g (3 butir kecil)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Jambu Air: 110g (4 buah sedang)</div>
                                                    <div class="food-item-card">Jambu Biji: 100g (⅓ buah besar)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Jeruk Manis: 110g (1 buah sedang)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Kolang-kaling: 25g (5 buah sedang)</div>
                                                    <div class="food-item-card">Kedondong: 120g (2½ buah)</div>
                                                    <div class="food-item-card">Kesemek: 65g (½ buah)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Kurma: 15g (3 buah)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Kiwi: 110g (1½ buah)<span class="badge-kalium">K++</span></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Mangga: 90g (½ buah sedang)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Manggis: 80g (2 buah besar)</div>
                                                    <div class="food-item-card">Markisa: 35g<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Melon: 190g (2 potong besar)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Nangka Masak: 45g (1 biji besar)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Naga: 90g (1 potong sedang)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Nanas: 95g (1 potong sedang)</div>
                                                    <div class="food-item-card">Pear: 85g (¾ buah sedang)</div>
                                                    <div class="food-item-card">Pepaya: 190g (1 potong)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Pisang: 40g (1 buah sedang)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Rambutan: 75g (8 buah)<span class="badge-kalium">K+</span></div>
                                                    <div class="food-item-card">Sawo: 55g (1 buah kecil)</div>
                                                    <div class="food-item-card">Salak: 65g (1 buah besar)</div>
                                                    <div class="food-item-card">Semangka: 180g (1 potong besar)</div>
                                                    <div class="food-item-card">Sirsak: 60g (1 potong sedang)</div>
                                                    <div class="food-item-card">Strawberry: 215g (13 buah sedang)<span class="badge-kalium">K+</span></div>
                                                </div>
                                            </div>
                                            <div class="alert alert-warning mt-3">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                <strong>Catatan untuk Diabetes:</strong> Pasien diabetes sebaiknya menghindari pisang raja, pisang emas, dan pisang tanduk.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN VI: SUSU -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan6">
                                            <i class="fas fa-glass-whiskey text-info me-2"></i> <strong>Golongan VI: Susu</strong>
                                        </button>
                                    </h2>
                                    <div id="golongan6" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="food-category-header">
                                                A. Susu Tanpa Lemak (1 Penukar = 75 Kkal, 7g protein, 10g KH)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="food-item-card">Susu skim cair: 200g (1 gelas)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Tepung susu skim: 20g (2 sdm)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Yogurt Non Fat: 120g (½ gelas)<span class="badge-kalium">K++</span></div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                B. Susu Rendah Lemak (1 Penukar = 125 Kkal, 7g protein, 6g lemak, 10g KH)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="food-item-card">Keju: 35g (1 potong kecil)<span class="badge-natrium">Na++</span></div>
                                                    <div class="food-item-card">Susu kambing: 165g (¾ gelas)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Susu sapi: 200g (1 gelas)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Yogurt Susu Penuh: 200g (1 gelas)<span class="badge-kalium">K++</span></div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                C. Susu Tinggi Lemak (1 Penukar = 150 Kkal, 7g protein, 10g lemak, 10g KH)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="food-item-card">Susu Full Cream: 200g (1 gelas)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Tepung Susu Penuh: 30g (3 sdm)<span class="badge-kalium">K++</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN VII: MINYAK -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan7">
                                            <i class="fas fa-oil-can text-warning me-2"></i> <strong>Golongan VII: Minyak & Lemak</strong>
                                            <span class="ms-2 badge bg-warning text-dark">1 Penukar = 50 Kkal, 5g lemak</span>
                                        </button>
                                    </h2>
                                    <div id="golongan7" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="food-category-header">
                                                A. Lemak Tidak Jenuh (Lebih sehat)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Alpukat: 60g (½ buah sedang)<span class="badge-kalium">K++</span></div>
                                                    <div class="food-item-card">Kacang Almond: 25g (7 biji)</div>
                                                    <div class="food-item-card">Mayonaise: 20g (2 sdm)</div>
                                                    <div class="food-item-card">Minyak Bunga Matahari: 5g (1 sdt)</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Minyak Jagung: 5g (1 sdt)</div>
                                                    <div class="food-item-card">Minyak Kacang Kedelai: 5g (1 sdt)</div>
                                                    <div class="food-item-card">Minyak Zaitun: 5g (1 sdt)</div>
                                                </div>
                                            </div>

                                            <div class="food-category-header mt-3">
                                                B. Lemak Jenuh (Batasi konsumsi)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Mentega: 15g (1 sdm)</div>
                                                    <div class="food-item-card">Santan (peras dengan air): 40g (⅓ gelas)</div>
                                                    <div class="food-item-card">Kelapa: 15g (1 potong kecil)</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="food-item-card">Keju Krim: 15g (1 potong kecil)</div>
                                                    <div class="food-item-card">Minyak kelapa: 5g (1 sdt)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- GOLONGAN VIII: MAKANAN TANPA KALORI -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#golongan8">
                                            <i class="fas fa-mug-hot text-secondary me-2"></i> <strong>Golongan VIII: Makanan Tanpa Kalori</strong>
                                            <span class="ms-2 badge bg-secondary">Bebas dikonsumsi</span>
                                        </button>
                                    </h2>
                                    <div id="golongan8" class="accordion-collapse collapse" data-bs-parent="#accordionPenukar">
                                        <div class="accordion-body">
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge bg-light text-dark border p-2">Agar-agar</span>
                                                <span class="badge bg-light text-dark border p-2">Gula alternatif (sukralosa, sorbitol)</span>
                                                <span class="badge bg-light text-dark border p-2">Air Mineral</span>
                                                <span class="badge bg-light text-dark border p-2">Air kaldu</span>
                                                <span class="badge bg-light text-dark border p-2">Gelatin</span>
                                                <span class="badge bg-light text-dark border p-2">Teh</span>
                                                <span class="badge bg-light text-dark border p-2">Kopi</span>
                                            </div>
                                            <div class="alert alert-info mt-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Makanan ini dapat dikonsumsi tanpa batasan karena tidak mengandung kalori atau mengandung kalori minimal.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <!-- 8 Golongan Bahan - SUMMARY VERSION -->
                    <div class="tab-pane fade" id="golongan" role="tabpanel">
                        <div class="tab-content-card p-4">
                            <h3 class="mb-4"><i class="fas fa-layer-group text-primary me-2"></i>Ringkasan 8 Golongan Bahan Makanan</h3>
                            
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
                                            <small class="text-muted">175 kkal, 4g protein, 40g KH per penukar</small>
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
                                            <p class="mb-0 small">Daging, ayam, ikan, telur</p>
                                            <hr>
                                            <small class="text-muted">50-150 kkal per penukar (tergantung lemak)</small>
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
                                            <small class="text-muted">75 kkal, 5g protein, 3g lemak, 7g KH</small>
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
                                            <small class="text-muted">25-50 kkal per penukar</small>
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
                                            <p class="text-muted small mb-2">Buah-buahan & Gula</p>
                                            <p class="mb-0 small">Pisang, apel, jeruk, pepaya</p>
                                            <hr>
                                            <small class="text-muted">50 kkal, 12g KH per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #3498db, #2980b9); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-glass-whiskey fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan VI</h6>
                                            <p class="text-muted small mb-2">Susu</p>
                                            <p class="mb-0 small">Susu sapi, yogurt</p>
                                            <hr>
                                            <small class="text-muted">75-150 kkal per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #f1c40f, #f39c12); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-oil-can fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan VII</h6>
                                            <p class="text-muted small mb-2">Minyak & Lemak</p>
                                            <p class="mb-0 small">Minyak goreng, margarin, santan</p>
                                            <hr>
                                            <small class="text-muted">50 kkal, 5g lemak per penukar</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background: linear-gradient(135deg, #95a5a6, #7f8c8d); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-mug-hot fa-2x text-white"></i>
                                            </div>
                                            <h6 class="fw-bold mb-2">Golongan VIII</h6>
                                            <p class="text-muted small mb-2">Tanpa Kalori</p>
                                            <p class="mb-0 small">Teh, kopi, air mineral, agar-agar</p>
                                            <hr>
                                            <small class="text-muted">0 kkal - bebas dikonsumsi</small>
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
