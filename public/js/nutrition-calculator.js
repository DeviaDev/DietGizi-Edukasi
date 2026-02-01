// ===================================
// NUTRITION CALCULATOR JAVASCRIPT
// ===================================

// Educational content data
const educationalContent = {
    imt: {
        judul: 'Apa itu IMT (Indeks Massa Tubuh)?',
        definisi: 'IMT adalah ukuran yang digunakan untuk menilai status gizi seseorang berdasarkan perbandingan berat badan dan tinggi badan. IMT dihitung dengan membagi berat badan (dalam kilogram) dengan kuadrat tinggi badan (dalam meter).',
        rumus: 'IMT = Berat Badan (kg) / (Tinggi Badan (m))²',
        kegunaan: 'IMT digunakan untuk mengidentifikasi kelebihan atau kekurangan berat badan yang dapat meningkatkan risiko masalah kesehatan seperti diabetes, penyakit jantung, dan tekanan darah tinggi.',
        kategori: [
            '< 17.0: Sangat Kurus',
            '17.0 - 18.4: Kurus',
            '18.5 - 24.9: Normal',
            '25.0 - 29.9: Kelebihan Berat Badan',
            '30.0 - 34.9: Obesitas Kelas I',
            '35.0 - 39.9: Obesitas Kelas II',
            '≥ 40.0: Obesitas Kelas III'
        ],
        keterbatasan: 'IMT tidak membedakan antara massa otot dan lemak. Atlet dengan massa otot tinggi mungkin memiliki IMT tinggi meskipun tidak memiliki kelebihan lemak tubuh. IMT juga tidak mempertimbangkan distribusi lemak tubuh.'
    },
    lila: {
        judul: 'Apa itu LILA (Lingkar Lengan Atas)?',
        definisi: 'LILA adalah pengukuran lingkar lengan atas bagian tengah yang digunakan untuk menilai status gizi, terutama untuk deteksi malnutrisi. Pengukuran ini sangat berguna karena sederhana, cepat, dan tidak memerlukan peralatan khusus.',
        cara_ukur: 'LILA diukur pada titik tengah antara ujung bahu (akromion) dan siku (olekranon) menggunakan pita ukur. Lengan harus dalam posisi rileks dan menggantung bebas di samping tubuh.',
        kegunaan: 'LILA digunakan untuk screening cepat malnutrisi, khususnya pada ibu hamil, balita, dan lansia. Metode ini sangat berguna ketika pengukuran tinggi atau berat badan sulit dilakukan, misalnya pada pasien yang tidak bisa berdiri.',
        cut_off: [
            'Dewasa Pria: < 23 cm = Kurang Energi Kronis (KEK)',
            'Dewasa Wanita: < 22 cm = Kurang Energi Kronis (KEK)',
            'Ibu Hamil: < 23.5 cm = Risiko KEK',
            'Balita: < 11.5 cm = Gizi Buruk, < 12.5 cm = Gizi Kurang',
            'Lansia: < 24-25 cm = Risiko Malnutrisi'
        ],
        keunggulan: 'Mudah, cepat, tidak invasif, dapat dilakukan di lapangan, dan tidak memerlukan kalibrasi alat khusus.'
    },
    ulna: {
        judul: 'Apa itu Panjang ULNA?',
        definisi: 'Ulna adalah tulang lengan bawah yang terletak di sisi kelingking. Panjang ulna memiliki korelasi tinggi dengan tinggi badan seseorang dan dapat digunakan untuk memperkirakan tinggi badan.',
        cara_ukur: 'Panjang ulna diukur dari ujung siku (olekranon process) hingga ujung tulang pergelangan tangan (styloid process) dengan lengan membentuk sudut 90 derajat di depan dada dan telapak tangan menghadap ke dada.',
        kegunaan: 'Pengukuran ulna digunakan untuk mengestimasi tinggi badan pada pasien yang tidak bisa berdiri atau memiliki kelainan tulang belakang seperti kyphosis, scoliosis, atau amputasi tungkai. Ini sangat penting untuk perhitungan kebutuhan nutrisi dan dosis obat.',
        rumus: [
            'Pria: Tinggi (cm) = (4.605 × Ulna) + (1.308 × Umur) + 28.003',
            'Wanita: Tinggi (cm) = (4.459 × Ulna) + (1.315 × Umur) + 31.485'
        ],
        akurasi: 'Estimasi tinggi badan dari panjang ulna memiliki korelasi tinggi dengan tinggi badan sebenarnya, dengan margin error sekitar ±3-5 cm. Metode ini telah divalidasi dalam berbagai populasi.',
        aplikasi: 'Digunakan pada pasien bedridden, pasien ICU, pasien dengan kelainan tulang belakang, dan situasi di mana pengukuran tinggi badan konvensional tidak memungkinkan.'
    },
    antropometri: {
        judul: 'Pengukuran Antropometri',
        definisi: 'Antropometri adalah ilmu yang mempelajari pengukuran dimensi tubuh dan komposisi tubuh manusia. Ini merupakan metode non-invasif untuk menilai ukuran, proporsi, dan komposisi tubuh.',
        jenis_pengukuran: [
            {
                nama: 'Tinggi Badan',
                deskripsi: 'Mengukur panjang tubuh dari ujung kepala hingga telapak kaki. Digunakan untuk perhitungan IMT dan menilai pertumbuhan.'
            },
            {
                nama: 'Berat Badan',
                deskripsi: 'Mengukur massa tubuh total. Indikator penting untuk status gizi dan dosis obat.'
            },
            {
                nama: 'LILA (Lingkar Lengan Atas)',
                deskripsi: 'Indikator status gizi dan massa otot lengan. Screening cepat malnutrisi.'
            },
            {
                nama: 'Lingkar Betis',
                deskripsi: 'Indikator massa otot tungkai, terutama penting pada lansia untuk deteksi sarcopenia.'
            },
            {
                nama: 'Tinggi Lutut',
                deskripsi: 'Digunakan untuk estimasi tinggi badan pada pasien yang tidak bisa berdiri.'
            },
            {
                nama: 'Tebal Lipatan Kulit',
                deskripsi: 'Mengukur lemak subkutan di berbagai lokasi untuk menilai komposisi tubuh.'
            },
            {
                nama: 'Lingkar Pinggang',
                deskripsi: 'Indikator obesitas sentral dan risiko penyakit metabolik.'
            }
        ],
        kegunaan: 'Antropometri digunakan untuk menilai status gizi, pertumbuhan anak, komposisi tubuh, risiko penyakit terkait gizi, efektivitas intervensi nutrisi, dan perencanaan program kesehatan masyarakat.',
        keunggulan: 'Non-invasif, relatif murah, mudah dilakukan, dapat dilakukan di berbagai setting, dan memberikan informasi objektif tentang status gizi.',
        aplikasi_klinis: 'Digunakan dalam screening gizi, monitoring pertumbuhan anak, penilaian risiko penyakit, perencanaan diet, perhitungan kebutuhan nutrisi, dan evaluasi program intervensi.'
    }
};

