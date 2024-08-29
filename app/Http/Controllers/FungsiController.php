<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FungsiController extends Controller
{
    public function index() {
        return view('hitung');
    }

    public function store(Request $request) {
        $OTR = $request->otr; 
        $DP = $request->dp; 
        $jangkaWaktu = $request->jangka_waktu;
        $pokokUtang = $OTR - $DP;
        if ($jangkaWaktu <= 12) {
            $bunga = 12 / 100; // 12%
        } elseif ($jangkaWaktu > 12 && $jangkaWaktu <= 24) {
            $bunga = 14 / 100; // 14%
        } else {
            $bunga = 16.5 / 100; // 16.5%
        }

        $totalPembayaran = $pokokUtang + ($pokokUtang * $bunga);
        $angsuranBulanan = $totalPembayaran / $jangkaWaktu;

        return response()->json([
            'status' => true,
            'data' => $angsuranBulanan
        ]);
    }
}
