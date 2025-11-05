@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Pengaturan Sistem</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_sekolah" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" 
                                           id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $pengaturan->nama_sekolah ?? '') }}" required>
                                    @error('nama_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="logo_sekolah" class="form-label">Logo Sekolah</label>
                                    <input type="file" class="form-control @error('logo_sekolah') is-invalid @enderror" 
                                           id="logo_sekolah" name="logo_sekolah" accept="image/*">
                                    @if($pengaturan->logo_sekolah)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $pengaturan->logo_sekolah) }}" alt="Logo" style="max-height: 100px;">
                                        </div>
                                    @endif
                                    @error('logo_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="alamat_sekolah" class="form-label">Alamat Sekolah <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat_sekolah') is-invalid @enderror" 
                                              id="alamat_sekolah" name="alamat_sekolah" rows="3" required>{{ old('alamat_sekolah', $pengaturan->alamat_sekolah ?? '') }}</textarea>
                                    @error('alamat_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telepon_sekolah" class="form-label">Telepon Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('telepon_sekolah') is-invalid @enderror" 
                                           id="telepon_sekolah" name="telepon_sekolah" value="{{ old('telepon_sekolah', $pengaturan->telepon_sekolah ?? '') }}" required>
                                    @error('telepon_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email_sekolah" class="form-label">Email Sekolah <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email_sekolah') is-invalid @enderror" 
                                           id="email_sekolah" name="email_sekolah" value="{{ old('email_sekolah', $pengaturan->email_sekolah ?? '') }}" required>
                                    @error('email_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tahun_ajaran_aktif" class="form-label">Tahun Ajaran Aktif <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tahun_ajaran_aktif') is-invalid @enderror" 
                                           id="tahun_ajaran_aktif" name="tahun_ajaran_aktif" value="{{ old('tahun_ajaran_aktif', $pengaturan->tahun_ajaran_aktif ?? '') }}" required>
                                    @error('tahun_ajaran_aktif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="semester_aktif" class="form-label">Semester Aktif <span class="text-danger">*</span></label>
                                    <select class="form-control @error('semester_aktif') is-invalid @enderror" id="semester_aktif" name="semester_aktif" required>
                                        <option value="">Pilih Semester</option>
                                        <option value="ganjil" {{ old('semester_aktif', $pengaturan->semester_aktif ?? '') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                        <option value="genap" {{ old('semester_aktif', $pengaturan->semester_aktif ?? '') == 'genap' ? 'selected' : '' }}>Genap</option>
                                    </select>
                                    @error('semester_aktif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nominal_spp_default" class="form-label">Nominal SPP Default <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('nominal_spp_default') is-invalid @enderror" 
                                           id="nominal_spp_default" name="nominal_spp_default" value="{{ old('nominal_spp_default', $pengaturan->nominal_spp_default ?? '') }}" required min="0">
                                    @error('nominal_spp_default')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_kepala_sekolah" class="form-label">Nama Kepala Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_kepala_sekolah') is-invalid @enderror" 
                                           id="nama_kepala_sekolah" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $pengaturan->nama_kepala_sekolah ?? '') }}" required>
                                    @error('nama_kepala_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip_kepala_sekolah" class="form-label">NIP Kepala Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nip_kepala_sekolah') is-invalid @enderror" 
                                           id="nip_kepala_sekolah" name="nip_kepala_sekolah" value="{{ old('nip_kepala_sekolah', $pengaturan->nip_kepala_sekolah ?? '') }}" required>
                                    @error('nip_kepala_sekolah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection