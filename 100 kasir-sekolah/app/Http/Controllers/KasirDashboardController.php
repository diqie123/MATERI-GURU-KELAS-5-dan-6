<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class KasirDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:kasir']);
    }

    public function index()
    {
        $transaksiHariIni = Transaction::whereDate('tanggal_transaksi', today())
            ->where('kasir_id', auth()->id())
            ->count();
        
        $totalPendapatanHariIni = Transaction::whereDate('tanggal_transaksi', today())
            ->where('kasir_id', auth()->id())
            ->where('status', 'completed')
            ->sum('total_bayar');

        $transaksiTerbaru = Transaction::with('student')
            ->where('kasir_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('kasir.dashboard', compact(
            'transaksiHariIni',
            'totalPendapatanHariIni',
            'transaksiTerbaru'
        ));
    }
}
