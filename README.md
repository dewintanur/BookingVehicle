# Panduan Penggunaan Aplikasi MineFleet

## Informasi Penting

### Username dan Password
- **Admin**: 
  - Email: admin@example.com
  - Password: password
  - Email: dewinta21@example.com
  - Password: dewinta21
- **Approver**:
  - Email: approver@example.com
  - Password: password
  - Email: dinadina21@example.com
  - Password: dinadina21 

### Versi Database
- MySQL: 8.0

### Versi PHP
- PHP: 8.2.12

### Framework
- Laravel: 11.0

## Panduan Penggunaan

1. **Instalasi Aplikasi**
   - Clone repository ini ke dalam direktori lokal Anda.
   - Jalankan `composer install` untuk menginstal semua dependensi.
   - Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
   - Jalankan `php artisan key:generate` untuk menghasilkan kunci aplikasi.
   - Jalankan `php artisan migrate` untuk menjalankan migrasi database.

2. **Menjalankan Aplikasi**
   - Jalankan `php artisan serve` untuk memulai server pengembangan.

3. **Penggunaan Aplikasi**
   - Akses aplikasi melalui browser dengan alamat `http://localhost:8000`.
   - Gunakan username dan password yang disediakan di atas untuk login.
   - Ikuti tautan dan akses yang tersedia untuk melakukan manajemen kendaraan, pemesanan, dan lainnya.

4. **Ekspor Data**
   - Untuk mengunduh laporan pemesanan dalam format Excel, gunakan fitur ekspor yang tersedia di aplikasi.

5. **Panduan Tambahan**
   - Untuk bantuan lebih lanjut, silakan lihat dokumentasi atau hubungi tim pengembang.

Terima kasih telah menggunakan aplikasi MineFleet!
