# Dokumentasi Teknis Website MES Depok

Dokumen ini berisi informasi teknis lengkap mengenai arsitektur, instalasi, struktur folder, dan panduan pengembangan Website MES Depok.

## 1. Ikhtisar Proyek
Website ini adalah platform digital untuk Masyarakat Ekonomi Syariah (MES) Depok yang berfungsi sebagai:
- Portal informasi publik (Berita, Program, Event).
- Sistem manajemen keanggotaan (Pendaftaran, Dashboard Anggota).
- Dashboard Admin untuk pengelolaan konten dan data anggota.

**Teknologi Utama:**
- **Framework:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade Templates + Tailwind CSS (via CDN/Vite)
- **Authentication:** Laravel Breeze / Custom Auth (Email & Google OAuth)

## 2. Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database

## 3. Instalasi & Konfigurasi

### Langkah 1: Clone & Install Dependencies
```bash
git clone https://github.com/Muzaki29/web-mes-depok.git
cd web-mes-depok
composer install
npm install
```

### Langkah 2: Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
```bash
cp .env.example .env
php artisan key:generate
```
Edit `.env`:
```env
DB_DATABASE=web_mes_depok
DB_USERNAME=root
DB_PASSWORD=

# Google OAuth (Opsional)
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### Langkah 3: Migrasi Database & Seeding
Jalankan perintah berikut untuk membuat tabel dan mengisi data awal (User Admin, Program Dummy, dll):
```bash
php artisan migrate --seed
```
*Note: Jika ingin mengisi data dummy program saja, gunakan `php artisan db:seed --class=ProgramSeeder`*

### Langkah 4: Jalankan Aplikasi
```bash
npm run build
php artisan serve
```
Akses website di `http://localhost:8000`.

## 4. Struktur Direktori Utama

- **app/Http/Controllers/Admin**: Kontroller untuk dashboard admin (Program, Artikel, Member, dll).
- **app/Http/Controllers/PublicSite**: Kontroller untuk halaman publik.
- **app/Models**: Model Eloquent (Program, Article, Member, Event, dll).
- **database/migrations**: Definisi skema database.
- **resources/views/admin**: View Blade untuk halaman admin.
- **resources/views/public**: View Blade untuk halaman publik.
- **routes/web.php**: Definisi routing aplikasi.

## 5. Fitur Utama & Panduan Penggunaan

### A. Manajemen Program (Baru)
Fitur untuk mengelola daftar program kerja MES Depok.
- **Lokasi Admin:** Menu "Programs" di sidebar admin.
- **Fungsi:** Tambah, Edit, Hapus, Aktifkan/Nonaktifkan Program.
- **Tampilan Publik:** `/programs` (Daftar) dan `/programs/{slug}` (Detail).
- **Teknis:** Menggunakan `ProgramController` dan tabel `programs`.

### B. Manajemen Berita/Artikel
- **Lokasi Admin:** Menu "Articles".
- **Fungsi:** Editor konten berita.
- **Tampilan Publik:** `/news`.

### C. Keanggotaan
- **Pendaftaran:** `/membership` (Publik).
- **Manajemen:** Menu "Members" & "Membership Applications" (Admin).
- **Dashboard Anggota:** `/member/dashboard`.

## 6. Troubleshooting Umum

**Error 500 pada Admin Dashboard:**
- Pastikan tabel database lengkap (`php artisan migrate`).
- Pastikan cache view bersih: `php artisan view:clear`.
- Pastikan storage link terbuat: `php artisan storage:link` untuk menampilkan gambar thumbnail.

**Gambar Tidak Muncul:**
- Jalankan `php artisan storage:link`.
- Pastikan folder `storage/app/public` memiliki izin tulis.

## 7. Catatan Pengembangan
- Gunakan `php artisan make:model NamaModel -mcr` untuk membuat fitur baru.
- Selalu validasi input di Controller.
- Gunakan `Blade Components` untuk elemen UI yang berulang (Button, Card, dll).

---
*Dibuat pada: 10 Maret 2026*
