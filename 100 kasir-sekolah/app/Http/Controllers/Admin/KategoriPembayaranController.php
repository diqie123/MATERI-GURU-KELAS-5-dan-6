<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPembayaran;
use App\Http\Requests\StoreKategoriPembayaranRequest;
use Illuminate\Http\Request;

class KategoriPembayaranController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriPembayaran = KategoriPembayaran::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kategori-pembayaran.index', compact('kategoriPembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriPembayaranRequest $request)
    {
        KategoriPembayaran::create($request->validated());
        return redirect()->route('admin.kategori-pembayaran.index')->with('success', 'Kategori pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriPembayaran::findOrFail($id);
        return view('admin.kategori-pembayaran.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriPembayaran::findOrFail($id);
        return view('admin.kategori-pembayaran.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreKategoriPembayaranRequest $request, string $id)
    {
        $kategori = KategoriPembayaran::findOrFail($id);
        $kategori->update($request->validated());
        return redirect()->route('admin.kategori-pembayaran.index')->with('success', 'Kategori pembayaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori = KategoriPembayaran::findOrFail($id);
            $nama = $kategori->nama_kategori;
            $kategori->delete();

            return redirect()->route('admin.kategori-pembayaran.index')->with('success', "Kategori pembayaran '{$nama}' berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori-pembayaran.index')->with('error', 'Gagal menghapus kategori pembayaran: ' . $e->getMessage());
        }
    }
}