// Show age-specific fields
document.addEventListener('DOMContentLoaded', function() {
    const umurInput = document.querySelector('input[name="umur"]');
    const lingkarBetisGroup = document.getElementById('lingkarBetisGroup');

    umurInput.addEventListener('input', function() {
        const umur = parseInt(this.value);
        if (umur >= 60) {
            lingkarBetisGroup.style.display = 'block';
        } else {
            lingkarBetisGroup.style.display = 'none';
        }
    });
});

// Form submission
document.getElementById('nutritionForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = this.querySelector('.btn-submit');
    const originalHTML = submitBtn.innerHTML;

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <div class="loading-spinner"></div>
        Menganalisis...
    `;

    try {
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Convert numeric fields
        ['tinggi', 'berat', 'umur', 'lila', 'ulna', 'lingkarBetis', 'tinggiLutut'].forEach(field => {
            if (data[field]) {
                data[field] = parseFloat(data[field]);
            }
        });

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
            throw new Error('Network response was not ok');
        }

        const results = await response.json();
        displayResults(results);

        // Scroll to results
        document.getElementById('resultsSection').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menganalisis data. Silakan coba lagi.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalHTML;
    }
});

// Display results function
function displayResults(results) {
    const resultsSection = document.getElementById('resultsSection');
    resultsSection.style.display = 'block';

    // Status Gizi Overview
    displayStatusGiziOverview(results);

    // IMT Results
    displayIMTResults(results.imt);

    // Nutrition Status
    displayNutritionStatus(results.statusGizi);

    // Weight Analysis
    displayWeightAnalysis(results);

    // Estimation Results
    displayEstimationResults(results);

    // Recommendations
    displayRecommendations(results.recommendations);
}

function displayStatusGiziOverview(results) {
    const container = document.getElementById('statusGiziOverview');
    const imt = results.imt;
    
    let statusClass = 'status-normal';
    if (imt.nilai < 18.5 || imt.nilai >= 25) {
        statusClass = 'status-warning';
    }
    if (imt.nilai < 17 || imt.nilai >= 30) {
        statusClass = 'status-danger';
    }

    container.innerHTML = `
        <div class="metric-box">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <div class="metric-label">Status Gizi Berdasarkan IMT</div>
                    <div class="metric-value">${imt.nilai}</div>
                    <span class="status-badge ${statusClass}">${imt.kategori}</span>
                </div>
                <div style="text-align: right;">
                    <p class="metric-description">${imt.penjelasan}</p>
                </div>
            </div>
        </div>
    `;
}

function displayIMTResults(imt) {
    const container = document.getElementById('imtResults');
    
    container.innerHTML = `
        <div class="metric-box">
            <div class="metric-label">Nilai IMT</div>
            <div class="metric-value">${imt.nilai}</div>
            <div class="metric-description">
                <strong>Kategori:</strong> ${imt.kategori}<br>
                <strong>Interpretasi:</strong> ${imt.penjelasan}
            </div>
        </div>

        <div style="margin-top: 1rem; padding: 1rem; background: var(--bg-gray); border-radius: var(--radius-md);">
            <h4 style="margin: 0 0 0.75rem 0; font-size: 0.9375rem; color: var(--text-dark);">Klasifikasi IMT WHO</h4>
            <table class="data-table" style="font-size: 0.875rem;">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Nilai IMT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sangat Kurus</td>
                        <td>&lt; 17.0</td>
                    </tr>
                    <tr>
                        <td>Kurus</td>
                        <td>17.0 - 18.4</td>
                    </tr>
                    <tr style="background: #d1fae5;">
                        <td><strong>Normal</strong></td>
                        <td><strong>18.5 - 24.9</strong></td>
                    </tr>
                    <tr>
                        <td>Kelebihan BB</td>
                        <td>25.0 - 29.9</td>
                    </tr>
                    <tr>
                        <td>Obesitas I</td>
                        <td>30.0 - 34.9</td>
                    </tr>
                    <tr>
                        <td>Obesitas II</td>
                        <td>35.0 - 39.9</td>
                    </tr>
                    <tr>
                        <td>Obesitas III</td>
                        <td>≥ 40.0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;
}

