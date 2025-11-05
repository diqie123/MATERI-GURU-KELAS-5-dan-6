<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaturanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_sekolah' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string|max:500',
            'telepon_sekolah' => 'required|string|max:20',
            'email_sekolah' => 'required|email|max:255',
            'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tahun_ajaran_aktif' => 'required|string|max:20',
            'semester_aktif' => 'required|in:ganjil,genap',
            'nominal_spp_default' => 'required|numeric|min:0',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'nip_kepala_sekolah' => 'required|string|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_sekolah.required' => 'Nama sekolah wajib diisi',
            'nama_sekolah.max' => 'Nama sekolah maksimal 255 karakter',
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi',
            'alamat_sekolah.max' => 'Alamat sekolah maksimal 500 karakter',
            'telepon_sekolah.required' => 'Telepon sekolah wajib diisi',
            'telepon_sekolah.max' => 'Telepon sekolah maksimal 20 karakter',
            'email_sekolah.required' => 'Email sekolah wajib diisi',
            'email_sekolah.email' => 'Format email sekolah tidak valid',
            'email_sekolah.max' => 'Email sekolah maksimal 255 karakter',
            'logo_sekolah.image' => 'Logo sekolah harus berupa gambar',
            'logo_sekolah.mimes' => 'Format logo harus jpeg, png, jpg, atau gif',
            'logo_sekolah.max' => 'Ukuran logo maksimal 2MB',
            'tahun_ajaran_aktif.required' => 'Tahun ajaran aktif wajib diisi',
            'tahun_ajaran_aktif.max' => 'Tahun ajaran aktif maksimal 20 karakter',
            'semester_aktif.required' => 'Semester aktif wajib dipilih',
            'semester_aktif.in' => 'Semester aktif harus ganjil atau genap',
            'nominal_spp_default.required' => 'Nominal SPP default wajib diisi',
            'nominal_spp_default.numeric' => 'Nominal SPP harus berupa angka',
            'nominal_spp_default.min' => 'Nominal SPP minimal 0',
            'nama_kepala_sekolah.required' => 'Nama kepala sekolah wajib diisi',
            'nama_kepala_sekolah.max' => 'Nama kepala sekolah maksimal 255 karakter',
            'nip_kepala_sekolah.required' => 'NIP kepala sekolah wajib diisi',
            'nip_kepala_sekolah.max' => 'NIP kepala sekolah maksimal 50 karakter',
        ];
    }
}
