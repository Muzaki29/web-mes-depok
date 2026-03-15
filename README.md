# Website Resmi MES Depok

![MES Depok Banner](https://via.placeholder.com/800x200?text=Masyarakat+Ekonomi+Syariah+Depok)

Repositori resmi untuk website Masyarakat Ekonomi Syariah (MES) Kota Depok. Website ini berfungsi sebagai pusat informasi program kerja, pendaftaran anggota, berita terkini, dan manajemen organisasi.

## 🗓️ Update Terakhir

**2026-03-16**
- Lokalisasi admin ke Bahasa Indonesia (label, tombol, notifikasi).
- Perapihan responsivitas tabel/form admin untuk tampilan mobile.
- Ekspor data Konsultasi ke CSV (menu Konsultasi & Laporan).

## 🚀 Fitur Utama

- **Halaman Publik**: Beranda modern, Profil Organisasi, Berita & Artikel, Agenda Kegiatan, Program Kerja.
- **Sistem Keanggotaan**: Pendaftaran anggota online, Dashboard anggota, Kartu Anggota Digital.
- **Dashboard Admin**:
  - Manajemen Anggota (CRUD, Verifikasi).
  - Manajemen Program Kerja (Baru).
  - Manajemen Berita & Artikel.
  - Manajemen Dokumen & Arsip.
  - Statistik & Laporan Kegiatan.
- **Autentikasi**: Login Email & Google OAuth (Opsional).

## 🛠️ Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database

## 📦 Instalasi Cepat

1. **Clone Repositori**
   ```bash
   git clone https://github.com/Muzaki29/web-mes-depok.git
   cd web-mes-depok
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin `.env.example` menjadi `.env` dan sesuaikan database:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database & Seeding**
   ```bash
   php artisan migrate --seed
   ```
   *Note: Ini akan membuat akun admin default dan data program awal.*

5. **Link Storage (Penting untuk Gambar)**
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Aplikasi**
   ```bash
   npm run build
   php artisan serve
   ```
   Akses di `http://localhost:8000`.

## 🔐 Akun Default (Development)

**Super Admin**
- Email: `admin@mesdepok.org`
- Password: `password`

**Anggota Test**
- Email: `member@example.com`
- Password: `password`

## 📚 Dokumentasi Lengkap

Lihat file [DOCUMENTATION.md](DOCUMENTATION.md) untuk panduan teknis lebih detail mengenai struktur folder, arsitektur, dan cara pengembangan fitur baru.

---
*Dikembangkan oleh Tim IT MES Depok*