function displayNutritionStatus(statusGizi) {
    const container = document.getElementById('nutritionStatus');
    let html = '';

    if (statusGizi.dariLILA) {
        html += `
            <div class="metric-box">
                <div class="metric-label">📏 ${statusGizi.dariLILA.metode}</div>
                <div class="metric-value">${statusGizi.dariLILA.nilai} cm</div>
                <span class="status-badge ${getStatusClass(statusGizi.dariLILA.status)}">${statusGizi.dariLILA.status}</span>
                <div class="metric-description" style="margin-top: 0.5rem;">${statusGizi.dariLILA.penjelasan}</div>
            </div>
        `;
    }

    if (statusGizi.lansiaLILA) {
        html += `
            <div class="metric-box">
                <div class="metric-label">👴 LILA Lansia</div>
                <div class="metric-value">${statusGizi.lansiaLILA.nilai} cm</div>
                <span class="status-badge ${getStatusClass(statusGizi.lansiaLILA.status)}">${statusGizi.lansiaLILA.status}</span>
                <div class="metric-description" style="margin-top: 0.5rem;">${statusGizi.lansiaLILA.penjelasan}</div>
            </div>
        `;
    }

    if (statusGizi.lansiaLingkarBetis) {
        html += `
            <div class="metric-box">
                <div class="metric-label">🦵 Lingkar Betis Lansia</div>
                <div class="metric-value">${statusGizi.lansiaLingkarBetis.nilai} cm</div>
                <span class="status-badge ${getStatusClass(statusGizi.lansiaLingkarBetis.status)}">${statusGizi.lansiaLingkarBetis.status}</span>
                <div class="metric-description" style="margin-top: 0.5rem;">${statusGizi.lansiaLingkarBetis.penjelasan}</div>
            </div>
        `;
    }

    if (statusGizi.permenkes) {
        html += `
            <div class="metric-box" style="border-left-color: var(--secondary-color);">
                <div class="metric-label">👶 Status Gizi Anak (Permenkes No 2/2020)</div>
                <div class="metric-value">${statusGizi.permenkes.persenBB}%</div>
                <span class="status-badge ${getStatusClass(statusGizi.permenkes.statusBBU)}">${statusGizi.permenkes.statusBBU}</span>
                <div class="metric-description" style="margin-top: 0.5rem;">
                    <strong>IMT:</strong> ${statusGizi.permenkes.imt.nilai} (${statusGizi.permenkes.imt.kategori})<br>
                    <strong>Rekomendasi:</strong> ${statusGizi.permenkes.rekomendasi}
                </div>
            </div>
        `;
    }

    if (!html) {
        html = '<p style="color: var(--text-muted); font-style: italic;">Tambahkan data LILA untuk analisis status gizi lebih detail.</p>';
    }

    container.innerHTML = html;
}

