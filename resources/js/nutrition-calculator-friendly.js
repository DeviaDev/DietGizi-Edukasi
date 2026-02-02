/**
 * ==========================================
 * NUTRITION CALCULATOR - USER FRIENDLY VERSION
 * With beautiful visualization and easy to understand results
 * ==========================================
 */

// Global variables
let calculationResults = null;

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeForm();
    setupEventListeners();
});

/**
 * Initialize form
 */
function initializeForm() {
    // Show/hide lingkar betis for elderly
    const ageInput = document.querySelector('input[name="umur"]');
    const lingkarBetisGroup = document.getElementById('lingkarBetisGroup');
    
    if (ageInput && lingkarBetisGroup) {
        ageInput.addEventListener('input', function() {
            const age = parseInt(this.value);
            lingkarBetisGroup.style.display = age >= 60 ? 'block' : 'none';
        });
    }
}

/**
 * Setup event listeners
 */
function setupEventListeners() {
    const form = document.getElementById('nutritionForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
}

/**
 * Handle form submission
 */
async function handleFormSubmit(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('.btn-submit');
    const originalHTML = submitBtn.innerHTML;
    
    // Show loading
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <div class="loading-spinner"></div>
        Menganalisis data Anda...
    `;
    
    try {
        const formData = new FormData(this);
        const data = {};
        
        // Convert form data to object
        formData.forEach((value, key) => {
            if (value) {
                data[key] = value;
            }
        });
        
        // Send to backend
        const response = await fetch('/nutrition/calculate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) {
            throw new Error('Terjadi kesalahan saat memproses data');
        }
        
        const results = await response.json();
        calculationResults = results;
        
        // Display results with smooth animation
        displayResults(results);
        
        // Scroll to results smoothly
        setTimeout(() => {
            document.getElementById('resultsSection').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 300);
        
    } catch (error) {
        console.error('Error:', error);
        showErrorMessage('Terjadi kesalahan saat menganalisis data. Silakan coba lagi.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalHTML;
    }
}

/**
 * Display all results
 */
function displayResults(results) {
    const resultsSection = document.getElementById('resultsSection');
    resultsSection.style.display = 'block';
    
    // Display each section
    displayStatusGiziOverview(results);
    displayIMTResults(results.imt);
    displayNutritionStatus(results.statusGizi);
    displayWeightAnalysis(results);
    displayEstimationResults(results);
    displayMealPlan(results.rencanaMakan);
    displayRecommendations(results.recommendations);
}

/**
 * Display status gizi overview dengan emoji dan warna
 */
function displayStatusGiziOverview(results) {
    const container = document.getElementById('statusGiziOverview');
    const imt = results.imt;
    
    // Tentukan emoji berdasarkan status
    let emoji = '😊';
    let colorClass = 'status-normal';
    
    if (imt.nilai < 17) {
        emoji = '😟';
        colorClass = 'status-danger';
    } else if (imt.nilai < 18.5) {
        emoji = '😐';
        colorClass = 'status-warning';
    } else if (imt.nilai >= 25 && imt.nilai < 27) {
        emoji = '😐';
        colorClass = 'status-warning';
    } else if (imt.nilai >= 27) {
        emoji = '😟';
        colorClass = 'status-danger';
    }
    
    container.innerHTML = `
        <div class="metric-box" style="text-align: center; padding: 2rem;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">${emoji}</div>
            <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: var(--text-dark);">
                Status Gizi Anda: <strong>${imt.status}</strong>
            </h3>
            <div style="margin: 1.5rem 0;">
                <span class="status-badge ${colorClass}" style="font-size: 1.1rem; padding: 0.75rem 1.5rem;">
                    IMT: ${imt.nilai}
                </span>
            </div>
            <p style="font-size: 1.1rem; color: var(--text-muted); max-width: 600px; margin: 1rem auto;">
                ${imt.penjelasan}
            </p>
        </div>
    `;
}

/**
 * Display IMT results dengan visual yang menarik
 */
function displayIMTResults(imt) {
    const container = document.getElementById('imtResults');
    
    // Create IMT visual indicator
    const imtValue = parseFloat(imt.nilai);
    let position = 0;
    
    if (imtValue < 17) position = 10;
    else if (imtValue < 18.5) position = 25;
    else if (imtValue < 25) position = 50;
    else if (imtValue < 27) position = 75;
    else position = 90;
    
    container.innerHTML = `
        <div class="metric-box" style="margin-bottom: 1.5rem;">
            <div class="metric-label">Nilai IMT Anda</div>
            <div class="metric-value" style="color: var(--primary-color); font-size: 3rem;">
                ${imt.nilai}
            </div>
            <div style="margin-top: 1rem; padding: 1rem; background: var(--bg-gray); border-radius: var(--radius-md);">
                <div style="font-weight: 600; margin-bottom: 0.5rem;">Kategori: ${imt.kategori}</div>
                <div style="color: var(--text-muted);">${imt.penjelasan}</div>
            </div>
        </div>
        
        <div style="background: var(--bg-gray); padding: 1.5rem; border-radius: var(--radius-lg);">
            <h4 style="margin: 0 0 1rem 0; font-size: 1rem; color: var(--text-dark);">
                📊 Panduan Kategori IMT (Asia-Pasifik)
            </h4>
            <div style="position: relative; height: 40px; background: linear-gradient(to right, #ef4444, #f59e0b, #10b981, #f59e0b, #ef4444); border-radius: 20px; margin: 1.5rem 0;">
                <div style="position: absolute; left: ${position}%; top: -10px; transform: translateX(-50%);">
                    <div style="width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-bottom: 15px solid var(--primary-dark);"></div>
                    <div style="background: var(--primary-dark); color: white; padding: 0.5rem; border-radius: 5px; white-space: nowrap; margin-top: 5px; font-weight: 600;">
                        Anda di sini
                    </div>
                </div>
            </div>
            <table class="data-table" style="margin-top: 2rem;">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Rentang IMT</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ${imtValue < 17 ? 'style="background: #fee2e2;"' : ''}>
                        <td>Sangat Kurus</td>
                        <td>&lt; 17.0</td>
                        <td><span class="status-badge status-danger">Gizi Buruk</span></td>
                    </tr>
                    <tr ${imtValue >= 17 && imtValue < 18.5 ? 'style="background: #fef3c7;"' : ''}>
                        <td>Kurus</td>
                        <td>17.0 - 18.4</td>
                        <td><span class="status-badge status-warning">Gizi Kurang</span></td>
                    </tr>
                    <tr ${imtValue >= 18.5 && imtValue < 25 ? 'style="background: #d1fae5;"' : ''}>
                        <td><strong>Normal</strong></td>
                        <td><strong>18.5 - 24.9</strong></td>
                        <td><span class="status-badge status-normal">Gizi Baik</span></td>
                    </tr>
                    <tr ${imtValue >= 25 && imtValue < 27 ? 'style="background: #fef3c7;"' : ''}>
                        <td>Gemuk</td>
                        <td>25.0 - 26.9</td>
                        <td><span class="status-badge status-warning">Gizi Lebih</span></td>
                    </tr>
                    <tr ${imtValue >= 27 ? 'style="background: #fee2e2;"' : ''}>
                        <td>Obesitas</td>
                        <td>≥ 27.0</td>
                        <td><span class="status-badge status-danger">Obesitas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;
}

/**
 * Display nutrition status dari berbagai metode
 */
function displayNutritionStatus(statusGizi) {
    const container = document.getElementById('nutritionStatus');
    let html = '';
    
    if (statusGizi.dariLILA) {
        const status = statusGizi.dariLILA;
        html += `
            <div class="metric-box">
                <div class="metric-label">📏 ${status.metode}</div>
                <div class="metric-value">${status.nilai} cm</div>
                <span class="status-badge ${getStatusClass(status.status)}">${status.status}</span>
                <div class="metric-description" style="margin-top: 1rem;">
                    ${status.penjelasan}
                </div>
                <div style="margin-top: 0.75rem; padding: 0.75rem; background: var(--bg-gray); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    <strong>Standar:</strong> ${status.cutoff}
                </div>
            </div>
        `;
    }
    
    if (statusGizi.lansiaLILA) {
        const status = statusGizi.lansiaLILA;
        html += `
            <div class="metric-box">
                <div class="metric-label">👴 LILA Lansia (≥60 tahun)</div>
                <div class="metric-value">${status.nilai} cm</div>
                <span class="status-badge ${getStatusClass(status.status)}">${status.status}</span>
                <div class="metric-description" style="margin-top: 1rem;">
                    ${status.penjelasan}
                </div>
            </div>
        `;
    }
    
    if (statusGizi.lansiaLingkarBetis) {
        const status = statusGizi.lansiaLingkarBetis;
        html += `
            <div class="metric-box">
                <div class="metric-label">🦵 Lingkar Betis Lansia</div>
                <div class="metric-value">${status.nilai} cm</div>
                <span class="status-badge ${getStatusClass(status.status)}">${status.status}</span>
                <div class="metric-description" style="margin-top: 1rem;">
                    ${status.penjelasan}
                </div>
                <div style="margin-top: 0.75rem; padding: 0.75rem; background: var(--bg-gray); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    <strong>Standar:</strong> ${status.cutoff}
                </div>
            </div>
        `;
    }
    
    if (statusGizi.permenkes) {
        const status = statusGizi.permenkes;
        html += `
            <div class="metric-box" style="border-left-color: var(--secondary-color);">
                <div class="metric-label">👶 Status Gizi Anak (Permenkes No 2/2020)</div>
                <div class="metric-value">${status.persenBB}%</div>
                <span class="status-badge ${getStatusClass(status.statusBBU)}">${status.statusBBU}</span>
                <div class="metric-description" style="margin-top: 1rem;">
                    <strong>IMT:</strong> ${status.imt.nilai} (${status.imt.kategori})<br>
                    <strong>Rekomendasi:</strong> ${status.rekomendasi}
                </div>
            </div>
        `;
    }
    
    if (!html) {
        html = `
            <div style="padding: 2rem; text-align: center; color: var(--text-muted);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📊</div>
                <p>Tambahkan data LILA atau pengukuran lainnya untuk analisis status gizi yang lebih detail.</p>
            </div>
        `;
    }
    
    container.innerHTML = html;
}

/**
 * Display weight analysis dengan progress bar
 */
function displayWeightAnalysis(results) {
    const container = document.getElementById('weightAnalysis');
    const bbIdeal = results.bbIdeal;
    const kebutuhanGizi = results.kebutuhanGizi;
    const bmr = results.bmr;
    const tdee = results.tdee;
    
    // Hitung selisih
    const beratAktual = parseFloat(results.data.berat);
    const selisih = beratAktual - parseFloat(bbIdeal.rataRata);
    const persentase = (selisih / bbIdeal.rataRata * 100).toFixed(1);
    
    let statusBerat = '';
    let emoji = '';
    if (Math.abs(selisih) <= 2) {
        statusBerat = 'Berat badan Anda sudah ideal! 🎉';
        emoji = '✅';
    } else if (selisih > 0) {
        statusBerat = `Anda memiliki kelebihan berat badan ${Math.abs(selisih).toFixed(1)} kg`;
        emoji = '⚠️';
    } else {
        statusBerat = `Anda memiliki kekurangan berat badan ${Math.abs(selisih).toFixed(1)} kg`;
        emoji = '⚠️';
    }
    
    container.innerHTML = `
        <!-- Status Berat Badan -->
        <div class="metric-box" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-left: 5px solid var(--primary-color);">
            <div style="text-align: center; padding: 1rem;">
                <div style="font-size: 3rem; margin-bottom: 0.5rem;">${emoji}</div>
                <h4 style="font-size: 1.25rem; margin-bottom: 0.5rem;">${statusBerat}</h4>
                <p style="color: var(--text-muted); margin-bottom: 0;">(${persentase > 0 ? '+' : ''}${persentase}% dari berat ideal)</p>
            </div>
        </div>
        
        <!-- Berat Badan Detail -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 1.5rem;">
            <div class="metric-box">
                <div class="metric-label">Berat Badan Aktual</div>
                <div class="metric-value" style="color: var(--secondary-color);">${beratAktual} kg</div>
                <div class="metric-description">Berat badan saat ini</div>
            </div>
            
            <div class="metric-box">
                <div class="metric-label">Berat Badan Ideal</div>
                <div class="metric-value" style="color: var(--primary-color);">${bbIdeal.rataRata} kg</div>
                <div class="metric-description">Rentang: ${bbIdeal.range.min} - ${bbIdeal.range.max} kg</div>
            </div>
            
            ${results.bbKering ? `
            <div class="metric-box">
                <div class="metric-label">💪 Berat Tanpa Lemak</div>
                <div class="metric-value">${results.bbKering.rataRata} kg</div>
                <div class="metric-description">Massa otot & tulang</div>
            </div>
            ` : ''}
        </div>
        
        <!-- Metode Perhitungan BB Ideal -->
        <div style="margin-top: 1.5rem; padding: 1.5rem; background: var(--bg-gray); border-radius: var(--radius-lg);">
            <h4 style="margin: 0 0 1rem 0; font-size: 1rem;">🔬 Metode Perhitungan Berat Badan Ideal</h4>
            <table class="data-table">
                <tr>
                    <td><strong>Metode Broca</strong></td>
                    <td>${bbIdeal.broca} kg</td>
                    <td><small class="text-muted">Metode standar Indonesia</small></td>
                </tr>
                <tr>
                    <td><strong>Metode Devine</strong></td>
                    <td>${bbIdeal.devine} kg</td>
                    <td><small class="text-muted">Standar internasional</small></td>
                </tr>
                <tr>
                    <td><strong>Metode Hamwi</strong></td>
                    <td>${bbIdeal.hamwi} kg</td>
                    <td><small class="text-muted">Standar medis</small></td>
                </tr>
                <tr style="background: var(--primary-light); font-weight: 600;">
                    <td><strong>Rata-rata (Rekomendasi)</strong></td>
                    <td><strong>${bbIdeal.rataRata} kg</strong></td>
                    <td><small>Nilai yang digunakan</small></td>
                </tr>
            </table>
        </div>
        
        <!-- Kebutuhan Energi -->
        <div style="margin-top: 1.5rem;">
            <h4 style="margin: 0 0 1rem 0; font-size: 1.25rem; color: var(--primary-dark);">
                ⚡ Kebutuhan Energi Harian Anda
            </h4>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div class="metric-box" style="text-align: center;">
                    <div class="metric-label">BMR</div>
                    <div class="metric-value" style="font-size: 2rem;">${bmr}</div>
                    <div class="metric-description">kkal/hari<br><small>Kalori dasar tubuh</small></div>
                </div>
                
                <div class="metric-box" style="text-align: center; background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                    <div class="metric-label">TDEE</div>
                    <div class="metric-value" style="font-size: 2rem; color: var(--secondary-color);">${tdee}</div>
                    <div class="metric-description">kkal/hari<br><small>Total kebutuhan harian</small></div>
                </div>
            </div>
        </div>
        
        <!-- Kebutuhan Makronutrien -->
        <div style="margin-top: 1.5rem; padding: 1.5rem; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: var(--radius-lg);">
            <h4 style="margin: 0 0 1.5rem 0; font-size: 1.1rem; color: var(--text-dark);">
                🍽️ Kebutuhan Makronutrien Per Hari
            </h4>
            
            <div class="nutrition-grid">
                <div class="nutrition-item" style="background: white;">
                    <strong>KARBOHIDRAT</strong>
                    <span style="color: #ea580c;">${kebutuhanGizi.karbohidrat.gram}g</span>
                    <div class="subtext">
                        ${Math.round(kebutuhanGizi.karbohidrat.persentase)}% kalori<br>
                        ${kebutuhanGizi.karbohidrat.kalori} kkal
                    </div>
                </div>
                
                <div class="nutrition-item" style="background: white;">
                    <strong>PROTEIN</strong>
                    <span style="color: #dc2626;">${kebutuhanGizi.protein.gram}g</span>
                    <div class="subtext">
                        ${Math.round(kebutuhanGizi.protein.persentase)}% kalori<br>
                        ${kebutuhanGizi.protein.kalori} kkal
                    </div>
                </div>
                
                <div class="nutrition-item" style="background: white;">
                    <strong>LEMAK</strong>
                    <span style="color: #ca8a04;">${kebutuhanGizi.lemak.gram}g</span>
                    <div class="subtext">
                        ${Math.round(kebutuhanGizi.lemak.persentase)}% kalori<br>
                        ${kebutuhanGizi.lemak.kalori} kkal
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 1rem; padding: 1rem; background: white; border-radius: var(--radius-md); font-size: 0.875rem;">
                <strong>💡 Catatan:</strong> Angka ini adalah kebutuhan untuk <strong>mempertahankan</strong> berat badan. 
                Untuk menurunkan berat: kurangi 500 kkal/hari. Untuk menaikkan berat: tambah 500 kkal/hari.
            </div>
        </div>
    `;
}

/**
 * Display estimation results
 */
function displayEstimationResults(results) {
    const container = document.getElementById('estimationContent');
    const estimationDiv = document.getElementById('estimationResults');
    let hasEstimation = false;
    let html = '';
    
    if (results.estimasiBBLILA) {
        hasEstimation = true;
        const est = results.estimasiBBLILA;
        html += `
            <div class="metric-box">
                <div class="metric-label">📏 Estimasi Berat Badan dari LILA</div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin: 1rem 0;">
                    <div style="text-align: center; padding: 1rem; background: var(--bg-gray); border-radius: var(--radius-md);">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Metode Jung</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">${est.estimasi.jung} kg</div>
                    </div>
                    <div style="text-align: center; padding: 1rem; background: var(--bg-gray); border-radius: var(--radius-md);">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Metode Powell</div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color);">${est.estimasi.powell} kg</div>
                    </div>
                    <div style="text-align: center; padding: 1rem; background: var(--primary-light); border-radius: var(--radius-md);">
                        <div style="font-size: 0.875rem; color: var(--primary-dark); margin-bottom: 0.5rem;"><strong>Rata-rata</strong></div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-dark);">${est.estimasi.rataRata} kg</div>
                    </div>
                </div>
                <div class="metric-description">${est.penjelasan}</div>
                <div style="margin-top: 0.75rem; padding: 0.75rem; background: #dbeafe; border-radius: var(--radius-sm); font-size: 0.875rem;">
                    <strong>ℹ️ Akurasi:</strong> ${est.akurasi}
                </div>
            </div>
        `;
    }
    
    if (results.estimasiBBUlna) {
        hasEstimation = true;
        const est = results.estimasiBBUlna;
        const isAccurate = Math.abs(parseFloat(est.selisih)) <= 5;
        
        html += `
            <div class="metric-box">
                <div class="metric-label">📐 Estimasi Tinggi Badan dari Panjang ULNA</div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin: 1rem 0;">
                    <div style="text-align: center;">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Estimasi</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: var(--primary-color);">${est.tinggiEstimasi} cm</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Aktual</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-dark);">${est.tinggiAktual} cm</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Selisih</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: ${isAccurate ? 'var(--success-color)' : 'var(--warning-color)'};">
                            ${Math.abs(parseFloat(est.selisih))} cm
                        </div>
                    </div>
                </div>
                <div class="metric-description">${est.penjelasan}</div>
                <div style="margin-top: 0.75rem; padding: 0.75rem; background: ${isAccurate ? '#d1fae5' : '#fef3c7'}; border-radius: var(--radius-sm); font-size: 0.875rem;">
                    <strong>${isAccurate ? '✅' : '⚠️'} ${est.akurasi}</strong>
                </div>
            </div>
        `;
    }
    
    if (results.estimasiTBLutut) {
        hasEstimation = true;
        const est = results.estimasiTBLutut;
        const isAccurate = Math.abs(parseFloat(est.selisih)) <= 5;
        
        html += `
            <div class="metric-box">
                <div class="metric-label">🦵 Estimasi Tinggi Badan dari Tinggi Lutut</div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin: 1rem 0;">
                    <div style="text-align: center;">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Estimasi</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: var(--primary-color);">${est.estimasi} cm</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Aktual</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: var(--text-dark);">${est.tinggiAktual} cm</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Selisih</div>
                        <div style="font-size: 1.75rem; font-weight: 700; color: ${isAccurate ? 'var(--success-color)' : 'var(--warning-color)'};">
                            ${Math.abs(parseFloat(est.selisih))} cm
                        </div>
                    </div>
                </div>
                <div style="margin-top: 0.75rem; padding: 0.75rem; background: var(--bg-gray); border-radius: var(--radius-sm); font-size: 0.875rem;">
                    <strong>Metode:</strong> ${est.metode}
                </div>
                <div class="metric-description">${est.penjelasan}</div>
            </div>
        `;
    }
    
    if (hasEstimation) {
        estimationDiv.style.display = 'block';
        container.innerHTML = html;
    } else {
        estimationDiv.style.display = 'none';
    }
}

/**
 * Display meal plan yang user-friendly
 */
function displayMealPlan(rencanaMakan) {
    if (!rencanaMakan) return;
    
    const container = document.getElementById('recommendationsContent');
    
    const mealIcons = {
        'sarapan': '🌅',
        'snackPagi': '☕',
        'makanSiang': '🌞',
        'snackSore': '🍪',
        'makanMalam': '🌙'
    };
    
    const mealTitles = {
        'sarapan': 'Sarapan (Pagi)',
        'snackPagi': 'Snack Pagi',
        'makanSiang': 'Makan Siang',
        'snackSore': 'Snack Sore',
        'makanMalam': 'Makan Malam'
    };
    
    let html = `
        <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 2rem;">
            <h3 style="margin: 0 0 1rem 0; font-size: 1.5rem; color: var(--text-dark);">
                🍽️ Rencana Makan Harian Anda
            </h3>
            <p style="margin: 0; color: var(--text-dark); font-size: 1.1rem;">
                Berikut adalah contoh menu sehari yang telah disesuaikan dengan kebutuhan gizi Anda
            </p>
        </div>
    `;
    
    for (const [waktu, data] of Object.entries(rencanaMakan)) {
        html += `
            <div class="meal-section">
                <div class="meal-header">
                    <span class="meal-icon">${mealIcons[waktu]}</span>
                    <div>
                        <div class="meal-title">${mealTitles[waktu]}</div>
                    </div>
                </div>
                
                <div class="meal-target">
                    <strong>🎯 Target Nutrisi:</strong> 
                    <span style="background: white; padding: 0.25rem 0.5rem; border-radius: 4px; margin: 0 0.25rem;">
                        ${data.kalori} kkal
                    </span>
                    <span style="background: white; padding: 0.25rem 0.5rem; border-radius: 4px; margin: 0 0.25rem;">
                        Karbo: ${data.karbohidrat}g
                    </span>
                    <span style="background: white; padding: 0.25rem 0.5rem; border-radius: 4px; margin: 0 0.25rem;">
                        Protein: ${data.protein}g
                    </span>
                    <span style="background: white; padding: 0.25rem 0.5rem; border-radius: 4px; margin: 0 0.25rem;">
                        Lemak: ${data.lemak}g
                    </span>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th width="20%">Golongan</th>
                            <th width="30%">Bahan Makanan</th>
                            <th width="25%">Porsi (URT)</th>
                            <th width="25%">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        data.menu.forEach(item => {
            const totalPortion = item.jumlah > 1 ? ` × ${item.jumlah}` : '';
            html += `
                <tr>
                    <td><strong>${item.golongan}</strong></td>
                    <td>${item.bahan}</td>
                    <td>${item.porsi}${totalPortion}</td>
                    <td><small class="text-muted">${item.catatan}</small></td>
                </tr>
            `;
        });
        
        html += `
                    </tbody>
                </table>
            </div>
        `;
    }
    
    container.innerHTML = html;
}

/**
 * Display recommendations
 */
function displayRecommendations(recommendations) {
    if (!recommendations || recommendations.length === 0) return;
    
    const container = document.getElementById('recommendationsContent');
    let html = container.innerHTML || ''; // Keep meal plan if exists
    
    // Add recommendations sections
    recommendations.forEach(rec => {
        html += `
            <div class="recommendation-section" style="margin-top: 2rem;">
                <div class="recommendation-category">
                    <h4>${rec.kategori}</h4>
        `;
        
        if (rec.kondisi) {
            html += `
                <div style="background: white; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1rem;">
                    <strong>Kondisi:</strong> ${rec.kondisi}
                </div>
            `;
        }
        
        if (rec.saran && rec.saran.length > 0) {
            html += '<ul class="recommendation-list">';
            rec.saran.forEach(saran => {
                html += `<li>${saran}</li>`;
            });
            html += '</ul>';
        }
        
        if (rec.detail) {
            html += '<div class="nutrition-grid" style="margin-top: 1rem;">';
            Object.entries(rec.detail).forEach(([key, value]) => {
                html += `
                    <div class="nutrition-item">
                        <strong>${key}</strong>
                        <span>${value}</span>
                    </div>
                `;
            });
            html += '</div>';
        }
        
        if (rec.sumber) {
            html += `
                <div style="margin-top: 1rem; padding: 1rem; background: white; border-radius: var(--radius-md);">
                    <h5 style="font-size: 1rem; margin-bottom: 0.75rem; color: var(--text-dark);">
                        🥗 Sumber Makanan Yang Direkomendasikan:
                    </h5>
                    <ul style="margin: 0; padding-left: 1.25rem;">
            `;
            
            Object.entries(rec.sumber).forEach(([key, value]) => {
                html += `<li style="margin-bottom: 0.5rem;"><strong>${key}:</strong> ${value}</li>`;
            });
            
            html += `
                    </ul>
                </div>
            `;
        }
        
        html += `
                </div>
            </div>
        `;
    });
    
    // Add final tips
    html += `
        <div class="tips-box" style="margin-top: 2rem;">
            <h3 style="margin-top: 0; color: #1e40af;">💡 Catatan Penting</h3>
            <div style="background: white; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1rem;">
                <strong>ℹ️ Tentang Menu Di Atas:</strong>
                <p style="margin: 0.5rem 0 0 0;">
                    Menu yang tertera adalah <strong>contoh rekomendasi</strong>. Anda dapat mengganti dengan bahan penukar 
                    lain dalam golongan yang sama sesuai selera dan ketersediaan bahan. Misalnya:
                </p>
                <ul style="margin: 0.5rem 0 0 1.25rem; padding: 0;">
                    <li>Nasi bisa diganti: Kentang, Ubi, Roti, Mie, Jagung, Oatmeal</li>
                    <li>Ayam bisa diganti: Ikan, Daging sapi, Telur, Udang</li>
                    <li>Tempe bisa diganti: Tahu, Kacang hijau, Kacang merah</li>
                </ul>
            </div>
            
            <div style="background: #fee2e2; padding: 1rem; border-radius: var(--radius-md); border-left: 4px solid #dc2626;">
                <strong>⚠️ Penting:</strong>
                <p style="margin: 0.5rem 0 0 0;">
                    Hasil analisis ini adalah panduan umum berdasarkan data yang Anda masukkan. 
                    Untuk program diet khusus atau kondisi medis tertentu, <strong>sangat disarankan untuk berkonsultasi 
                    dengan dokter atau ahli gizi profesional</strong>.
                </p>
            </div>
        </div>
        
        <div style="margin-top: 2rem; padding: 1.5rem; background: var(--bg-gray); border-radius: var(--radius-lg); text-align: center;">
            <p style="margin: 0; color: var(--text-muted);">
                <strong>Sumber Data:</strong> Rumah Sakit Universitas Gadjah Mada & Standar Gizi Kemenkes RI
            </p>
        </div>
    `;
    
    container.innerHTML = html;
}

/**
 * Helper: Get status class
 */
function getStatusClass(status) {
    const statusLower = status.toLowerCase();
    
    if (statusLower.includes('normal') || statusLower.includes('baik')) {
        return 'status-normal';
    }
    
    if (statusLower.includes('kurang') || statusLower.includes('buruk') || 
        statusLower.includes('kurus') || statusLower.includes('risiko') ||
        statusLower.includes('kek') || statusLower.includes('malnutrisi') ||
        statusLower.includes('sarcopenia')) {
        return 'status-danger';
    }
    
    if (statusLower.includes('lebih') || statusLower.includes('obesitas') ||
        statusLower.includes('gemuk')) {
        return 'status-warning';
    }
    
    return 'status-normal';
}

/**
 * Show error message
 */
function showErrorMessage(message) {
    alert(message);
}

/**
 * Reset form
 */
function resetForm() {
    document.getElementById('nutritionForm').reset();
    document.getElementById('resultsSection').style.display = 'none';
    document.getElementById('lingkarBetisGroup').style.display = 'none';
    
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

/**
 * Education modal functions
 */
function showEducation(topic) {
    const modal = document.getElementById('educationModal');
    const content = document.getElementById('educationContent');
    
    const educationContent = {
        imt: {
            title: 'Indeks Massa Tubuh (IMT)',
            emoji: '📊',
            sections: [
                {
                    title: 'Apa itu IMT?',
                    content: 'Indeks Massa Tubuh (IMT) atau Body Mass Index (BMI) adalah ukuran yang digunakan untuk menilai apakah berat badan seseorang sehat berdasarkan tinggi badannya. IMT dihitung dengan membagi berat badan (kg) dengan kuadrat tinggi badan (m²).'
                },
                {
                    title: 'Cara Menghitung',
                    content: '<strong>Rumus:</strong> IMT = Berat Badan (kg) ÷ [Tinggi Badan (m)]²<br><br><strong>Contoh:</strong> Seseorang dengan tinggi 170 cm (1.7 m) dan berat 70 kg:<br>IMT = 70 ÷ (1.7 × 1.7) = 70 ÷ 2.89 = 24.2'
                },
                {
                    title: 'Kategori IMT (Asia-Pasifik)',
                    content: `
                        <ul>
                            <li><strong>Sangat Kurus:</strong> < 17.0 (Gizi Buruk)</li>
                            <li><strong>Kurus:</strong> 17.0 - 18.4 (Gizi Kurang)</li>
                            <li><strong>Normal:</strong> 18.5 - 24.9 (Gizi Baik)</li>
                            <li><strong>Gemuk:</strong> 25.0 - 26.9 (Gizi Lebih)</li>
                            <li><strong>Obesitas:</strong> ≥ 27.0 (Obesitas)</li>
                        </ul>
                    `
                },
                {
                    title: 'Mengapa IMT Penting?',
                    content: 'IMT membantu mengidentifikasi risiko kesehatan terkait berat badan seperti diabetes, hipertensi, penyakit jantung, stroke, dan masalah kesehatan lainnya. Menjaga IMT dalam rentang normal sangat penting untuk kesehatan jangka panjang.'
                }
            ]
        },
        lila: {
            title: 'Lingkar Lengan Atas (LILA)',
            emoji: '📏',
            sections: [
                {
                    title: 'Apa itu LILA?',
                    content: 'LILA adalah pengukuran lingkar lengan atas bagian tengah yang digunakan untuk mendeteksi malnutrisi dan Kurang Energi Kronis (KEK). Metode ini sangat praktis karena tidak memerlukan peralatan canggih.'
                },
                {
                    title: 'Cara Mengukur LILA',
                    content: `
                        <ol>
                            <li>Posisikan lengan kiri rileks di samping tubuh</li>
                            <li>Tentukan titik tengah antara ujung bahu (acromion) dan ujung siku (olecranon)</li>
                            <li>Tandai titik tengah tersebut</li>
                            <li>Lingkarkan pita pengukur pada titik tengah</li>
                            <li>Pastikan pita tidak terlalu ketat atau longgar</li>
                            <li>Baca angka yang tertera dalam cm</li>
                        </ol>
                    `
                },
                {
                    title: 'Standar LILA',
                    content: `
                        <ul>
                            <li><strong>Wanita dewasa:</strong> < 23.5 cm = Kurang Energi Kronis (KEK)</li>
                            <li><strong>Pria dewasa:</strong> < 23.0 cm = Risiko Malnutrisi</li>
                            <li><strong>Ibu hamil:</strong> < 23.5 cm = Risiko KEK tinggi</li>
                            <li><strong>Lansia (≥60 tahun):</strong> < 22 cm = Malnutrisi, < 24 cm = Risiko</li>
                        </ul>
                    `
                },
                {
                    title: 'Kegunaan LILA',
                    content: 'LILA sangat berguna untuk screening cepat malnutrisi, terutama pada ibu hamil, balita, dan lansia. Metode ini juga digunakan ketika pengukuran berat badan sulit dilakukan, misalnya pada pasien yang tidak bisa berdiri atau ditimbang.'
                }
            ]
        },
        ulna: {
            title: 'Panjang Tulang ULNA',
            emoji: '📐',
            sections: [
                {
                    title: 'Apa itu Pengukuran ULNA?',
                    content: 'ULNA adalah tulang lengan bawah yang terletak di sisi kelingking. Panjang ulna memiliki korelasi tinggi dengan tinggi badan seseorang, sehingga dapat digunakan untuk mengestimasi tinggi badan.'
                },
                {
                    title: 'Cara Mengukur ULNA',
                    content: `
                        <ol>
                            <li>Posisikan pasien duduk atau berdiri dengan nyaman</li>
                            <li>Tekuk siku hingga membentuk sudut 90 derajat di depan dada</li>
                            <li>Telapak tangan menghadap ke dada</li>
                            <li>Ukur dari ujung siku (olecranon process) hingga tulang pergelangan tangan (styloid process of ulna)</li>
                            <li>Gunakan pita ukur atau kaliper khusus</li>
                            <li>Baca hasilnya dalam cm</li>
                        </ol>
                    `
                },
                {
                    title: 'Rumus Estimasi Tinggi Badan',
                    content: `
                        <strong>Untuk Pria (< 65 tahun):</strong><br>
                        Tinggi = (4.605 × Ulna) + (1.308 × Umur) + 28.003<br><br>
                        <strong>Untuk Wanita (< 65 tahun):</strong><br>
                        Tinggi = (4.459 × Ulna) + (1.315 × Umur) + 31.485<br><br>
                        <em>* Rumus berbeda untuk lansia ≥65 tahun</em>
                    `
                },
                {
                    title: 'Kegunaan Pengukuran ULNA',
                    content: `
                        Estimasi tinggi badan dari ULNA sangat berguna untuk:
                        <ul>
                            <li>Pasien yang tidak bisa berdiri (bed-ridden)</li>
                            <li>Lansia dengan kelainan tulang belakang (kyphosis, scoliosis)</li>
                            <li>Pasien dengan amputasi tungkai</li>
                            <li>Verifikasi pengukuran tinggi badan konvensional</li>
                            <li>Pasien ICU atau kritis</li>
                        </ul>
                    `
                }
            ]
        },
        antropometri: {
            title: 'Pengukuran Antropometri',
            emoji: '🔬',
            sections: [
                {
                    title: 'Apa itu Antropometri?',
                    content: 'Antropometri adalah teknik pengukuran dimensi dan komposisi tubuh manusia untuk menilai status gizi dan kesehatan. Ini adalah metode non-invasif yang sangat berguna dalam penilaian gizi.'
                },
                {
                    title: 'Jenis Pengukuran Antropometri',
                    content: `
                        <ul>
                            <li><strong>Berat Badan:</strong> Massa tubuh total, indikator utama status gizi</li>
                            <li><strong>Tinggi Badan:</strong> Panjang tubuh, untuk perhitungan IMT dan pertumbuhan</li>
                            <li><strong>LILA:</strong> Lingkar lengan atas, deteksi malnutrisi cepat</li>
                            <li><strong>Lingkar Perut:</strong> Indikator obesitas sentral dan risiko metabolik</li>
                            <li><strong>Lingkar Betis:</strong> Massa otot tungkai, penting untuk lansia</li>
                            <li><strong>Tinggi Lutut:</strong> Estimasi tinggi badan alternatif</li>
                            <li><strong>Panjang ULNA:</strong> Estimasi tinggi badan dari tulang lengan</li>
                            <li><strong>Tebal Lipatan Kulit:</strong> Komposisi lemak tubuh</li>
                        </ul>
                    `
                },
                {
                    title: 'Pentingnya Antropometri',
                    content: `
                        Pengukuran antropometri membantu:
                        <ul>
                            <li>Menilai status gizi secara objektif dan terukur</li>
                            <li>Memantau pertumbuhan dan perkembangan anak</li>
                            <li>Mengidentifikasi risiko penyakit terkait gizi</li>
                            <li>Merencanakan intervensi gizi yang tepat</li>
                            <li>Mengevaluasi efektivitas program gizi</li>
                            <li>Menghitung kebutuhan nutrisi individual</li>
                        </ul>
                    `
                },
                {
                    title: 'Keunggulan Metode Antropometri',
                    content: `
                        <ul>
                            <li>Non-invasif dan tidak menyakitkan</li>
                            <li>Relatif murah dan mudah dilakukan</li>
                            <li>Dapat dilakukan di berbagai setting (klinik, lapangan, rumah)</li>
                            <li>Memberikan informasi objektif tentang status gizi</li>
                            <li>Dapat digunakan untuk monitoring jangka panjang</li>
                        </ul>
                    `
                }
            ]
        }
    };
    
    const data = educationContent[topic];
    if (!data) return;
    
    let html = `
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">${data.emoji}</div>
            <h3 style="font-size: 1.75rem; color: var(--primary-dark); margin: 0;">${data.title}</h3>
        </div>
    `;
    
    data.sections.forEach(section => {
        html += `
            <div style="margin-bottom: 2rem;">
                <h4 style="font-size: 1.25rem; color: var(--primary-color); margin-bottom: 0.75rem;">
                    ${section.title}
                </h4>
                <div style="line-height: 1.7; color: var(--text-dark);">
                    ${section.content}
                </div>
            </div>
        `;
    });
    
    content.innerHTML = html;
    modal.classList.add('show');
}

function closeEducation() {
    const modal = document.getElementById('educationModal');
    modal.classList.remove('show');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('educationModal');
    if (event.target === modal) {
        closeEducation();
    }
}
