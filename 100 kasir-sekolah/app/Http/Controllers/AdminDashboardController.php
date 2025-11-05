<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $totalSiswa = Student::count();
        $totalKasir = User::where('role', 'kasir')->count();
        $totalTransaksi = Transaction::count();
        $totalPendapatan = Transaction::where('status', 'completed')->sum('total_bayar');
        $transaksiTerbaru = Transaction::with(['student', 'kasir'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalKasir',
            'totalTransaksi',
            'totalPendapatan',
            'transaksiTerbaru'
        ));
    }
}
