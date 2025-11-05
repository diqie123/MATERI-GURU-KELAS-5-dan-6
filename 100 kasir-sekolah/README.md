# Aplikasi Kasir Sekolah

Aplikasi manajemen pembayaran sekolah berbasis web yang dibangun dengan Laravel. Sistem ini dirancang untuk memudahkan pengelolaan pembayaran SPP dan keuangan sekolah.

## Fitur Utama

### 🔐 Manajemen User
- Sistem login dengan autentikasi Laravel
- Role-based access control (Admin, Kasir, Siswa)
- Profile management

### 👨‍🎓 Manajemen Siswa
- CRUD data siswa lengkap
- Import data siswa dari Excel
- Search dan filter siswa berdasarkan NISN, nama, email, dan kelas
- Validasi form yang komprehensif

### 🏫 Manajemen Kelas
- Pengelolaan data kelas
- Penempatan siswa per kelas

### 💰 Manajemen Pembayaran
- Kategori pembayaran (SPP, Uang Gedung, Seragam, dll)
- Setting nominal pembayaran per kategori
- Pembayaran bisa diangsur
- History pembayaran siswa

### 📊 Sistem Laporan
- Laporan pembayaran per periode
- Rekap pembayaran per kelas
- Export ke PDF dan Excel

### ⚙️ Pengaturan Sistem
- Pengaturan profil sekolah
- Setting tahun ajaran aktif
- Setting nominal SPP default
- Upload logo sekolah

## Teknologi yang Digunakan

- **Backend**: Laravel 11.x
- **Frontend**: Blade Template, Bootstrap 5, Tailwind CSS
- **Database**: MySQL
- **JavaScript**: Vanilla JS, SweetAlert2
- **Authentication**: Laravel Breeze

## Instalasi

### Persyaratan
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL
- Node.js & NPM

### Langkah-langkah Instalasi

1. Clone repository
```bash
git clone https://github.com/username/kasir-sekolah.git
cd kasir-sekolah
```

2. Install dependencies
```bash
composer install
npm install
```

3. Copy file environment
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Konfigurasi database di file `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kasir_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

6. Jalankan migrasi database
```bash
php artisan migrate --seed
```

7. Buat storage link
```bash
php artisan storage:link
```

8. Jalankan aplikasi
```bash
npm run dev
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## Login Default

**Admin:**
- Email: admin@sekolah.com
- Password: password

## Struktur Database

### Tabel Utama:
- `users` - Data user sistem
- `students` - Data siswa
- `classes` - Data kelas
- `payment_categories` - Kategori pembayaran
- `payment_items` - Item pembayaran
- `transactions` - Transaksi pembayaran
- `transaction_details` - Detail transaksi
- `payment_schedules` - Jadwal pembayaran
- `pengaturan` - Setting sistem

## Kontribusi

Kontribusi sangat dipersilahkan! Silakan fork repository ini dan buat pull request.

## Lisensi

Aplikasi ini open-source dan tersedia di bawah [MIT License](LICENSE).

## Support

Jika Anda menemui masalah atau memiliki pertanyaan, silakan buat issue di repository ini.

---

**Developed with ❤️ for Indonesian Schools**
