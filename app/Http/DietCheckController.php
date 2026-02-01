<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DietCheckController extends Controller
{
    public function index()
    {
        return view('diet.index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric',
            'lila' => 'required|numeric',
            'umur' => 'required|numeric',
            'jenisKelamin' => 'required',
            'aktivitas' => 'required',
        ]);

        $tinggi = $request->tinggi;
        $berat = $request->berat;
        $umur  = $request->umur;
        $lila  = $request->lila;
        $gender = $request->jenisKelamin;
        $aktivitas = $request->aktivitas;
        $diagnosis = strtolower($request->diagnosisMedis ?? '');

        /* ================= BMI ================= */
        $bmi = $berat / pow($tinggi / 100, 2);

        if ($bmi < 18.5) $bmiCategory = 'Kurus (Underweight)';
        elseif ($bmi < 23) $bmiCategory = 'Normal';
        elseif ($bmi < 25) $bmiCategory = 'Overweight';
        elseif ($bmi < 30) $bmiCategory = 'Obesitas I';
        else $bmiCategory = 'Obesitas II';

        /* ================= BMR ================= */
        if ($gender === 'pria') {
            $bmr = 66.5 + (13.75 * $berat) + (5.003 * $tinggi) - (6.75 * $umur);
        } else {
            $bmr = 655.1 + (9.563 * $berat) + (1.850 * $tinggi) - (4.676 * $umur);
        }

        /* ================= TDEE ================= */
        $multiplier = [
            'sedentary' => 1.2,
            'ringan' => 1.375,
            'sedang' => 1.55,
            'berat' => 1.725,
            'sangat-berat' => 1.9
        ];

        $tdee = $bmr * ($multiplier[$aktivitas] ?? 1.2);

        /* ================= Diet Recommendation ================= */
        if (str_contains($diagnosis, 'diabetes')) {
            $diet = ['Diet Diabetes Mellitus', 'Rendah gula, kontrol karbohidrat'];
        } elseif (str_contains($diagnosis, 'hipertensi')) {
            $diet = ['Diet DASH', 'Rendah garam, tinggi mineral'];
        } elseif (str_contains($diagnosis, 'jantung')) {
            $diet = ['Diet Jantung', 'Rendah lemak jenuh'];
        } elseif ($bmi < 18.5) {
            $diet = ['Diet Tinggi Kalori', 'Menambah berat badan'];
        } elseif ($bmi >= 25) {
            $diet = ['Diet Penurunan BB', 'Defisit kalori seimbang'];
        } else {
            $diet = ['Diet Seimbang', 'Mempertahankan berat badan'];
        }

        /* ================= Gizi ================= */
        $protein = round($berat * 1.2, 1);
        $lemak   = round(($tdee * 0.25) / 9, 1);
        $karbo   = round(($tdee * 0.55) / 4, 1);

        /* ================= LILA ================= */
        if ($gender === 'wanita' && $lila < 23.5) {
            $lilaStatus = 'Kurang Gizi (KEK)';
        } elseif ($gender === 'pria' && $lila < 25) {
            $lilaStatus = 'Kurang Gizi';
        } else {
            $lilaStatus = 'Normal';
        }

        return response()->json([
            'bmi' => round($bmi, 1),
            'bmiCategory' => $bmiCategory,
            'bmr' => round($bmr),
            'tdee' => round($tdee),
            'lila' => $lila,
            'lilaStatus' => $lilaStatus,
            'diet' => [
                'type' => $diet[0],
                'description' => $diet[1],
            ],
            'nutrition' => [
                'protein' => $protein,
                'lemak' => $lemak,
                'karbohidrat' => $karbo,
            ]
        ]);
    }
}
