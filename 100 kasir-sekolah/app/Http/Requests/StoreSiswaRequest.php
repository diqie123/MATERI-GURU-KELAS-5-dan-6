<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
            'nisn' => 'required|string|max:20|unique:siswa',
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:siswa',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
        ];

        // Jika update, tambahkan pengecualian untuk data yang sedang diupdate
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $siswaId = $this->route('siswa');
            $rules['nisn'] = 'required|string|max:20|unique:siswa,nisn,' . $siswaId;
            $rules['email'] = 'required|email|max:255|unique:siswa,email,' . $siswaId;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nisn.required' => 'NISN wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.max' => 'NISN maksimal 20 karakter',
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'kelas_id.required' => 'Kelas wajib dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'no_telp.required' => 'Nomor telepon wajib diisi',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
        ];
    }
}
