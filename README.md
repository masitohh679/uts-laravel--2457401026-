# UTS Web Development — SMKN 1 Wirausaha

**NIM:** 2457401026  
**Kasus:** digit 6 — tema sekolah, tabel siswa  
**Database:** `uts_2457401026`

Aplikasi Laravel untuk mengelola data siswa SMKN 1 Wirausaha. Aplikasi menyediakan halaman beranda, daftar dan detail siswa, formulir tambah/ubah dengan validasi, serta konfirmasi penghapusan.

## Menjalankan aplikasi

1. Pasang dependensi PHP dengan `composer install`.
2. Salin `.env.example` menjadi `.env`, lalu sesuaikan koneksi MySQL/MariaDB dan pastikan database `uts_2457401026` sudah dibuat.
3. Jalankan `php artisan key:generate`.
4. Buat tabel dan tiga data contoh dengan `php artisan migrate --seed`.
5. Jalankan aplikasi dengan `php artisan serve`.

CSS aplikasi tersedia di `public/css/school.css`; proses build frontend tambahan tidak diperlukan.

## Data siswa

Seeder menyediakan tiga data contoh. Kolom siswa meliputi NIM, nama, kelas, tanggal lahir, nilai rata-rata, status aktif, alamat, dan telepon orang tua. Pilihan kelas mengikuti kasus pada soal: X IPA 1, X IPS 1, dan XI IPA 2.

## Pengujian

Jalankan `php artisan test` untuk menguji halaman dan alur CRUD siswa.
