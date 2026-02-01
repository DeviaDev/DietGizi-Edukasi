<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NutritionCalculatorController extends Controller
{
    public function index()
    {
        return view('nutrition.calculator');
    }

     public function beranda()
    {
        return view('nutrition.beranda');
    }

    public function recommendations()
    {
        return view('nutrition.recommendations');
    }

    public function calculate(Request $request)
    {
        $data = $request->validate([
            'tinggi' => 'required|numeric|min:50|max:250',
            'berat' => 'required|numeric|min:10|max:300',
            'umur' => 'required|integer|min:0|max:150',
            'jenisKelamin' => 'required|in:pria,wanita',
            'lila' => 'nullable|numeric|min:5|max:60',
            'ulna' => 'nullable|numeric|min:10|max:50',
            'lingkarBetis' => 'nullable|numeric|min:10|max:60',
            'tinggiLutut' => 'nullable|numeric|min:30|max:80',
            'amputasi' => 'nullable|string',
            'penyakit' => 'nullable|string',
        ]);

        $results = [
            'imt' => $this->calculateIMT($data),
            'statusGizi' => $this->determineNutritionalStatus($data),
            'bbIdeal' => $this->calculateIdealWeight($data),
            'bbKering' => $this->calculateLeanBodyMass($data),
            'bbIdealAdjusted' => $this->calculateAdjustedIdealWeight($data),
            'bbKoreksiAmputasi' => $this->calculateAmputationCorrection($data),
            'estimasiBBLILA' => $this->estimateWeightFromMUAC($data),
            'estimasiBBUlna' => $this->estimateWeightFromUlna($data),
            'estimasiTBLutut' => $this->estimateHeightFromKnee($data),
            'recommendations' => $this->generateRecommendations($data),
        ];

        return response()->json($results);
    }

    private function calculateIMT($data)
    {
        $tinggiMeter = $data['tinggi'] / 100;
        $imt = $data['berat'] / ($tinggiMeter * $tinggiMeter);
        
        $kategori = $this->getIMTCategory($imt, $data['umur']);
        
        return [
            'nilai' => round($imt, 2),
            'kategori' => $kategori,
            'penjelasan' => $this->getIMTExplanation($kategori)
        ];
    }

    private function getIMTCategory($imt, $umur)
    {
        // WHO Classification for Adults
        if ($umur >= 18) {
            if ($imt < 17.0) return 'Sangat Kurus (Severe Thinness)';
            if ($imt < 18.5) return 'Kurus (Underweight)';
            if ($imt < 25.0) return 'Normal';
            if ($imt < 30.0) return 'Kelebihan Berat Badan (Overweight)';
            if ($imt < 35.0) return 'Obesitas Kelas I';
            if ($imt < 40.0) return 'Obesitas Kelas II';
            return 'Obesitas Kelas III (Morbid)';
        }
        
        // For children, use WHO growth charts (simplified)
        if ($imt < 16.0) return 'Gizi Buruk';
        if ($imt < 18.5) return 'Gizi Kurang';
        if ($imt < 25.0) return 'Gizi Baik';
        return 'Gizi Lebih/Obesitas';
    }

    private function getIMTExplanation($kategori)
    {
        $explanations = [
            'Sangat Kurus (Severe Thinness)' => 'Status gizi sangat kurang, memerlukan intervensi medis segera.',
            'Kurus (Underweight)' => 'Berat badan di bawah ideal, perlu peningkatan asupan nutrisi.',
            'Normal' => 'Berat badan ideal dan sehat. Pertahankan pola hidup sehat.',
            'Kelebihan Berat Badan (Overweight)' => 'Berat badan berlebih, berisiko terhadap penyakit metabolik.',
            'Obesitas Kelas I' => 'Obesitas ringan, perlu pengaturan diet dan olahraga teratur.',
            'Obesitas Kelas II' => 'Obesitas sedang, konsultasi dengan ahli gizi diperlukan.',
            'Obesitas Kelas III (Morbid)' => 'Obesitas berat, memerlukan intervensi medis serius.',
            'Gizi Buruk' => 'Status gizi anak sangat kurang, perlu pemantauan medis.',
            'Gizi Kurang' => 'Status gizi anak kurang, perlu perbaikan pola makan.',
            'Gizi Baik' => 'Status gizi anak baik, pertahankan pola makan sehat.',
            'Gizi Lebih/Obesitas' => 'Status gizi anak berlebih, perlu pengaturan aktivitas dan diet.',
        ];
        
        return $explanations[$kategori] ?? 'Konsultasikan dengan tenaga kesehatan.';
    }

    private function determineNutritionalStatus($data)
    {
        $umur = $data['umur'];
        $results = [];

        // Status Gizi dari IMT
        $results['dariIMT'] = $this->calculateIMT($data);

        // Status Gizi dari LILA (jika ada)
        if (!empty($data['lila'])) {
            $results['dariLILA'] = $this->assessFromMUAC($data['lila'], $umur, $data['jenisKelamin']);
        }

        // Untuk Lansia (>60 tahun)
        if ($umur >= 60) {
            if (!empty($data['lila'])) {
                $results['lansiaLILA'] = $this->assessElderlyMUAC($data['lila'], $data['jenisKelamin']);
            }
            if (!empty($data['lingkarBetis'])) {
                $results['lansiaLingkarBetis'] = $this->assessCalfCircumference($data['lingkarBetis']);
            }
        }

        // Untuk Anak (berdasarkan Permenkes No 2 Tahun 2020)
        if ($umur < 18) {
            $results['permenkes'] = $this->assessChildNutrition($data);
        }

        return $results;
    }

    private function assessFromMUAC($lila, $umur, $jenisKelamin)
    {
        // Berdasarkan kriteria WHO dan berbagai sumber
        if ($umur >= 18) {
            // Dewasa
            $cutoff = $jenisKelamin === 'pria' ? 23.0 : 22.0;
            
            if ($lila < $cutoff) {
                $status = 'Kurang Energi Kronis (KEK)';
                $penjelasan = 'LILA di bawah standar, menunjukkan risiko malnutrisi.';
            } else {
                $status = 'Normal';
                $penjelasan = 'LILA dalam batas normal.';
            }
        } else if ($umur >= 5) {
            // Anak 5-18 tahun
            if ($lila < 16.0) {
                $status = 'Gizi Buruk';
                $penjelasan = 'LILA sangat rendah, memerlukan intervensi segera.';
            } else if ($lila < 18.5) {
                $status = 'Gizi Kurang';
                $penjelasan = 'LILA di bawah standar untuk usia ini.';
            } else {
                $status = 'Normal';
                $penjelasan = 'LILA dalam batas normal untuk usia ini.';
            }
        } else {
            // Balita
            if ($lila < 11.5) {
                $status = 'Gizi Buruk';
                $penjelasan = 'LILA sangat rendah untuk balita.';
            } else if ($lila < 12.5) {
                $status = 'Gizi Kurang';
                $penjelasan = 'LILA kurang untuk balita.';
            } else {
                $status = 'Normal';
                $penjelasan = 'LILA normal untuk balita.';
            }
        }

        return [
            'nilai' => $lila,
            'status' => $status,
            'penjelasan' => $penjelasan,
            'metode' => 'LILA (Lingkar Lengan Atas)'
        ];
    }

    private function assessElderlyMUAC($lila, $jenisKelamin)
    {
        // Untuk lansia berdasarkan beberapa penelitian
        $cutoff = $jenisKelamin === 'pria' ? 25.0 : 24.0;
        
        if ($lila < $cutoff) {
            $status = 'Risiko Malnutrisi';
            $penjelasan = 'LILA lansia di bawah batas normal, risiko malnutrisi meningkat.';
        } else if ($lila < ($cutoff + 2)) {
            $status = 'Normal Rendah';
            $penjelasan = 'LILA lansia dalam batas normal rendah, perlu pemantauan.';
        } else {
            $status = 'Normal';
            $penjelasan = 'LILA lansia dalam batas normal.';
        }

        return [
            'nilai' => $lila,
            'status' => $status,
            'penjelasan' => $penjelasan
        ];
    }

    private function assessCalfCircumference($lingkarBetis)
    {
        // Standar WHO untuk lansia
        if ($lingkarBetis < 31.0) {
            $status = 'Risiko Malnutrisi Tinggi';
            $penjelasan = 'Lingkar betis sangat rendah, indikasi kehilangan massa otot.';
        } else {
            $status = 'Normal';
            $penjelasan = 'Lingkar betis dalam batas normal.';
        }

        return [
            'nilai' => $lingkarBetis,
            'status' => $status,
            'penjelasan' => $penjelasan
        ];
    }

    private function assessChildNutrition($data)
    {
        // Simplified assessment based on Permenkes No 2 Tahun 2020
        $imt = $this->calculateIMT($data);
        $tinggi = $data['tinggi'];
        $umur = $data['umur'];
        
        // BB/U (Weight for Age)
        $bbIdeal = $this->calculateChildIdealWeight($tinggi, $umur, $data['jenisKelamin']);
        $persenBB = ($data['berat'] / $bbIdeal) * 100;
        
        if ($persenBB < 80) {
            $statusBBU = 'Berat Badan Sangat Kurang';
        } else if ($persenBB < 90) {
            $statusBBU = 'Berat Badan Kurang';
        } else if ($persenBB <= 110) {
            $statusBBU = 'Berat Badan Normal';
        } else {
            $statusBBU = 'Berat Badan Lebih';
        }

        return [
            'statusBBU' => $statusBBU,
            'persenBB' => round($persenBB, 1),
            'imt' => $imt,
            'rekomendasi' => $this->getChildRecommendation($statusBBU)
        ];
    }

    private function calculateChildIdealWeight($tinggi, $umur, $jenisKelamin)
    {
        // Simplified formula - in reality, use WHO growth charts
        // This is an approximation
        if ($umur < 12) {
            // Infants
            return ($umur * 0.5) + 4;
        } else if ($umur < 18) {
            // Children/Adolescents - simplified
            $base = $jenisKelamin === 'pria' ? 12 : 11;
            return $base + (($umur - 2) * 2);
        }
        return 50; // fallback
    }

    private function getChildRecommendation($status)
    {
        $recommendations = [
            'Berat Badan Sangat Kurang' => 'Konsultasi ke dokter/ahli gizi segera. Perlukan evaluasi medis lengkap.',
            'Berat Badan Kurang' => 'Tingkatkan asupan kalori dan protein. Konsultasi ke ahli gizi.',
            'Berat Badan Normal' => 'Pertahankan pola makan sehat dan seimbang.',
            'Berat Badan Lebih' => 'Atur pola makan dan tingkatkan aktivitas fisik.'
        ];
        
        return $recommendations[$status] ?? 'Konsultasi dengan tenaga kesehatan.';
    }

    private function calculateIdealWeight($data)
    {
        $tinggi = $data['tinggi'];
        $jenisKelamin = $data['jenisKelamin'];
        $umur = $data['umur'];

        $results = [];

        // Rumus Broca (umum)
        $bbBroca = ($tinggi - 100) * 0.9;
        if ($jenisKelamin === 'wanita') {
            $bbBroca *= 0.95;
        }
        $results['broca'] = round($bbBroca, 2);

        // Rumus Devine (untuk dewasa)
        if ($umur >= 18) {
            if ($jenisKelamin === 'pria') {
                $bbDevine = 50 + (2.3 * (($tinggi - 152.4) / 2.54));
            } else {
                $bbDevine = 45.5 + (2.3 * (($tinggi - 152.4) / 2.54));
            }
            $results['devine'] = round($bbDevine, 2);
        }

        // Rumus Hamwi
        if ($umur >= 18) {
            if ($jenisKelamin === 'pria') {
                $bbHamwi = 48 + (2.7 * (($tinggi - 152.4) / 2.54));
            } else {
                $bbHamwi = 45.5 + (2.2 * (($tinggi - 152.4) / 2.54));
            }
            $results['hamwi'] = round($bbHamwi, 2);
        }

        // Rata-rata dari semua metode
        $results['rataRata'] = round(array_sum($results) / count($results), 2);
        $results['range'] = [
            'min' => round(min($results) * 0.95, 2),
            'max' => round(max($results) * 1.05, 2)
        ];

        return $results;
    }

    private function calculateLeanBodyMass($data)
    {
        // Rumus Boer untuk Lean Body Mass
        $berat = $data['berat'];
        $tinggi = $data['tinggi'];
        $jenisKelamin = $data['jenisKelamin'];

        if ($jenisKelamin === 'pria') {
            $lbm = (0.407 * $berat) + (0.267 * $tinggi) - 19.2;
        } else {
            $lbm = (0.252 * $berat) + (0.473 * $tinggi) - 48.3;
        }

        // Rumus Hume
        if ($jenisKelamin === 'pria') {
            $lbmHume = (0.32810 * $berat) + (0.33929 * $tinggi) - 29.5336;
        } else {
            $lbmHume = (0.29569 * $berat) + (0.41813 * $tinggi) - 43.2933;
        }

        return [
            'boer' => round($lbm, 2),
            'hume' => round($lbmHume, 2),
            'rataRata' => round(($lbm + $lbmHume) / 2, 2),
            'penjelasan' => 'Berat badan tanpa lemak (lean body mass) menunjukkan massa otot dan organ.'
        ];
    }

    private function calculateAdjustedIdealWeight($data)
    {
        // Untuk pasien obesitas
        $bbIdeal = $this->calculateIdealWeight($data);
        $bbAktual = $data['berat'];
        $imt = $this->calculateIMT($data);

        if ($imt['nilai'] >= 30) {
            // Rumus adjusted ideal body weight
            $bbIdealAdjusted = $bbIdeal['rataRata'] + (($bbAktual - $bbIdeal['rataRata']) * 0.25);
            
            return [
                'nilai' => round($bbIdealAdjusted, 2),
                'penjelasan' => 'Berat badan ideal yang disesuaikan untuk pasien obesitas.',
                'digunakan' => true
            ];
        }

        return [
            'nilai' => $bbIdeal['rataRata'],
            'penjelasan' => 'Tidak diperlukan penyesuaian karena IMT < 30.',
            'digunakan' => false
        ];
    }

    private function calculateAmputationCorrection($data)
    {
        if (empty($data['amputasi'])) {
            return [
                'diperlukan' => false,
                'nilai' => $data['berat'],
                'penjelasan' => 'Tidak ada amputasi.'
            ];
        }

        // Persentase berat bagian tubuh yang diamputasi
        $persentaseAmputasi = [
            'tangan' => 0.65,
            'lengan_bawah' => 1.6,
            'lengan_atas' => 2.7,
            'seluruh_lengan' => 5.0,
            'kaki' => 1.5,
            'tungkai_bawah' => 6.0,
            'tungkai_atas' => 10.0,
            'seluruh_tungkai' => 16.0,
        ];

        $amputasi = strtolower($data['amputasi']);
        $persenKehilangan = $persentaseAmputasi[$amputasi] ?? 0;

        $bbTanpaAmputasi = $data['berat'] / (1 - ($persenKehilangan / 100));

        return [
            'diperlukan' => true,
            'bbAktual' => $data['berat'],
            'bbKoreksi' => round($bbTanpaAmputasi, 2),
            'persenKehilangan' => $persenKehilangan,
            'jenisAmputasi' => $amputasi,
            'penjelasan' => 'Berat badan dikoreksi untuk memperhitungkan amputasi.'
        ];
    }

    private function estimateWeightFromMUAC($data)
    {
        if (empty($data['lila'])) {
            return null;
        }

        $lila = $data['lila'];
        $umur = $data['umur'];
        $jenisKelamin = $data['jenisKelamin'];
        $results = [];

        // Estimasi BB Dewasa dari LILA (Rumus CHUMLEA)
        if ($umur >= 18 && $umur < 60) {
            if ($jenisKelamin === 'pria') {
                $bb = (1.19 * $lila) + (1.48 * $data['tinggi']) - 162.31;
            } else {
                $bb = (1.01 * $lila) + (1.09 * $data['tinggi']) - 127.24;
            }
            $results['dewasa'] = round($bb, 2);
        }

        // Estimasi BB Anak dari LILA
        if ($umur < 18 && $umur >= 1) {
            // Simplified formula for children
            $bb = ($lila - 8) * 2.5;
            $results['anak'] = round($bb, 2);
        }

        // Estimasi BB Lansia dari LILA (>60 tahun)
        if ($umur >= 60) {
            if ($jenisKelamin === 'pria') {
                $bb = (0.98 * $lila) + (1.16 * $data['tinggi']) - 91.45;
            } else {
                $bb = (1.27 * $lila) + (0.87 * $data['tinggi']) - 102.19;
            }
            $results['lansia'] = round($bb, 2);
        }

        return [
            'estimasi' => $results,
            'penjelasan' => 'Estimasi berat badan berdasarkan LILA menggunakan rumus Chumlea.',
            'akurasi' => 'Estimasi ini memiliki margin error ±10-15%'
        ];
    }

    private function estimateWeightFromUlna($data)
    {
        if (empty($data['ulna'])) {
            return null;
        }

        $ulna = $data['ulna'];
        $umur = $data['umur'];
        $jenisKelamin = $data['jenisKelamin'];

        // Estimasi tinggi badan dari panjang ulna (untuk verifikasi)
        if ($jenisKelamin === 'pria') {
            $tinggiEstimasi = (4.605 * $ulna) + 1.308 * $umur + 28.003;
        } else {
            $tinggiEstimasi = (4.459 * $ulna) + 1.315 * $umur + 31.485;
        }

        return [
            'tinggiEstimasi' => round($tinggiEstimasi, 2),
            'tinggiAktual' => $data['tinggi'],
            'selisih' => round(abs($tinggiEstimasi - $data['tinggi']), 2),
            'penjelasan' => 'Estimasi tinggi badan dari panjang ulna dapat digunakan untuk pasien yang tidak bisa berdiri.',
            'akurasi' => 'Akurasi estimasi ±3-5 cm'
        ];
    }

    private function estimateHeightFromKnee($data)
    {
        if (empty($data['tinggiLutut'])) {
            return null;
        }

        $tinggiLutut = $data['tinggiLutut'];
        $umur = $data['umur'];
        $jenisKelamin = $data['jenisKelamin'];

        // Rumus Chumlea untuk estimasi tinggi dari tinggi lutut
        if ($jenisKelamin === 'pria') {
            $tinggiEstimasi = (2.02 * $tinggiLutut) - (0.04 * $umur) + 64.19;
        } else {
            $tinggiEstimasi = (1.83 * $tinggiLutut) - (0.24 * $umur) + 84.88;
        }

        return [
            'estimasi' => round($tinggiEstimasi, 2),
            'tinggiAktual' => $data['tinggi'],
            'selisih' => round(abs($tinggiEstimasi - $data['tinggi']), 2),
            'penjelasan' => 'Estimasi tinggi badan dari tinggi lutut untuk pasien bedridden.',
            'metode' => 'Chumlea Formula'
        ];
    }

    private function generateRecommendations($data)
    {
        $imt = $this->calculateIMT($data);
        $recommendations = [];

        // Rekomendasi berdasarkan IMT
        if ($imt['nilai'] < 18.5) {
            $recommendations[] = [
                'kategori' => 'Peningkatan Berat Badan',
                'saran' => [
                    'Tingkatkan asupan kalori 500-750 kkal/hari',
                    'Konsumsi makanan tinggi protein (daging, telur, kacang)',
                    'Makan dalam porsi kecil tapi sering (5-6x sehari)',
                    'Tambahkan cemilan sehat tinggi kalori',
                    'Konsultasi dengan ahli gizi untuk program weight gain'
                ]
            ];
        } else if ($imt['nilai'] >= 25) {
            $recommendations[] = [
                'kategori' => 'Penurunan Berat Badan',
                'saran' => [
                    'Kurangi asupan kalori 500-750 kkal/hari',
                    'Tingkatkan konsumsi sayur dan buah',
                    'Batasi makanan tinggi gula dan lemak jenuh',
                    'Olahraga teratur minimal 150 menit/minggu',
                    'Hindari minuman manis dan fast food',
                    'Konsultasi dengan ahli gizi untuk program diet sehat'
                ]
            ];
        }

        // Rekomendasi nutrisi spesifik
        $recommendations[] = $this->getNutrientRecommendations($data);

        // Rekomendasi aktivitas fisik
        $recommendations[] = $this->getPhysicalActivityRecommendations($data);

        // Rekomendasi berdasarkan kondisi kesehatan
        if (!empty($data['penyakit'])) {
            $recommendations[] = $this->getDiseaseSpecificRecommendations($data['penyakit']);
        }

        return $recommendations;
    }

    private function getNutrientRecommendations($data)
    {
        $umur = $data['umur'];
        $jenisKelamin = $data['jenisKelamin'];
        $berat = $data['berat'];

        // Kebutuhan protein (g/kg BB)
        $proteinPerKg = 0.8;
        if ($umur >= 65) $proteinPerKg = 1.0;
        if (!empty($data['penyakit']) && str_contains(strtolower($data['penyakit']), 'ginjal')) {
            $proteinPerKg = 0.6;
        }

        $protein = round($berat * $proteinPerKg, 1);

        return [
            'kategori' => 'Kebutuhan Nutrisi Harian',
            'detail' => [
                'Protein' => $protein . ' gram/hari',
                'Karbohidrat' => '45-65% dari total kalori',
                'Lemak' => '20-35% dari total kalori',
                'Serat' => '25-30 gram/hari',
                'Air' => '8-10 gelas/hari (2-2.5 liter)'
            ],
            'sumber' => [
                'Protein' => 'Daging tanpa lemak, ikan, telur, tahu, tempe, kacang-kacangan',
                'Karbohidrat' => 'Nasi merah, roti gandum, oatmeal, kentang, ubi',
                'Lemak Sehat' => 'Alpukat, kacang, minyak zaitun, ikan salmon',
                'Serat' => 'Sayuran hijau, buah-buahan, biji-bijian utuh',
                'Vitamin & Mineral' => 'Buah dan sayur beragam warna'
            ]
        ];
    }

    private function getPhysicalActivityRecommendations($data)
    {
        $umur = $data['umur'];
        $imt = $this->calculateIMT($data);

        $recommendations = [];

        if ($umur < 18) {
            $recommendations = [
                'Minimal 60 menit aktivitas fisik sedang-berat per hari',
                'Aktivitas aerobik seperti berlari, bersepeda, berenang',
                'Latihan kekuatan otot 3x seminggu',
                'Batasi screen time maksimal 2 jam/hari'
            ];
        } else if ($umur >= 65) {
            $recommendations = [
                'Minimal 150 menit aktivitas aerobik ringan-sedang per minggu',
                'Jalan kaki, senam, tai chi, atau berenang',
                'Latihan keseimbangan untuk mencegah jatuh',
                'Latihan fleksibilitas dan peregangan',
                'Konsultasi dokter sebelum memulai program olahraga baru'
            ];
        } else {
            $recommendations = [
                'Minimal 150 menit aktivitas aerobik sedang per minggu',
                'Atau 75 menit aktivitas berat per minggu',
                'Latihan kekuatan otot 2-3x seminggu',
                'Kombinasi kardio (jalan cepat, jogging) dan strength training',
                'Peregangan dan cooling down setelah berolahraga'
            ];
        }

        return [
            'kategori' => 'Aktivitas Fisik',
            'saran' => $recommendations
        ];
    }

    private function getDiseaseSpecificRecommendations($penyakit)
    {
        $penyakit = strtolower($penyakit);
        $recommendations = [];

        if (str_contains($penyakit, 'diabetes')) {
            $recommendations = [
                'Kontrol asupan karbohidrat (pilih karbohidrat kompleks)',
                'Hindari gula sederhana dan makanan tinggi glikemik',
                'Makan dalam porsi kecil dengan jadwal teratur',
                'Monitor gula darah secara rutin',
                'Konsumsi serat tinggi untuk kontrol gula darah'
            ];
        } else if (str_contains($penyakit, 'hipertensi') || str_contains($penyakit, 'darah tinggi')) {
            $recommendations = [
                'Batasi asupan natrium/garam (<2300 mg/hari)',
                'Tingkatkan konsumsi kalium (pisang, kentang, bayam)',
                'Diet DASH (Dietary Approaches to Stop Hypertension)',
                'Hindari makanan olahan dan kalengan',
                'Kurangi konsumsi kafein'
            ];
        } else if (str_contains($penyakit, 'kolesterol')) {
            $recommendations = [
                'Batasi lemak jenuh dan trans fat',
                'Tingkatkan konsumsi lemak tak jenuh (omega-3)',
                'Konsumsi makanan tinggi serat larut (oatmeal, kacang)',
                'Hindari gorengan dan makanan berlemak tinggi',
                'Makan ikan minimal 2x seminggu'
            ];
        } else if (str_contains($penyakit, 'ginjal')) {
            $recommendations = [
                'Batasi protein sesuai anjuran dokter',
                'Kontrol asupan natrium, kalium, dan fosfor',
                'Batasi cairan jika ada retensi',
                'Hindari makanan tinggi purin',
                'Konsultasi rutin dengan dietitian ginjal'
            ];
        } else {
            $recommendations = [
                'Konsultasikan kondisi kesehatan dengan dokter',
                'Ikuti diet sesuai rekomendasi tenaga medis',
                'Monitor kondisi kesehatan secara rutin'
            ];
        }

        return [
            'kategori' => 'Rekomendasi Khusus Kondisi Kesehatan',
            'kondisi' => ucfirst($penyakit),
            'saran' => $recommendations
        ];
    }

    public function getRecommendations(Request $request)
    {
        $data = $request->all();
        $recommendations = $this->generateRecommendations($data);
        
        return response()->json([
            'recommendations' => $recommendations,
            'educationalContent' => $this->getEducationalContent()
        ]);
    }

    private function getEducationalContent()
    {
        return [
            'imt' => [
                'judul' => 'Apa itu IMT (Indeks Massa Tubuh)?',
                'definisi' => 'IMT adalah ukuran yang digunakan untuk menilai status gizi seseorang berdasarkan perbandingan berat badan dan tinggi badan.',
                'rumus' => 'IMT = Berat Badan (kg) / (Tinggi Badan (m))²',
                'kegunaan' => 'Untuk mengidentifikasi kelebihan atau kekurangan berat badan yang dapat meningkatkan risiko masalah kesehatan.',
                'keterbatasan' => 'IMT tidak membedakan antara massa otot dan lemak, sehingga atlet dengan otot banyak bisa dikategorikan overweight.'
            ],
            'lila' => [
                'judul' => 'Apa itu LILA (Lingkar Lengan Atas)?',
                'definisi' => 'LILA adalah pengukuran lingkar lengan atas bagian tengah yang digunakan untuk menilai status gizi, terutama untuk deteksi malnutrisi.',
                'cara_ukur' => 'Diukur pada titik tengah antara ujung bahu (akromion) dan siku (olekranon) menggunakan pita ukur.',
                'kegunaan' => 'Screening cepat untuk malnutrisi, khususnya pada ibu hamil, balita, dan lansia. Dapat digunakan saat pengukuran tinggi/berat badan sulit dilakukan.',
                'cut_off' => 'Dewasa: <23 cm (pria), <22 cm (wanita) = KEK (Kurang Energi Kronis). Balita: <11.5 cm = Gizi Buruk.'
            ],
            'ulna' => [
                'judul' => 'Apa itu Panjang ULNA?',
                'definisi' => 'Ulna adalah tulang lengan bawah yang panjangnya dapat digunakan untuk memperkirakan tinggi badan seseorang.',
                'cara_ukur' => 'Diukur dari ujung siku (olekranon) hingga ujung tulang pergelangan tangan (styloid process) dengan lengan membentuk sudut 90°.',
                'kegunaan' => 'Mengestimasi tinggi badan pada pasien yang tidak bisa berdiri (bedrest, kyphosis, amputasi tungkai).',
                'akurasi' => 'Memiliki korelasi tinggi dengan tinggi badan sebenarnya, dengan margin error ±3-5 cm.'
            ],
            'antropometri' => [
                'judul' => 'Pengukuran Antropometri',
                'definisi' => 'Antropometri adalah pengukuran dimensi tubuh dan komposisi tubuh manusia.',
                'jenis_pengukuran' => [
                    'Tinggi Badan' => 'Mengukur panjang tubuh dari ujung kepala hingga telapak kaki',
                    'Berat Badan' => 'Mengukur massa tubuh total',
                    'LILA' => 'Lingkar lengan atas untuk status gizi',
                    'Lingkar Betis' => 'Indikator massa otot, terutama pada lansia',
                    'Tinggi Lutut' => 'Untuk estimasi tinggi badan pada pasien bedridden',
                    'Tebal Lipatan Kulit' => 'Mengukur lemak subkutan'
                ],
                'kegunaan' => 'Menilai status gizi, pertumbuhan, komposisi tubuh, dan risiko penyakit terkait gizi.'
            ]
        ];
    }
}