function displayWeightAnalysis(results) {
    const container = document.getElementById('weightAnalysis');
    let html = '';

    // Berat Badan Ideal
    if (results.bbIdeal) {
        html += `
            <div class="metric-box">
                <div class="metric-label">⚖️ Berat Badan Ideal</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Metode</th>
                            <th>Nilai (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rumus Broca</td>
                            <td><strong>${results.bbIdeal.broca}</strong></td>
                        </tr>
                        ${results.bbIdeal.devine ? `
                        <tr>
                            <td>Rumus Devine</td>
                            <td><strong>${results.bbIdeal.devine}</strong></td>
                        </tr>
                        ` : ''}
                        ${results.bbIdeal.hamwi ? `
                        <tr>
                            <td>Rumus Hamwi</td>
                            <td><strong>${results.bbIdeal.hamwi}</strong></td>
                        </tr>
                        ` : ''}
                        <tr style="background: var(--primary-light);">
                            <td><strong>Rata-rata</strong></td>
                            <td><strong>${results.bbIdeal.rataRata} kg</strong></td>
                        </tr>
                        <tr>
                            <td>Rentang Ideal</td>
                            <td><strong>${results.bbIdeal.range.min} - ${results.bbIdeal.range.max} kg</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }

    // Lean Body Mass
    if (results.bbKering) {
        html += `
            <div class="metric-box">
                <div class="metric-label">💪 Berat Badan Tanpa Lemak (Lean Body Mass)</div>
                <table class="data-table">
                    <tbody>
                        <tr>
                            <td>Rumus Boer</td>
                            <td><strong>${results.bbKering.boer} kg</strong></td>
                        </tr>
                        <tr>
                            <td>Rumus Hume</td>
                            <td><strong>${results.bbKering.hume} kg</strong></td>
                        </tr>
                        <tr style="background: var(--primary-light);">
                            <td><strong>Rata-rata</strong></td>
                            <td><strong>${results.bbKering.rataRata} kg</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="metric-description" style="margin-top: 0.5rem;">${results.bbKering.penjelasan}</div>
            </div>
        `;
    }

    // Adjusted Ideal Weight
    if (results.bbIdealAdjusted && results.bbIdealAdjusted.digunakan) {
        html += `
            <div class="metric-box" style="border-left-color: var(--warning-color);">
                <div class="metric-label">⚠️ Berat Badan Ideal Adjusted</div>
                <div class="metric-value">${results.bbIdealAdjusted.nilai} kg</div>
                <div class="metric-description">${results.bbIdealAdjusted.penjelasan}</div>
            </div>
        `;
    }

    // Amputasi Correction
    if (results.bbKoreksiAmputasi && results.bbKoreksiAmputasi.diperlukan) {
        html += `
            <div class="metric-box" style="border-left-color: var(--accent-color);">
                <div class="metric-label">🦾 Koreksi Berat Badan (Amputasi)</div>
                <table class="data-table">
                    <tbody>
                        <tr>
                            <td>BB Aktual</td>
                            <td><strong>${results.bbKoreksiAmputasi.bbAktual} kg</strong></td>
                        </tr>
                        <tr>
                            <td>BB Koreksi</td>
                            <td><strong>${results.bbKoreksiAmputasi.bbKoreksi} kg</strong></td>
                        </tr>
                        <tr>
                            <td>Jenis Amputasi</td>
                            <td>${results.bbKoreksiAmputasi.jenisAmputasi}</td>
                        </tr>
                        <tr>
                            <td>Persentase Kehilangan</td>
                            <td>${results.bbKoreksiAmputasi.persenKehilangan}%</td>
                        </tr>
                    </tbody>
                </table>
                <div class="metric-description" style="margin-top: 0.5rem;">${results.bbKoreksiAmputasi.penjelasan}</div>
            </div>
        `;
    }

    container.innerHTML = html;
}

function displayEstimationResults(results) {
    const container = document.getElementById('estimationContent');
    let html = '';

    // Estimasi BB dari LILA
    if (results.estimasiBBLILA) {
        html += `
            <div class="metric-box">
                <div class="metric-label">📏 Estimasi Berat Badan dari LILA</div>
                <table class="data-table">
                    <tbody>
        `;
        
        Object.entries(results.estimasiBBLILA.estimasi).forEach(([key, value]) => {
            html += `
                <tr>
                    <td>${key.charAt(0).toUpperCase() + key.slice(1)}</td>
                    <td><strong>${value} kg</strong></td>
                </tr>
            `;
        });
        
        html += `
                    </tbody>
                </table>
                <div class="metric-description" style="margin-top: 0.5rem;">
                    ${results.estimasiBBLILA.penjelasan}<br>
                    <em>${results.estimasiBBLILA.akurasi}</em>
                </div>
            </div>
        `;
    }

    // Estimasi dari Ulna
    if (results.estimasiBBUlna) {
        html += `
            <div class="metric-box">
                <div class="metric-label">📐 Estimasi Tinggi Badan dari Panjang ULNA</div>
                <table class="data-table">
                    <tbody>
                        <tr>
                            <td>Tinggi Estimasi</td>
                            <td><strong>${results.estimasiBBUlna.tinggiEstimasi} cm</strong></td>
                        </tr>
                        <tr>
                            <td>Tinggi Aktual</td>
                            <td><strong>${results.estimasiBBUlna.tinggiAktual} cm</strong></td>
                        </tr>
                        <tr>
                            <td>Selisih</td>
                            <td><strong>${results.estimasiBBUlna.selisih} cm</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="metric-description" style="margin-top: 0.5rem;">
                    ${results.estimasiBBUlna.penjelasan}<br>
                    <em>${results.estimasiBBUlna.akurasi}</em>
                </div>
            </div>
        `;
    }

    // Estimasi dari Tinggi Lutut
    if (results.estimasiTBLutut) {
        html += `
            <div class="metric-box">
                <div class="metric-label">🦵 Estimasi Tinggi Badan dari Tinggi Lutut</div>
                <table class="data-table">
                    <tbody>
                        <tr>
                            <td>Tinggi Estimasi</td>
                            <td><strong>${results.estimasiTBLutut.estimasi} cm</strong></td>
                        </tr>
                        <tr>
                            <td>Tinggi Aktual</td>
                            <td><strong>${results.estimasiTBLutut.tinggiAktual} cm</strong></td>
                        </tr>
                        <tr>
                            <td>Selisih</td>
                            <td><strong>${results.estimasiTBLutut.selisih} cm</strong></td>
                        </tr>
                        <tr>
                            <td>Metode</td>
                            <td>${results.estimasiTBLutut.metode}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="metric-description" style="margin-top: 0.5rem;">${results.estimasiTBLutut.penjelasan}</div>
            </div>
        `;
    }

    if (!html) {
        html = '<p style="color: var(--text-muted); font-style: italic;">Tidak ada data estimasi tersedia. Tambahkan data LILA, ULNA, atau Tinggi Lutut untuk estimasi lebih detail.</p>';
    }

    container.innerHTML = html;
}

function displayRecommendations(recommendations) {
    const container = document.getElementById('recommendationsContent');
    let html = '';

    recommendations.forEach(rec => {
        html += `
            <div class="recommendation-section">
                <div class="recommendation-category">
                    <h4>${rec.kategori}</h4>
        `;

        if (rec.saran) {
            html += '<ul class="recommendation-list">';
            rec.saran.forEach(saran => {
                html += `<li>${saran}</li>`;
            });
            html += '</ul>';
        }

        if (rec.detail) {
            html += '<div class="nutrition-grid">';
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
            html += '<div style="margin-top: 1rem;"><h5 style="font-size: 0.9375rem; color: var(--text-dark); margin-bottom: 0.5rem;">Sumber Makanan:</h5><ul style="margin: 0; padding-left: 1.25rem;">';
            Object.entries(rec.sumber).forEach(([key, value]) => {
                html += `<li style="margin-bottom: 0.375rem;"><strong>${key}:</strong> ${value}</li>`;
            });
            html += '</ul></div>';
        }

        if (rec.kondisi) {
            html += `<p style="margin-top: 0.75rem; padding: 0.75rem; background: var(--bg-gray); border-radius: var(--radius-sm);"><strong>Kondisi:</strong> ${rec.kondisi}</p>`;
        }

        html += `
                </div>
            </div>
        `;
    });

    container.innerHTML = html;
}

function getStatusClass(status) {
    const statusLower = status.toLowerCase();
    
    if (statusLower.includes('normal') || statusLower.includes('baik')) {
        return 'status-normal';
    }
    
    if (statusLower.includes('kurang') || statusLower.includes('buruk') || 
        statusLower.includes('kurus') || statusLower.includes('risiko') ||
        statusLower.includes('kek')) {
        return 'status-danger';
    }
    
    if (statusLower.includes('lebih') || statusLower.includes('obesitas') ||
        statusLower.includes('rendah')) {
        return 'status-warning';
    }
    
    return 'status-normal';
}

// Educational modal functions
function showEducation(topic) {
    const modal = document.getElementById('educationModal');
    const content = document.getElementById('educationContent');
    const data = educationalContent[topic];

    if (!data) return;

    let html = `<h3>${data.judul}</h3>`;
    html += `<p><strong>Definisi:</strong> ${data.definisi}</p>`;

    if (data.rumus) {
        if (Array.isArray(data.rumus)) {
            html += '<h4>Rumus:</h4><ul>';
            data.rumus.forEach(r => {
                html += `<li>${r}</li>`;
            });
            html += '</ul>';
        } else {
            html += `<p><strong>Rumus:</strong> ${data.rumus}</p>`;
        }
    }

    if (data.cara_ukur) {
        html += `<h4>Cara Mengukur:</h4><p>${data.cara_ukur}</p>`;
    }

    if (data.kegunaan) {
        html += `<h4>Kegunaan:</h4><p>${data.kegunaan}</p>`;
    }

    if (data.kategori) {
        html += '<h4>Kategori:</h4><ul>';
        data.kategori.forEach(k => {
            html += `<li>${k}</li>`;
        });
        html += '</ul>';
    }

    if (data.cut_off) {
        html += '<h4>Cut-off Point:</h4><ul>';
        data.cut_off.forEach(c => {
            html += `<li>${c}</li>`;
        });
        html += '</ul>';
    }

    if (data.jenis_pengukuran) {
        html += '<h4>Jenis Pengukuran:</h4><ul>';
        data.jenis_pengukuran.forEach(j => {
            html += `<li><strong>${j.nama}:</strong> ${j.deskripsi}</li>`;
        });
        html += '</ul>';
    }

    if (data.keunggulan) {
        html += `<h4>Keunggulan:</h4><p>${data.keunggulan}</p>`;
    }

    if (data.keterbatasan) {
        html += `<h4>Keterbatasan:</h4><p>${data.keterbatasan}</p>`;
    }

    if (data.akurasi) {
        html += `<h4>Akurasi:</h4><p>${data.akurasi}</p>`;
    }

    if (data.aplikasi) {
        html += `<h4>Aplikasi:</h4><p>${data.aplikasi}</p>`;
    }

    if (data.aplikasi_klinis) {
        html += `<h4>Aplikasi Klinis:</h4><p>${data.aplikasi_klinis}</p>`;
    }

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

// Reset form function
function resetForm() {
    document.getElementById('nutritionForm').reset();
    document.getElementById('resultsSection').style.display = 'none';
    document.getElementById('lingkarBetisGroup').style.display = 'none';
    
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
