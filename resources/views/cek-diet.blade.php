@extends('layouts.app')

@section('title', 'Cek Diet Gizi')

@section('content')
<style>
    :root {
        --primary-green: #0c7250;
        --primary-green-dark: #059669;
        --light-green: #d1fae5;
        --border-color: #e5e7eb;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
        --bg-light: #f9fbf9;
    }

    .diet-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .form-card {
        background: rgb(221, 255, 212);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .card-header .icon {
        color: var(--primary-green);
        font-size: 1.25rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .card-subtitle {
        color: var(--text-muted);
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .required {
        color: #ef4444;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s;
        background: white;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .form-textarea {
        min-height: 80px;
        resize: vertical;
        font-family: inherit;
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5rem 1.5rem;
        padding-right: 2.5rem;
    }

    .placeholder-text {
        color: var(--text-muted);
        font-size: 0.8125rem;
    }

    .btn-analyze {
        width: 100%;
        padding: 0.875rem 1.5rem;
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
    }

    .btn-analyze:hover {
        background: var(--primary-green-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-analyze:active {
        transform: translateY(0);
    }

    .btn-analyze:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Results Section */
    .results-container {
        display: none;
        animation: fadeIn 0.5s ease-in;
    }

    .results-container.show {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .metric-card {
        background: white;
        border: 1.5px solid var(--border-color);
        border-radius: 12px;
        padding: 1.25rem;
        text-align: center;
    }

    .metric-card.obesity {
        border-color: #fbbf24;
        background: #fffbeb;
    }

    .metric-card.normal {
        border-color: var(--primary-green);
        background: var(--light-green);
    }

    .metric-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .metric-card.obesity .metric-value {
        color: #f59e0b;
    }

    .metric-card.normal .metric-value {
        color: var(--primary-green);
    }

    .metric-status {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text-muted);
    }

    .diet-recommendation {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--primary-green);
    }

    .diet-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .diet-icon {
        color: var(--primary-green);
    }

    .diet-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .diet-subtitle {
        color: var(--text-muted);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .nutrition-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .nutrition-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .nutrition-item {
        text-align: center;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: 8px;
    }

    .nutrition-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
    }

    .nutrition-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .nutrition-unit {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .recommendations-list {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }

    .recommendation-item {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    .recommendation-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .recommendation-number {
        flex-shrink: 0;
        width: 1.5rem;
        height: 1.5rem;
        background: var(--primary-green);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .recommendation-text {
        color: var(--text-dark);
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .disclaimer-box {
        background: #fef3c7;
        border: 1px solid #fbbf24;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        gap: 0.75rem;
    }

    .disclaimer-icon {
        color: #f59e0b;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }

    .disclaimer-content {
        flex: 1;
    }

    .disclaimer-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #92400e;
        margin-bottom: 0.25rem;
    }

    .disclaimer-text {
        font-size: 0.8125rem;
        color: #78350f;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .form-grid,
        .metrics-grid,
        .nutrition-grid {
            grid-template-columns: 1fr;
        }

        .diet-container {
            padding: 0 0.5rem;
        }

        .form-card {
            padding: 1.5rem;
        }
    }
</style>

<section class="py-5" style="background: linear-gradient(135deg,  #298620 0%, #adfda6  100%); color: white;">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3">Cek Diet</h1>
            <p class="lead mb-0">Periksakan dirimu sebelum terlambat</p>
        </div>
    </div>
</section>

<div class="diet-container">
    <div class="form-card">
        <div class="card-header">
            <span class="icon">💚</span>
            <h2 class="card-title">Data Pemeriksaan</h2>
        </div>
        <p class="card-subtitle">Isi formulir di bawah dengan data yang akurat untuk hasil yang optimal</p>

        <form id="dietForm">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">
                        Tinggi Badan (cm) <span class="required">*</span>
                    </label>
                    <input type="number" name="tinggi" class="form-input" placeholder="170" required step="0.1">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Berat Badan (kg) <span class="required">*</span>
                    </label>
                    <input type="number" name="berat" class="form-input" placeholder="65" required step="0.1">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        LILA - Lingkar Lengan Atas (cm) <span class="required">*</span>
                    </label>
                    <input type="number" name="lila" class="form-input" placeholder="28.5" required step="0.1">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Umur (tahun) <span class="required">*</span>
                    </label>
                    <input type="number" name="umur" class="form-input" placeholder="25" required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Jenis Kelamin <span class="required">*</span>
                    </label>
                    <select name="jenisKelamin" class="form-select" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Tingkat Aktivitas Fisik <span class="required">*</span>
                    </label>
                    <select name="aktivitas" class="form-select" required>
                        <option value="">Pilih tingkat aktivitas</option>
                        <option value="sedentary">Sedentary (Sangat Sedikit Aktivitas)</option>
                        <option value="ringan">Ringan (Olahraga 1-3x/minggu)</option>
                        <option value="sedang">Sedang (Olahraga 3-5x/minggu)</option>
                        <option value="berat">Berat (Olahraga 6-7x/minggu)</option>
                        <option value="sangat-berat">Sangat Berat (Atlet/Kerja Fisik)</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Riwayat Penyakit</label>
                    <textarea name="riwayatPenyakit" class="form-textarea" placeholder="Contoh: Hipertensi sejak 2 tahun yang lalu, alergi seafood"></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Diagnosis Medis Terkini</label>
                    <textarea name="diagnosisMedis" class="form-textarea" placeholder="Contoh: Diabetes Mellitus Tipe 2, Hipertensi Grade 1"></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Pengobatan/Suplemen yang Sedang Dikonsumsi</label>
                    <textarea name="pengobatan" class="form-textarea" placeholder="Contoh: Metformin 500mg 2x1, Vitamin D 1000 IU"></textarea>
                </div>
            </div>

            <button type="submit" class="btn-analyze">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Analisis Sekarang
            </button>
        </form>
    </div>

    <div id="resultsContainer" class="results-container">
        <div class="metrics-grid" id="metricsGrid"></div>
        <div id="dietRecommendation"></div>
        <div id="nutritionNeeds"></div>
        <div id="recommendations"></div>
        <div id="disclaimer"></div>
    </div>
</div>

<script>
document.getElementById('dietForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = e.target.querySelector('.btn-analyze');
    const originalText = submitBtn.innerHTML;
    
    // Loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <svg class="animate-spin" width="20" height="20" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" stroke-opacity="0.25"></circle>
            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" opacity="0.75"></path>
        </svg>
        Menganalisis...
    `;

    try {
        const res = await fetch("{{ route('diet.calculate') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name=_token]').value,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tinggi: parseFloat(e.target.tinggi.value),
                berat: parseFloat(e.target.berat.value),
                lila: parseFloat(e.target.lila.value),
                umur: parseInt(e.target.umur.value),
                jenisKelamin: e.target.jenisKelamin.value,
                aktivitas: e.target.aktivitas.value,
                riwayatPenyakit: e.target.riwayatPenyakit.value,
                diagnosisMedis: e.target.diagnosisMedis.value,
                pengobatan: e.target.pengobatan.value
            })
        });

        const data = await res.json();

        // Show results
        displayResults(data);

        // Scroll to results
        setTimeout(() => {
            document.getElementById('resultsContainer').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }, 100);

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menganalisis data. Silakan coba lagi.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

function displayResults(data) {
    const resultsContainer = document.getElementById('resultsContainer');
    
    // Metrics Grid
    document.getElementById('metricsGrid').innerHTML = `
        <div class="metric-card ${data.bmiCategory.toLowerCase().includes('obesitas') ? 'obesity' : 'normal'}">
            <div class="metric-label">Indeks Massa Tubuh (IMT)</div>
            <div class="metric-value">${data.bmi}</div>
            <div class="metric-status">${data.bmiCategory}</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Kebutuhan Gizi Harian</div>
            <div class="metric-value">${data.tdee}</div>
            <div class="metric-status">kkal/Hari</div>
        </div>
        <div class="metric-card normal">
            <div class="metric-label">LILA</div>
            <div class="metric-value">${data.lila}</div>
            <div class="metric-status">Normal</div>
        </div>
    `;

    // Diet Recommendation
    document.getElementById('dietRecommendation').innerHTML = `
        <div class="diet-recommendation">
            <div class="diet-header">
                <span class="diet-icon">🥗</span>
                <h3 class="diet-title">Diet yang Dianjurkan</h3>
            </div>
            <div class="diet-subtitle">${data.diet.description}</div>
            <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-dark); margin: 0;">
                ${data.diet.type}
            </h4>
        </div>
    `;

    // Nutrition Needs
    document.getElementById('nutritionNeeds').innerHTML = `
        <div class="nutrition-section">
            <div class="section-header">
                <span style="font-size: 1.25rem;">📊</span>
                <h3 class="section-title">Kebutuhan Gizi Harian</h3>
            </div>
            <div class="nutrition-grid">
                <div class="nutrition-item">
                    <div class="nutrition-label">Protein</div>
                    <div class="nutrition-value">${data.nutrition.protein}</div>
                    <div class="nutrition-unit">Per Hari</div>
                </div>
                <div class="nutrition-item">
                    <div class="nutrition-label">Lemak</div>
                    <div class="nutrition-value">${data.nutrition.lemak}</div>
                    <div class="nutrition-unit">Per Hari</div>
                </div>
                <div class="nutrition-item">
                    <div class="nutrition-label">Karbohidrat</div>
                    <div class="nutrition-value">${data.nutrition.karbohidrat}</div>
                    <div class="nutrition-unit">Per Hari</div>
                </div>
            </div>
        </div>
    `;

    // Recommendations
    const recommendationsList = data.recommendations || [
        'Kurangi asupan kalori sebanyak 500 kkal/hari untuk penurunan bertahap',
        'Tingkatkan aktivitas fisik minimal 30 menit/hari',
        'Batasi makanan tinggi gula dan lemak jenuh'
    ];

    document.getElementById('recommendations').innerHTML = `
        <div class="recommendations-list">
            <div class="section-header">
                <span style="font-size: 1.25rem;">✓</span>
                <h3 class="section-title">Saran & Tindakan Lanjutan</h3>
            </div>
            ${recommendationsList.map((rec, idx) => `
                <div class="recommendation-item">
                    <div class="recommendation-number">${idx + 1}</div>
                    <div class="recommendation-text">${rec}</div>
                </div>
            `).join('')}
        </div>
    `;

    // Disclaimer
    document.getElementById('disclaimer').innerHTML = `
        <div class="disclaimer-box">
            <span class="disclaimer-icon">⚠️</span>
            <div class="disclaimer-content">
                <div class="disclaimer-title">Disclaimer:</div>
                <div class="disclaimer-text">
                    Hasil analisis ini adalah estimasi dan tidak menggantikan konsultasi dengan ahli gizi atau dokter. 
                    Untuk program diet yang lebih spesifik dan sesuai kondisi kesehatan Anda, silakan konsultasikan 
                    dengan tenaga kesehatan profesional. Jika Anda memiliki kondisi medis tertentu, sangat disarankan 
                    untuk berkonsultasi dengan dokter sebelum memulai program diet apa pun.
                </div>
            </div>
        </div>
    `;

    resultsContainer.classList.add('show');
}
</script>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
@endsection