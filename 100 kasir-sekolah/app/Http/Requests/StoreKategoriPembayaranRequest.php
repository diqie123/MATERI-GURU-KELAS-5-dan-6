<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriPembayaranRequest extends FormRequest
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
        $rules = [
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'nominal_default' => 'required|numeric|min:0',
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|in:ganjil,genap',
            'is_active' => 'boolean',
        ];

        // Jika update, tambahkan pengecualian untuk data yang sedang diupdate
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $kategoriId = $this->route('kategori-pembayaran');
            $rules['nama_kategori'] = 'required|string|max:100|unique:kategori_pembayaran,nama_kategori,' . $kategoriId . ',id,tahun_ajaran,' . $this->tahun_ajaran . ',semester,' . $this->semester;
        } else {
            $rules['nama_kategori'] = 'required|string|max:100|unique:kategori_pembayaran,nama_kategori,NULL,id,tahun_ajaran,' . $this->tahun_ajaran . ',semester,' . $this->semester;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada untuk tahun ajaran dan semester yang dipilih',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
            'nominal_default.required' => 'Nominal default wajib diisi',
            'nominal_default.numeric' => 'Nominal harus berupa angka',
            'nominal_default.min' => 'Nominal minimal 0',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi',
            'tahun_ajaran.max' => 'Tahun ajaran maksimal 20 karakter',
            'semester.required' => 'Semester wajib dipilih',
            'semester.in' => 'Semester harus ganjil atau genap',
            'is_active.boolean' => 'Status aktif harus ya/tidak',
        ];
    }
}
