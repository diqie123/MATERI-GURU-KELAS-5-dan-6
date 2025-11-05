<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    
    protected $fillable = [
        'nama_sekolah',
        'alamat_sekolah',
        'telepon_sekolah',
        'email_sekolah',
        'logo_sekolah',
        'tahun_ajaran_aktif',
        'semester_aktif',
        'nominal_spp_default',
        'nama_kepala_sekolah',
        'nip_kepala_sekolah',
    ];

    protected $casts = [
        'nominal_spp_default' => 'decimal:2',
    ];

    /**
     * Get the active settings (singleton pattern)
     */
    public static function getActiveSettings()
    {
        return self::first() ?? self::createDefaultSettings();
    }

    /**
     * Create default settings
     */
    public static function createDefaultSettings()
    {
        return self::create([
            'nama_sekolah' => 'Nama Sekolah',
            'tahun_ajaran_aktif' => '2024/2025',
            'semester_aktif' => 'Ganjil',
            'nominal_spp_default' => 0,
        ]);
    }
}
