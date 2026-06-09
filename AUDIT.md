# Hasil Audit Kode Aplikasi & Gaps Kelemahan (Berdasarkan PRD)
## Proyek: Website Resmi MES Depok

Setelah melakukan audit mendalam terhadap basis kode (*codebase*) yang ada saat ini, berikut adalah temuan kritis mengenai bug, kerentanan alur kerja, dan fungsionalitas yang masih berupa placeholder (mockup) yang harus segera diperbaiki sebelum aplikasi diluncurkan:

---

## 1. Temuan Kritis & Bug Utama

### 1.1. Error View Hilang (Broken Route `/member/card`)
* **Masalah**: Di `routes/web.php` terdapat rute:
  ```php
  Route::view('/card', 'member.card')->name('member.card');
  ```
  Namun, file `resources/views/member/card.blade.php` **tidak ada sama sekali** di dalam folder proyek. Jika anggota mengakses halaman kartu digital, aplikasi akan langsung mengalami crash dengan error `View [member.card] not found`.
* **Rekomendasi Perbaikan**: Buat berkas `card.blade.php` baru di bawah folder `resources/views/member/` yang memuat layout kartu digital interaktif (dapat meniru gaya kartu di dashboard dengan visualisasi lebih besar).

### 1.2. Alur Approval Anggota Terputus (User & Member Tidak Terhubung)
* **Masalah**: Pada komponen Livewire `MembershipApplicationsManager.php` di method `approve()`, data aplikasi diubah menjadi disetujui, lalu baris baru di tabel `members` dibuat:
  ```php
  Member::create([
      'name' => $app->name,
      'membership_no' => 'MD-'.Str::upper(Str::random(8)),
      'status' => 'active',
  ]);
  ```
  Kolom `user_id` di sini dibiarkan kosong (`null`). Akibatnya:
  1. Pengguna terdaftar yang mendaftar keanggotaan tidak akan pernah terhubung dengan data anggota mereka.
  2. Saat pengguna masuk ke halaman Profil Anggota (`/member/profile`), mereka akan selalu melihat teks: `"Data keanggotaan belum terhubung."` dan KTA digital di dashboard tidak akan menampilkan data asli mereka karena relasi kosong.
* **Rekomendasi Perbaikan**: Cari akun `User` dengan email yang sama dengan pengaju aplikasi keanggotaan. Jika ada, set `user_id` pada model `Member` dan ubah `role` user tersebut dari `public_user` menjadi `member`. Jika user belum mendaftar akun, buatkan akun secara otomatis dengan password acak lalu kirimkan kredensialnya melalui notifikasi email.

### 1.3. Dashboard Portal Anggota Masih Berupa Mockup (Hardcoded)
* **Masalah**: File `resources/views/member/dashboard.blade.php` saat ini sepenuhnya memuat data palsu (hardcoded) statis, seperti:
  * Nomor KTA (`EC-2024-0847`), nama (`Ahmad Rahman`), dan kategori (`Premium Member`).
  * Total Kehadiran (`8`) & Jumlah Sertifikat (`3`).
  * Tabel event terdaftar, list sertifikat, dan list riwayat konsultasi.
  * Tombol aksi seperti "View", "Download", dan "Request Consultation" belum terhubung dengan rute riil apapun.
* **Rekomendasi Perbaikan**: Ubah query dashboard agar mengambil relasi data aktif dari user yang sedang login. Misalnya, relasi `registrations` untuk melihat event yang diikuti, `consultations` untuk melihat riwayat konsultasi, dan data `Member` asli untuk menampilkan KTA dinamis.

### 1.4. Tidak Ada Automated Testing (Uji Otomatis Kosong)
* **Masalah**: Folder `tests/` hanya berisi file contoh bawaan Laravel (`ExampleTest.php`). Tidak ada tes fungsional untuk menguji hak akses middleware peran (role middleware), alur pendaftaran, pembuatan nomor surat otomatis, atau perlindungan berkas rahasia. Hal ini rawan memicu regresi saat aplikasi di-update di masa depan.
* **Rekomendasi Perbaikan**: Buat pengujian fitur menggunakan PHPUnit/Pest untuk memvalidasi otentikasi admin, login Google OAuth bypass, dan pengiriman surat.

---

## 2. Peningkatan Fitur (Enhancements)
* **Avatar Upload**: Form edit profil di `/member/profile` memiliki field nama, email, no HP, organisasi, dan password, namun tidak menyediakan opsi mengunggah berkas foto profil (avatar) padahal kolom database sudah tersedia.
* **Integrasi Socialite (Google Login)**: Di `AuthController.php`, terdapat pengecekan class `Laravel\Socialite\Facades\Socialite`. Pastikan paket composer `laravel/socialite` sudah terinstall sepenuhnya agar tidak memicu fallback error konfigurasi saat dijalankan.
