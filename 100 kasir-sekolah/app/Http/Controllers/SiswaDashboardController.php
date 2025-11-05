<?php

namespace App\Http\Controllers;

use App\Models\PaymentSchedule;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:siswa']);
    }

    public function index()
    {
        $student = auth()->user()->student;
        
        if (!$student) {
            return view('siswa.dashboard', [
                'tagihanBelumBayar' => 0,
                'totalTagihan' => 0,
                'transaksiTerakhir' => collect(),
                'message' => 'Data siswa belum tersedia. Silakan hubungi admin.'
            ]);
        }

        $tagihanBelumBayar = PaymentSchedule::where('student_id', $student->id)
            ->where('status', 'belum_bayar')
            ->count();

        $totalTagihan = PaymentSchedule::where('student_id', $student->id)
            ->where('status', 'belum_bayar')
            ->sum('nominal');

        $transaksiTerakhir = Transaction::where('student_id', $student->id)
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'tagihanBelumBayar',
            'totalTagihan',
            'transaksiTerakhir'
        ));
    }
}
