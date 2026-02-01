<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        // Bisa redirect ke about atau buat halaman home tersendiri
        return redirect()->route('about');
    }
    
    /**
     * Display about us page
     */
    public function about()
    {
        return view('about');
    }
    
    /**
     * Display edukasi gizi page
     */
    public function edukasi()
    {
        return view('edukasi');
    }
    
    /**
     * Display dasar gizi page
     */
    public function dasarGizi()
    {
        return view('dasar-gizi');
    }
    
    /**
     * Display cek diet page
     */
    public function cekDiet()
    {
        return view('cek-diet');
    }
    
    /**
     * Calculate diet (optional - jika ingin proses di backend)
     */
    public function calculateDiet(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'usia' => 'required|integer|min:1|max:120',
            'tb' => 'required|numeric|min:50|max:250',
            'bb' => 'required|numeric|min:10|max:300',
            'lila' => 'nullable|numeric|min:10|max:60',
            'aktivitas' => 'required|in:ringan,sedang,berat,sangat_berat',
            'tujuan' => 'required|in:turun,naik,maintain,kesehatan',
        ]);
        
        // Hitung IMT
        $tb_meter = $validated['tb'] / 100;
        $imt = $validated['bb'] / ($tb_meter * $tb_meter);
        
        // Hitung BB Ideal
        if ($validated['gender'] === 'L') {
            $bb_ideal = ($validated['tb'] - 100) - (($validated['tb'] - 100) * 0.1);
        } else {
            $bb_ideal = ($validated['tb'] - 100) - (($validated['tb'] - 100) * 0.15);
        }
        
        // Hitung BMR (Basal Metabolic Rate)
        if ($validated['gender'] === 'L') {
            $bmr = 88.362 + (13.397 * $validated['bb']) + (4.799 * $validated['tb']) - (5.677 * $validated['usia']);
        } else {
            $bmr = 447.593 + (9.247 * $validated['bb']) + (3.098 * $validated['tb']) - (4.330 * $validated['usia']);
        }
        
        // Faktor aktivitas
        $faktor_aktivitas = [
            'ringan' => 1.2,
            'sedang' => 1.55,
            'berat' => 1.725,
            'sangat_berat' => 1.9
        ];
        
        $kebutuhan_energi = $bmr * $faktor_aktivitas[$validated['aktivitas']];
        
        // Sesuaikan dengan tujuan
        if ($validated['tujuan'] === 'turun') {
            $kebutuhan_energi -= 500;
        } elseif ($validated['tujuan'] === 'naik') {
            $kebutuhan_energi += 500;
        }
        
        // Hitung makronutrien
        $protein = ($kebutuhan_energi * 0.15) / 4; // 15% dari total kalori
        $lemak = ($kebutuhan_energi * 0.25) / 9; // 25% dari total kalori
        $karbohidrat = ($kebutuhan_energi * 0.60) / 4; // 60% dari total kalori
        
        $hasil = [
            'imt' => round($imt, 1),
            'bb_ideal' => round($bb_ideal, 1),
            'kebutuhan_energi' => round($kebutuhan_energi),
            'protein' => round($protein),
            'lemak' => round($lemak),
            'karbohidrat' => round($karbohidrat),
        ];
        
        return response()->json($hasil);
    }
}