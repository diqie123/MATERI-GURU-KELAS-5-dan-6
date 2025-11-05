<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Http\Requests\StorePengaturanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Show the settings form
     */
    public function index()
    {
        $pengaturan = Pengaturan::getActiveSettings();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    /**
     * Update settings
     */
    public function update(StorePengaturanRequest $request)
    {
        $pengaturan = Pengaturan::getActiveSettings();

        // Handle logo upload
        if ($request->hasFile('logo_sekolah')) {
            // Delete old logo if exists
            if ($pengaturan->logo_sekolah) {
                Storage::disk('public')->delete($pengaturan->logo_sekolah);
            }

            $logoPath = $request->file('logo_sekolah')->store('logos', 'public');
            $pengaturan->logo_sekolah = $logoPath;
        }

        // Update other settings
        $pengaturan->update($request->except('logo_sekolah'));

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
