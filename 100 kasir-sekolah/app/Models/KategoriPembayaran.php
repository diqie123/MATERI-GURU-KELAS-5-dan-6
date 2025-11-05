<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPembayaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'nominal_default',
        'tahun_ajaran',
        'semester',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nominal_default' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get active payment categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get categories by academic year and semester.
     */
    public function scopeByAcademicPeriod($query, $tahunAjaran, $semester)
    {
        return $query->where('tahun_ajaran', $tahunAjaran)->where('semester', $semester);
    }
}
