<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NutritionCalculatorController extends Controller
{
    /**
     * Tampilkan halaman kalkulator
     */
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
    /**
     * Proses perhitungan status gizi
     */
    public function calculate(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tinggi' => 'required|numeric|min:50|max:250',
            'berat' => 'required|numeric|min:10|max:300',
            'umur' => 'required|integer|min:0|max:150',
            'jenisKelamin' => 'required|in:pria,wanita',
            'lila' => 'nullable|numeric|min:5|max:60',
            'ulna' => 'nullable|numeric|min:10|max:50',
            'tinggiLutut' => 'nullable|numeric|min:30|max:80',
            'lingkarBetis' => 'nullable|numeric|min:10|max:60',
            'amputasi' => 'nullable|string',
            'penyakit' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Hitung semua parameter
        $results = [
            'success' => true,
            'data' => $data,
            'imt' => $this->calculateIMT($data['tinggi'], $data['berat']),
            'statusGizi' => $this->assessNutritionStatus($data),
            'bbIdeal' => $this->calculateIdealWeight($data['tinggi'], $data['jenisKelamin'], $data['umur']),
            'bbKering' => $this->calculateLeanBodyMass($data),
            'bmr' => $this->calculateBMR($data),
            'tdee' => null,
            'kebutuhanGizi' => null,
            'rencanaMakan' => null,
            'estimasiBBLILA' => null,
            'estimasiBBUlna' => null,
            'estimasiTBLutut' => null,
            'bbKoreksiAmputasi' => null,
            'bbIdealAdjusted' => null,
            'recommendations' => []
        ];

        // Hitung TDEE
        $results['tdee'] = $this->calculateTDEE($results['bmr']);

        // Hitung kebutuhan gizi
        $results['kebutuhanGizi'] = $this->calculateNutritionNeeds($results['tdee'], $data);

        // Generate rencana makan
        $results['rencanaMakan'] = $this->generateMealPlan($results['kebutuhanGizi'], $data);

        // Estimasi dari LILA
        if (!empty($data['lila'])) {
            $results['estimasiBBLILA'] = $this->estimateWeightFromLILA($data['lila'], $data['jenisKelamin']);
        }

        // Estimasi dari ULNA
        if (!empty($data['ulna'])) {
            $results['estimasiBBUlna'] = $this->estimateHeightFromUlna($data['ulna'], $data['jenisKelamin'], $data['umur'], $data['tinggi']);
        }

        // Estimasi dari Tinggi Lutut
        if (!empty($data['tinggiLutut'])) {
            $results['estimasiTBLutut'] = $this->estimateHeightFromKneeHeight($data['tinggiLutut'], $data['jenisKelamin'], $data['umur'], $data['tinggi']);
        }

        // Koreksi amputasi
        if (!empty($data['amputasi'])) {
            $results['bbKoreksiAmputasi'] = $this->adjustWeightForAmputation($data['berat'], $data['amputasi']);
        }

        // Adjusted Ideal Weight untuk obesitas
        if ($results['imt']['nilai'] >= 27) {
            $results['bbIdealAdjusted'] = $this->calculateAdjustedIdealWeight($data['berat'], $results['bbIdeal']['broca']);
        }

        // Generate rekomendasi
        $results['recommendations'] = $this->generateRecommendations($results, $data);

        return response()->json($results);
    }

    /**
     * Hitung IMT (Indeks Massa Tubuh)
     */
    private function calculateIMT($tinggi, $berat)
    {
        $tinggiM = $tinggi / 100;
        $imt = $berat / ($tinggiM * $tinggiM);

        // Kategori berdasarkan standar Asia-Pasifik
        if ($imt < 17.0) {
            $kategori = 'Sangat Kurus';
            $status = 'Gizi Buruk';
            $penjelasan = 'Berat badan Anda sangat kurang. Konsultasikan dengan ahli gizi untuk program peningkatan berat badan yang sehat.';
        } elseif ($imt < 18.5) {
            $kategori = 'Kurus';
            $status = 'Gizi Kurang';
            $penjelasan = 'Berat badan Anda kurang. Tingkatkan asupan kalori dan nutrisi dengan pola makan seimbang.';
        } elseif ($imt < 25.0) {
            $kategori = 'Normal';
            $status = 'Gizi Baik';
            $penjelasan = 'Berat badan Anda ideal! Pertahankan pola makan sehat dan olahraga teratur.';
        } elseif ($imt < 27.0) {
            $kategori = 'Gemuk';
            $status = 'Gizi Lebih';
            $penjelasan = 'Berat badan Anda berlebih. Kurangi asupan kalori dan tingkatkan aktivitas fisik.';
        } else {
            $kategori = 'Obesitas';
            $status = 'Obesitas';
            $penjelasan = 'Anda mengalami obesitas. Konsultasikan dengan dokter atau ahli gizi untuk program penurunan berat badan yang aman.';
        }

        return [
            'nilai' => round($imt, 1),
            'kategori' => $kategori,
            'status' => $status,
            'penjelasan' => $penjelasan
        ];
    }

    /**
     * Penilaian status gizi dari berbagai metode
     */
    private function assessNutritionStatus($data)
    {
        $status = [];

        // Status dari LILA (Lingkar Lengan Atas)
        if (!empty($data['lila'])) {
            $lila = $data['lila'];
            $jenisKelamin = $data['jenisKelamin'];
            $umur = $data['umur'];

            if ($jenisKelamin === 'wanita' && $umur >= 15) {
                if ($lila < 23.5) {
                    $statusLILA = 'Kurang Energi Kronis (KEK)';
                    $penjelasanLILA = 'LILA Anda di bawah standar. Risiko KEK tinggi, perlu peningkatan asupan energi dan protein.';
                } else {
                    $statusLILA = 'Normal';
                    $penjelasanLILA = 'LILA Anda normal, status gizi baik.';
                }

                $status['dariLILA'] = [
                    'metode' => 'LILA Wanita Dewasa',
                    'nilai' => $lila,
                    'status' => $statusLILA,
                    'penjelasan' => $penjelasanLILA,
                    'cutoff' => '< 23.5 cm = KEK'
                ];
            } elseif ($jenisKelamin === 'pria') {
                if ($lila < 23.0) {
                    $statusLILA = 'Malnutrisi';
                    $penjelasanLILA = 'LILA Anda di bawah standar. Indikasi malnutrisi, perlu evaluasi gizi lebih lanjut.';
                } else {
                    $statusLILA = 'Normal';
                    $penjelasanLILA = 'LILA Anda normal, status gizi baik.';
                }

                $status['dariLILA'] = [
                    'metode' => 'LILA Pria Dewasa',
                    'nilai' => $lila,
                    'status' => $statusLILA,
                    'penjelasan' => $penjelasanLILA,
                    'cutoff' => '< 23.0 cm = Malnutrisi'
                ];
            }

            // Penilaian LILA untuk lansia (≥60 tahun)
            if ($umur >= 60) {
                if ($lila < 22.0) {
                    $statusLansiaLILA = 'Malnutrisi';
                    $penjelasanLansiaLILA = 'LILA menunjukkan risiko malnutrisi pada lansia. Perlu intervensi gizi segera.';
                } elseif ($lila < 24.0) {
                    $statusLansiaLILA = 'Risiko Malnutrisi';
                    $penjelasanLansiaLILA = 'LILA menunjukkan risiko malnutrisi. Tingkatkan asupan protein dan energi.';
                } else {
                    $statusLansiaLILA = 'Normal';
                    $penjelasanLansiaLILA = 'LILA normal untuk lansia, status gizi baik.';
                }

                $status['lansiaLILA'] = [
                    'nilai' => $lila,
                    'status' => $statusLansiaLILA,
                    'penjelasan' => $penjelasanLansiaLILA
                ];
            }
        }

        // Penilaian Lingkar Betis untuk lansia
        if (!empty($data['lingkarBetis']) && $data['umur'] >= 60) {
            $lingkarBetis = $data['lingkarBetis'];

            if ($lingkarBetis < 31.0) {
                $statusBetis = 'Risiko Sarcopenia';
                $penjelasanBetis = 'Lingkar betis rendah, risiko kehilangan massa otot (sarcopenia). Tingkatkan asupan protein dan latihan kekuatan.';
            } else {
                $statusBetis = 'Normal';
                $penjelasanBetis = 'Lingkar betis normal, massa otot baik untuk lansia.';
            }

            $status['lansiaLingkarBetis'] = [
                'nilai' => $lingkarBetis,
                'status' => $statusBetis,
                'penjelasan' => $penjelasanBetis,
                'cutoff' => '< 31 cm = Risiko Sarcopenia'
            ];
        }

        // Penilaian untuk anak berdasarkan Permenkes No 2/2020
        if ($data['umur'] < 18) {
            $imt = $this->calculateIMT($data['tinggi'], $data['berat']);
            
            // Hitung persentase berat badan terhadap usia
            $bbIdeal = $this->calculateIdealWeight($data['tinggi'], $data['jenisKelamin'], $data['umur']);
            $persenBB = ($data['berat'] / $bbIdeal['broca']) * 100;

            if ($persenBB < 70) {
                $statusBBU = 'Gizi Buruk';
                $rekomendasiBBU = 'Segera konsultasi ke dokter/ahli gizi untuk penanganan gizi buruk.';
            } elseif ($persenBB < 80) {
                $statusBBU = 'Gizi Kurang';
                $rekomendasiBBU = 'Tingkatkan asupan makanan bergizi tinggi kalori dan protein.';
            } elseif ($persenBB <= 110) {
                $statusBBU = 'Gizi Baik';
                $rekomendasiBBU = 'Pertahankan pola makan sehat dan seimbang.';
            } elseif ($persenBB <= 120) {
                $statusBBU = 'Berisiko Gizi Lebih';
                $rekomendasiBBU = 'Kontrol asupan kalori dan tingkatkan aktivitas fisik.';
            } else {
                $statusBBU = 'Gizi Lebih/Obesitas';
                $rekomendasiBBU = 'Konsultasi untuk program penurunan berat badan yang aman untuk anak.';
            }

            $status['permenkes'] = [
                'persenBB' => round($persenBB, 1),
                'statusBBU' => $statusBBU,
                'imt' => $imt,
                'rekomendasi' => $rekomendasiBBU
            ];
        }

        return $status;
    }

    /**
     * Hitung Berat Badan Ideal
     */
    private function calculateIdealWeight($tinggi, $jenisKelamin, $umur)
    {
        // Rumus Broca
        if ($tinggi <= 150) {
            $broca = ($tinggi - 100) * 1.0;
        } elseif ($tinggi <= 160) {
            $broca = ($tinggi - 100) * 0.9;
        } else {
            $broca = ($tinggi - 100) * ($jenisKelamin === 'pria' ? 0.9 : 0.85);
        }

        // Rumus Devine (untuk dewasa)
        if ($jenisKelamin === 'pria') {
            $devine = 50 + (2.3 * (($tinggi / 2.54) - 60));
        } else {
            $devine = 45.5 + (2.3 * (($tinggi / 2.54) - 60));
        }

        // Rumus Hamwi
        if ($jenisKelamin === 'pria') {
            $hamwi = 48 + (2.7 * (($tinggi / 2.54) - 60));
        } else {
            $hamwi = 45.5 + (2.2 * (($tinggi / 2.54) - 60));
        }

        $rataRata = ($broca + $devine + $hamwi) / 3;

        return [
            'broca' => round($broca, 1),
            'devine' => round($devine, 1),
            'hamwi' => round($hamwi, 1),
            'rataRata' => round($rataRata, 1),
            'range' => [
                'min' => round($rataRata * 0.9, 1),
                'max' => round($rataRata * 1.1, 1)
            ]
        ];
    }

    /**
     * Hitung Lean Body Mass (Berat Badan Kering)
     */
    private function calculateLeanBodyMass($data)
    {
        $tinggi = $data['tinggi'];
        $berat = $data['berat'];
        $jenisKelamin = $data['jenisKelamin'];

        // Rumus Boer
        if ($jenisKelamin === 'pria') {
            $boer = (0.407 * $berat) + (0.267 * $tinggi) - 19.2;
        } else {
            $boer = (0.252 * $berat) + (0.473 * $tinggi) - 48.3;
        }

        // Rumus Hume
        if ($jenisKelamin === 'pria') {
            $hume = (0.32810 * $berat) + (0.33929 * $tinggi) - 29.5336;
        } else {
            $hume = (0.29569 * $berat) + (0.41813 * $tinggi) - 43.2933;
        }

        $rataRata = ($boer + $hume) / 2;

        return [
            'boer' => round($boer, 1),
            'hume' => round($hume, 1),
            'rataRata' => round($rataRata, 1),
            'penjelasan' => 'Berat badan tanpa lemak (massa otot, tulang, organ). Penting untuk menentukan kebutuhan protein dan energi.'
        ];
    }

    /**
     * Hitung BMR (Basal Metabolic Rate)
     */
    private function calculateBMR($data)
    {
        $berat = $data['berat'];
        $tinggi = $data['tinggi'];
        $umur = $data['umur'];
        $jenisKelamin = $data['jenisKelamin'];

        // Rumus Harris-Benedict
        if ($jenisKelamin === 'pria') {
            $bmr = 66.5 + (13.75 * $berat) + (5.003 * $tinggi) - (6.75 * $umur);
        } else {
            $bmr = 655.1 + (9.563 * $berat) + (1.850 * $tinggi) - (4.676 * $umur);
        }

        return round($bmr);
    }

    /**
     * Hitung TDEE (Total Daily Energy Expenditure)
     */
    private function calculateTDEE($bmr, $activityLevel = 'moderate')
    {
        $activityFactors = [
            'sedentary' => 1.2,    // Sedikit/tidak ada olahraga
            'light' => 1.375,       // Olahraga ringan 1-3 hari/minggu
            'moderate' => 1.55,     // Olahraga sedang 3-5 hari/minggu
            'active' => 1.725,      // Olahraga berat 6-7 hari/minggu
            'very_active' => 1.9    // Olahraga sangat berat
        ];

        $factor = $activityFactors[$activityLevel] ?? 1.55;
        return round($bmr * $factor);
    }

    /**
     * Hitung kebutuhan gizi harian
     */
    private function calculateNutritionNeeds($tdee, $data)
    {
        // Distribusi makronutrien standar
        $carbPercentage = 0.55;  // 55% dari total kalori
        $proteinPercentage = 0.15; // 15% dari total kalori
        $fatPercentage = 0.30;   // 30% dari total kalori

        // Adjust untuk kondisi khusus
        if (!empty($data['penyakit'])) {
            $penyakit = strtolower($data['penyakit']);
            
            if (strpos($penyakit, 'diabet') !== false) {
                // Untuk diabetes: kurangi karbo, tingkatkan protein
                $carbPercentage = 0.45;
                $proteinPercentage = 0.20;
                $fatPercentage = 0.35;
            }
            
            if (strpos($penyakit, 'ginjal') !== false) {
                // Untuk penyakit ginjal: batasi protein
                $carbPercentage = 0.60;
                $proteinPercentage = 0.10;
                $fatPercentage = 0.30;
            }
        }

        // Hitung kalori per makronutrien
        $carbCalories = $tdee * $carbPercentage;
        $proteinCalories = $tdee * $proteinPercentage;
        $fatCalories = $tdee * $fatPercentage;

        // Konversi ke gram (karbo=4 kkal/g, protein=4 kkal/g, lemak=9 kkal/g)
        $carbGrams = round($carbCalories / 4);
        $proteinGrams = round($proteinCalories / 4);
        $fatGrams = round($fatCalories / 9);

        return [
            'totalKalori' => $tdee,
            'karbohidrat' => [
                'gram' => $carbGrams,
                'kalori' => round($carbCalories),
                'persentase' => $carbPercentage * 100
            ],
            'protein' => [
                'gram' => $proteinGrams,
                'kalori' => round($proteinCalories),
                'persentase' => $proteinPercentage * 100
            ],
            'lemak' => [
                'gram' => $fatGrams,
                'kalori' => round($fatCalories),
                'persentase' => $fatPercentage * 100
            ]
        ];
    }

    /**
     * Generate rencana makan harian
     */
    private function generateMealPlan($kebutuhanGizi, $data)
    {
        $totalKalori = $kebutuhanGizi['totalKalori'];
        
        // Distribusi kalori per waktu makan
        $distribusi = [
            'sarapan' => 0.25,      // 25%
            'snackPagi' => 0.10,    // 10%
            'makanSiang' => 0.30,   // 30%
            'snackSore' => 0.10,    // 10%
            'makanMalam' => 0.25    // 25%
        ];

        $rencanaMakan = [];

        foreach ($distribusi as $waktu => $persentase) {
            $kaloriWaktu = round($totalKalori * $persentase);
            $karboWaktu = round($kebutuhanGizi['karbohidrat']['gram'] * $persentase);
            $proteinWaktu = round($kebutuhanGizi['protein']['gram'] * $persentase);
            $lemakWaktu = round($kebutuhanGizi['lemak']['gram'] * $persentase);

            $rencanaMakan[$waktu] = [
                'kalori' => $kaloriWaktu,
                'karbohidrat' => $karboWaktu,
                'protein' => $proteinWaktu,
                'lemak' => $lemakWaktu,
                'menu' => $this->generateMenuForMeal($waktu, $kaloriWaktu, $karboWaktu, $proteinWaktu, $lemakWaktu, $data)
            ];
        }

        return $rencanaMakan;
    }

    /**
     * Generate menu untuk setiap waktu makan
     */
    private function generateMenuForMeal($waktu, $kalori, $karbo, $protein, $lemak, $data)
    {
        $menu = [];
        $isDiabetic = !empty($data['penyakit']) && strpos(strtolower($data['penyakit']), 'diabet') !== false;
        $isHypertension = !empty($data['penyakit']) && (strpos(strtolower($data['penyakit']), 'hipertensi') !== false || strpos(strtolower($data['penyakit']), 'darah tinggi') !== false);
        $isGout = !empty($data['penyakit']) && (strpos(strtolower($data['penyakit']), 'asam urat') !== false || strpos(strtolower($data['penyakit']), 'gout') !== false);

        switch ($waktu) {
            case 'sarapan':
                $penukarKarbo = max(1, round($karbo / 40));
                $penukarProtein = max(1, round($protein / 7));
                
                $menu[] = [
                    'golongan' => 'Karbohidrat',
                    'bahan' => 'Nasi putih',
                    'porsi' => '¾ gelas',
                    'jumlah' => $penukarKarbo,
                    'catatan' => "$penukarKarbo penukar (" . ($penukarKarbo * 40) . "g karbo)"
                ];

                $menu[] = [
                    'golongan' => 'Protein Hewani',
                    'bahan' => $isGout ? 'Telur ayam rebus' : 'Telur ayam',
                    'porsi' => '1 butir',
                    'jumlah' => $penukarProtein,
                    'catatan' => "$penukarProtein penukar (" . ($penukarProtein * 7) . "g protein)"
                ];

                $menu[] = [
                    'golongan' => 'Sayuran',
                    'bahan' => 'Bayam / Kangkung',
                    'porsi' => '1 gelas',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (5g karbo, 1g protein)'
                ];

                $menu[] = [
                    'golongan' => 'Buah',
                    'bahan' => $isDiabetic ? 'Apel / Pepaya' : 'Pisang / Pepaya',
                    'porsi' => '1 buah sedang',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (12g karbo)'
                ];

                $menu[] = [
                    'golongan' => 'Susu',
                    'bahan' => 'Susu rendah lemak',
                    'porsi' => '1 gelas (200ml)',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (7g protein, 10g karbo)'
                ];

                $penukarMinyak = max(1, round($lemak / 10));
                $menu[] = [
                    'golongan' => 'Minyak/Lemak',
                    'bahan' => 'Minyak sayur untuk memasak',
                    'porsi' => '1 sdt',
                    'jumlah' => $penukarMinyak,
                    'catatan' => "$penukarMinyak penukar untuk memasak"
                ];
                break;

            case 'snackPagi':
                $menu[] = [
                    'golongan' => 'Buah',
                    'bahan' => $isDiabetic ? 'Jeruk / Apel' : 'Pisang / Apel',
                    'porsi' => '1 buah',
                    'jumlah' => 2,
                    'catatan' => '2 penukar (24g karbo)'
                ];
                break;

            case 'makanSiang':
                $penukarKarbo = max(2, round($karbo / 40));
                $penukarProteinHewani = max(2, round($protein / 14));
                
                $menu[] = [
                    'golongan' => 'Karbohidrat',
                    'bahan' => 'Nasi putih',
                    'porsi' => '¾ gelas',
                    'jumlah' => $penukarKarbo,
                    'catatan' => "$penukarKarbo penukar (" . ($penukarKarbo * 40) . "g karbo)"
                ];

                $proteinSource = $isGout ? 'Daging ayam tanpa kulit' : 'Ayam / Ikan segar';
                $menu[] = [
                    'golongan' => 'Protein Hewani',
                    'bahan' => $proteinSource,
                    'porsi' => '1 potong sedang',
                    'jumlah' => $penukarProteinHewani,
                    'catatan' => "$penukarProteinHewani penukar (" . ($penukarProteinHewani * 7) . "g protein)"
                ];

                $menu[] = [
                    'golongan' => 'Protein Nabati',
                    'bahan' => 'Tempe / Tahu',
                    'porsi' => '2 potong sedang',
                    'jumlah' => 2,
                    'catatan' => '2 penukar (10g protein, 14g karbo)'
                ];

                $menu[] = [
                    'golongan' => 'Sayuran',
                    'bahan' => 'Wortel + Brokoli',
                    'porsi' => '1 gelas',
                    'jumlah' => 2,
                    'catatan' => '2 porsi sayur berbeda'
                ];

                $menu[] = [
                    'golongan' => 'Buah',
                    'bahan' => 'Jeruk / Semangka',
                    'porsi' => '1 porsi',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (12g karbo)'
                ];

                $penukarMinyak = max(2, round($lemak / 10));
                $menu[] = [
                    'golongan' => 'Minyak/Lemak',
                    'bahan' => 'Minyak untuk memasak',
                    'porsi' => '1 sdt',
                    'jumlah' => $penukarMinyak,
                    'catatan' => "$penukarMinyak penukar untuk tumis/goreng"
                ];
                break;

            case 'snackSore':
                $menu[] = [
                    'golongan' => 'Snack',
                    'bahan' => 'Oatmeal / Roti gandum',
                    'porsi' => '1 porsi',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (40g karbo)'
                ];

                $menu[] = [
                    'golongan' => 'Susu',
                    'bahan' => 'Yogurt rendah lemak',
                    'porsi' => '1 gelas',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (7g protein, 10g karbo)'
                ];
                break;

            case 'makanMalam':
                $penukarKarbo = max(2, round($karbo / 40));
                $penukarProtein = max(2, round($protein / 7));
                
                $menu[] = [
                    'golongan' => 'Karbohidrat',
                    'bahan' => 'Nasi putih / Kentang',
                    'porsi' => '¾ gelas',
                    'jumlah' => $penukarKarbo,
                    'catatan' => "$penukarKarbo penukar (" . ($penukarKarbo * 40) . "g karbo)"
                ];

                $proteinMalam = $isGout ? 'Ikan segar' : 'Ikan / Ayam';
                $menu[] = [
                    'golongan' => 'Protein Hewani',
                    'bahan' => $proteinMalam,
                    'porsi' => '1 potong sedang',
                    'jumlah' => $penukarProtein,
                    'catatan' => "$penukarProtein penukar (" . ($penukarProtein * 7) . "g protein)"
                ];

                $menu[] = [
                    'golongan' => 'Protein Nabati',
                    'bahan' => 'Tahu / Tempe',
                    'porsi' => '1 potong besar',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (5g protein, 7g karbo)'
                ];

                $menu[] = [
                    'golongan' => 'Sayuran',
                    'bahan' => 'Sawi + Wortel',
                    'porsi' => '1 gelas',
                    'jumlah' => 2,
                    'catatan' => '2 porsi sayur berbeda'
                ];

                $menu[] = [
                    'golongan' => 'Buah',
                    'bahan' => 'Melon / Semangka',
                    'porsi' => '1 potong',
                    'jumlah' => 1,
                    'catatan' => '1 penukar (12g karbo)'
                ];

                $penukarMinyak = max(2, round($lemak / 10));
                $menu[] = [
                    'golongan' => 'Minyak/Lemak',
                    'bahan' => 'Minyak untuk memasak',
                    'porsi' => '1 sdt',
                    'jumlah' => $penukarMinyak,
                    'catatan' => "$penukarMinyak penukar untuk memasak"
                ];
                break;
        }

        return $menu;
    }

    /**
     * Estimasi berat badan dari LILA
     */
    private function estimateWeightFromLILA($lila, $jenisKelamin)
    {
        // Rumus estimasi (simplified)
        if ($jenisKelamin === 'pria') {
            $jung = ($lila * 3.5) - 25;
            $powell = ($lila * 4.0) - 30;
        } else {
            $jung = ($lila * 3.3) - 20;
            $powell = ($lila * 3.8) - 25;
        }

        $rataRata = ($jung + $powell) / 2;

        return [
            'estimasi' => [
                'jung' => round($jung, 1),
                'powell' => round($powell, 1),
                'rataRata' => round($rataRata, 1)
            ],
            'penjelasan' => 'Estimasi berat badan berdasarkan lingkar lengan atas. Berguna untuk pasien yang sulit ditimbang.',
            'akurasi' => 'Akurasi ±3-5 kg. Gunakan sebagai estimasi awal, bukan pengganti penimbangan langsung.'
        ];
    }

    /**
     * Estimasi tinggi badan dari ULNA
     */
    private function estimateHeightFromUlna($ulna, $jenisKelamin, $umur, $tinggiAktual)
    {
        if ($jenisKelamin === 'pria') {
            if ($umur < 65) {
                $estimasi = (4.605 * $ulna) + (1.308 * $umur) + 28.003;
            } else {
                $estimasi = (2.117 * $ulna) + (1.474 * $umur) + 75.348;
            }
        } else {
            if ($umur < 65) {
                $estimasi = (4.459 * $ulna) + (1.315 * $umur) + 31.485;
            } else {
                $estimasi = (2.658 * $ulna) + (1.229 * $umur) + 84.475;
            }
        }

        $selisih = $estimasi - $tinggiAktual;

        return [
            'tinggiEstimasi' => round($estimasi, 1),
            'tinggiAktual' => $tinggiAktual,
            'selisih' => round($selisih, 1),
            'penjelasan' => 'Estimasi tinggi badan dari panjang tulang ulna. Berguna untuk pasien yang tidak bisa berdiri.',
            'akurasi' => abs($selisih) <= 5 ? 'Estimasi sangat baik (selisih ≤5 cm)' : 'Estimasi cukup baik (perlu verifikasi)'
        ];
    }

    /**
     * Estimasi tinggi badan dari tinggi lutut
     */
    private function estimateHeightFromKneeHeight($tinggiLutut, $jenisKelamin, $umur, $tinggiAktual)
    {
        if ($jenisKelamin === 'pria') {
            $estimasi = 64.19 - (0.04 * $umur) + (2.02 * $tinggiLutut);
            $metode = 'Rumus Chumlea (Pria)';
        } else {
            $estimasi = 84.88 - (0.24 * $umur) + (1.83 * $tinggiLutut);
            $metode = 'Rumus Chumlea (Wanita)';
        }

        $selisih = $estimasi - $tinggiAktual;

        return [
            'estimasi' => round($estimasi, 1),
            'tinggiAktual' => $tinggiAktual,
            'selisih' => round($selisih, 1),
            'metode' => $metode,
            'penjelasan' => 'Estimasi tinggi badan dari tinggi lutut menggunakan rumus Chumlea. Akurat untuk lansia dan pasien bedridden.'
        ];
    }

    /**
     * Koreksi berat badan untuk amputasi
     */
    private function adjustWeightForAmputation($beratAktual, $jenisAmputasi)
    {
        $persentaseKehilangan = [
            'tangan' => 0.7,
            'lengan_bawah' => 2.3,
            'lengan_atas' => 2.7,
            'seluruh_lengan' => 5.0,
            'kaki' => 1.5,
            'tungkai_bawah' => 5.9,
            'tungkai_atas' => 10.1,
            'seluruh_tungkai' => 16.0
        ];

        $persen = $persentaseKehilangan[$jenisAmputasi] ?? 0;
        $beratHilang = $beratAktual * ($persen / 100);
        $beratKoreksi = $beratAktual / (1 - ($persen / 100));

        return [
            'diperlukan' => true,
            'bbAktual' => $beratAktual,
            'bbKoreksi' => round($beratKoreksi, 1),
            'jenisAmputasi' => ucwords(str_replace('_', ' ', $jenisAmputasi)),
            'persenKehilangan' => $persen,
            'penjelasan' => "Berat badan dikoreksi untuk amputasi {$persen}%. BB koreksi digunakan untuk perhitungan kebutuhan nutrisi."
        ];
    }

    /**
     * Hitung Adjusted Ideal Body Weight untuk obesitas
     */
    private function calculateAdjustedIdealWeight($beratAktual, $beratIdeal)
    {
        // Rumus: IBW + 0.25(ABW - IBW)
        $adjusted = $beratIdeal + (0.25 * ($beratAktual - $beratIdeal));

        return [
            'digunakan' => true,
            'nilai' => round($adjusted, 1),
            'penjelasan' => 'Untuk obesitas, digunakan Adjusted Ideal Body Weight dalam menghitung kebutuhan nutrisi agar tidak berlebihan.'
        ];
    }

    /**
     * Generate rekomendasi
     */
    private function generateRecommendations($results, $data)
    {
        $recommendations = [];
        $imt = $results['imt']['nilai'];
        $status = $results['imt']['status'];

        // Rekomendasi umum berdasarkan IMT
        $rekomendasiIMT = [
            'kategori' => '📊 Rekomendasi Berdasarkan Status Gizi',
            'saran' => []
        ];

        if ($imt < 18.5) {
            $rekomendasiIMT['saran'] = [
                'Tingkatkan asupan kalori harian secara bertahap',
                'Konsumsi makanan tinggi protein (daging, telur, susu, kacang-kacangan)',
                'Makan lebih sering dengan porsi kecil (5-6 kali sehari)',
                'Tambahkan snack sehat di antara waktu makan',
                'Konsultasi dengan ahli gizi untuk program peningkatan berat badan',
                'Cek kesehatan untuk memastikan tidak ada masalah metabolik'
            ];
        } elseif ($imt >= 18.5 && $imt < 25) {
            $rekomendasiIMT['saran'] = [
                'Pertahankan pola makan sehat dan seimbang',
                'Konsumsi 3 kali makan utama dan 2 kali snack',
                'Olahraga teratur minimal 30 menit, 5 hari/minggu',
                'Minum air putih minimal 8 gelas per hari',
                'Perbanyak konsumsi sayur dan buah',
                'Batasi makanan tinggi gula dan lemak jenuh'
            ];
        } else {
            $rekomendasiIMT['saran'] = [
                'Kurangi asupan kalori secara bertahap (defisit 500 kkal/hari)',
                'Tingkatkan aktivitas fisik menjadi 45-60 menit per hari',
                'Hindari makanan tinggi gula, garam, dan lemak',
                'Perbanyak konsumsi sayur, buah, dan protein tanpa lemak',
                'Makan dengan porsi lebih kecil tapi lebih sering',
                'Konsultasi dengan dokter/ahli gizi untuk program penurunan berat badan'
            ];
        }

        $recommendations[] = $rekomendasiIMT;

        // Rekomendasi berdasarkan penyakit
        if (!empty($data['penyakit'])) {
            $penyakit = strtolower($data['penyakit']);
            
            if (strpos($penyakit, 'diabet') !== false) {
                $recommendations[] = [
                    'kategori' => '🩺 Rekomendasi Khusus Diabetes',
                    'kondisi' => 'Diabetes Mellitus',
                    'saran' => [
                        'Batasi konsumsi karbohidrat sederhana (gula, sirup, kue manis)',
                        'Pilih karbohidrat kompleks dengan indeks glikemik rendah',
                        'Makan dalam porsi kecil tapi sering (5-6 kali sehari)',
                        'Hindari buah dengan gula tinggi (pisang raja, mangga sangat matang)',
                        'Perbanyak serat dari sayuran hijau',
                        'Monitor gula darah secara rutin',
                        'Olahraga teratur untuk kontrol gula darah'
                    ]
                ];
            }
            
            if (strpos($penyakit, 'hipertensi') !== false || strpos($penyakit, 'darah tinggi') !== false) {
                $recommendations[] = [
                    'kategori' => '❤️ Rekomendasi Khusus Hipertensi',
                    'kondisi' => 'Hipertensi / Tekanan Darah Tinggi',
                    'saran' => [
                        'Batasi konsumsi garam maksimal 1 sdt (5g) per hari',
                        'Hindari makanan kalengan, olahan, dan fast food',
                        'Perbanyak buah dan sayur tinggi kalium (pisang, alpukat, bayam)',
                        'Kurangi konsumsi kafein',
                        'Hindari makanan dengan label Na+ dan Na++',
                        'Jaga berat badan ideal',
                        'Olahraga aerobik teratur (jalan cepat, berenang)'
                    ]
                ];
            }
            
            if (strpos($penyakit, 'asam urat') !== false || strpos($penyakit, 'gout') !== false) {
                $recommendations[] = [
                    'kategori' => '🦴 Rekomendasi Khusus Asam Urat',
                    'kondisi' => 'Hiperurisemia / Asam Urat',
                    'saran' => [
                        'Hindari makanan tinggi purin (jeroan, otak, hati, ginjal)',
                        'Batasi konsumsi daging merah dan seafood',
                        'Hindari: sarden, kerang, udang, cumi-cumi, kepiting',
                        'Perbanyak minum air putih (2-3 liter per hari)',
                        'Konsumsi produk rendah lemak',
                        'Hindari alkohol',
                        'Perbanyak buah-buahan dan sayuran'
                    ]
                ];
            }
        }

        // Rekomendasi nutrisi detail
        $kebutuhanGizi = $results['kebutuhanGizi'];
        $recommendations[] = [
            'kategori' => '🍎 Kebutuhan Nutrisi Harian',
            'detail' => [
                'Total Kalori' => number_format($kebutuhanGizi['totalKalori']) . ' kkal',
                'Karbohidrat' => $kebutuhanGizi['karbohidrat']['gram'] . 'g (' . round($kebutuhanGizi['karbohidrat']['persentase']) . '%)',
                'Protein' => $kebutuhanGizi['protein']['gram'] . 'g (' . round($kebutuhanGizi['protein']['persentase']) . '%)',
                'Lemak' => $kebutuhanGizi['lemak']['gram'] . 'g (' . round($kebutuhanGizi['lemak']['persentase']) . '%)'
            ],
            'sumber' => [
                'Karbohidrat' => 'Nasi, roti gandum, kentang, ubi, oatmeal, pasta',
                'Protein' => 'Ayam, ikan, telur, tempe, tahu, kacang-kacangan, susu',
                'Lemak Sehat' => 'Minyak zaitun, alpukat, kacang almond, ikan salmon'
            ]
        ];

        // Rekomendasi untuk lansia
        if ($data['umur'] >= 60) {
            $recommendations[] = [
                'kategori' => '👴 Rekomendasi Khusus Lansia',
                'saran' => [
                    'Tingkatkan asupan protein (1.0-1.2 g/kg BB) untuk mencegah sarcopenia',
                    'Konsumsi makanan lunak yang mudah dikunyah dan dicerna',
                    'Perbanyak makanan tinggi kalsium dan vitamin D untuk kesehatan tulang',
                    'Minum air yang cukup meski tidak haus',
                    'Konsumsi makanan tinggi serat untuk mencegah konstipasi',
                    'Makan dalam porsi kecil tapi sering',
                    'Lakukan aktivitas fisik ringan secara teratur'
                ]
            ];
        }

        // Tips umum
        $recommendations[] = [
            'kategori' => '💡 Tips Penting',
            'saran' => [
                'Makan teratur 3 kali sehari dengan 2-3 kali snack',
                'Minum air putih minimal 8 gelas (2 liter) per hari',
                'Variasikan menu untuk nutrisi lengkap',
                'Batasi gula, garam, dan lemak jenuh',
                'Tingkatkan konsumsi sayur dan buah (5 porsi/hari)',
                'Olahraga teratur minimal 150 menit per minggu',
                'Tidur cukup 7-8 jam per malam',
                'Kelola stres dengan baik',
                'Hindari merokok dan alkohol',
                'Konsultasi rutin dengan ahli gizi/dokter'
            ]
        ];

        return $recommendations;
    }
}
