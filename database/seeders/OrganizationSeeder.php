<?php

namespace Database\Seeders;

use App\Models\OrganizationMember;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        OrganizationMember::truncate();

        $period = '2026-2029';
        $sort = 0;

        $data = [
            // ===== A. DEWAN PEMBINA =====
            ['name' => 'Walikota Depok', 'position' => 'Ketua', 'division' => 'Dewan Pembina'],
            ['name' => 'Abdul Aziz Mukhtadi', 'position' => 'Sekretaris', 'division' => 'Dewan Pembina'],
            ['name' => 'Ketua DPRD Depok', 'position' => 'Anggota', 'division' => 'Dewan Pembina'],
            ['name' => 'Wakil Walikota Depok', 'position' => 'Anggota', 'division' => 'Dewan Pembina'],
            ['name' => 'Ketua MUI Depok', 'position' => 'Anggota', 'division' => 'Dewan Pembina'],
            ['name' => 'Ketua NU Depok', 'position' => 'Anggota', 'division' => 'Dewan Pembina'],
            ['name' => 'Ketua Muhammadiyah Depok', 'position' => 'Anggota', 'division' => 'Dewan Pembina'],
            ['name' => 'Dr. Ahmad Badrudin, Lc, MA', 'position' => 'Anggota', 'division' => 'Dewan Pembina'],

            // ===== B. DEWAN PAKAR =====
            ['name' => 'Dr. Yustiar Gunawan', 'position' => 'Ketua', 'division' => 'Dewan Pakar'],
            ['name' => 'Dr. Sigit Pramono, SE, M.Sc., Ph.D., CPA, CA', 'position' => 'Anggota', 'division' => 'Dewan Pakar'],
            ['name' => 'Itsnan, LC, MSi', 'position' => 'Anggota', 'division' => 'Dewan Pakar'],

            // ===== C. BADAN PENGURUS HARIAN =====
            ['name' => 'Dr. Edi Purwanto, SE, MM', 'position' => 'Ketua Umum', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Dr. Hadiyawarman', 'position' => 'Sekretaris Umum', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Abudzar Al Ghifari', 'position' => 'Wakil Sekretaris', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Ramli, SST, MA, MSE', 'position' => 'Bendahara Umum', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Bambang Harie Wiyono, S.T., M.M.', 'position' => 'Ketua I', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Dr. Sunarto Zulkifli', 'position' => 'Ketua II', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Hendra Saputra', 'position' => 'Ketua III', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Khairil Adha', 'position' => 'Ketua IV', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Rovi Octaviano Vustany, SP, MSi', 'position' => 'Ketua V', 'division' => 'Badan Pengurus Harian'],
            ['name' => 'Dr. Ira Silviana', 'position' => 'Ketua VII', 'division' => 'Badan Pengurus Harian'],

            // ===== D. DEPARTEMEN =====
            // Dept. Humas (di bawah Ketua I)
            ['name' => 'Nuryanto, SE', 'position' => 'Ketua', 'division' => 'Departemen Humas'],
            ['name' => 'Dini Mufida', 'position' => 'Anggota', 'division' => 'Departemen Humas'],
            ['name' => 'Muzaki Abdullah Irsyad', 'position' => 'Anggota', 'division' => 'Departemen Humas'],

            // Dept. Kerjasama dan Kemitraan (di bawah Ketua I)
            ['name' => 'Tommy Lukman, MTI', 'position' => 'Ketua', 'division' => 'Departemen Kerjasama dan Kemitraan'],
            ['name' => 'Rio Eldianson, SE, MSi', 'position' => 'Anggota', 'division' => 'Departemen Kerjasama dan Kemitraan'],
            ['name' => 'Luthfi Bukhari, ST', 'position' => 'Anggota', 'division' => 'Departemen Kerjasama dan Kemitraan'],

            // Dept. Perbankan Syariah (di bawah Ketua II)
            ['name' => 'Soenarto, S.E., CA, MM', 'position' => 'Ketua', 'division' => 'Departemen Perbankan Syariah'],
            ['name' => 'Agung Nugroho, ST', 'position' => 'Anggota', 'division' => 'Departemen Perbankan Syariah'],
            ['name' => 'Bambang Ali', 'position' => 'Anggota', 'division' => 'Departemen Perbankan Syariah'],

            // Dept. Fintech, Pasar Modal dan Keuangan Mikro Syariah (di bawah Ketua II)
            ['name' => 'Abrizen Justa', 'position' => 'Ketua', 'division' => 'Departemen Fintech, Pasar Modal dan Keuangan Mikro Syariah'],
            ['name' => 'Hariyanti Harianja', 'position' => 'Anggota', 'division' => 'Departemen Fintech, Pasar Modal dan Keuangan Mikro Syariah'],
            ['name' => 'Nurhadi', 'position' => 'Anggota', 'division' => 'Departemen Fintech, Pasar Modal dan Keuangan Mikro Syariah'],

            // Dept. Industri Halal (di bawah Ketua III)
            ['name' => 'Sugiyanto, A.Md.Gz', 'position' => 'Ketua', 'division' => 'Departemen Industri Halal'],
            ['name' => 'dr. Udin Wahyudin', 'position' => 'Anggota', 'division' => 'Departemen Industri Halal'],
            ['name' => 'Agoeng Widiyatmoko, S.I.Kom', 'position' => 'Anggota', 'division' => 'Departemen Industri Halal'],
            ['name' => 'Widia Hastuti, A.Md.Ke', 'position' => 'Anggota', 'division' => 'Departemen Industri Halal'],

            // Dept. Ekonomi Kreatif dan Bisnis Digital (di bawah Ketua III)
            ['name' => 'Mukhoer Abdus Syukur, S.E.Sy', 'position' => 'Ketua', 'division' => 'Departemen Ekonomi Kreatif dan Bisnis Digital'],
            ['name' => 'Aprizal, SE', 'position' => 'Anggota', 'division' => 'Departemen Ekonomi Kreatif dan Bisnis Digital'],
            ['name' => 'Handi Wiranata', 'position' => 'Anggota', 'division' => 'Departemen Ekonomi Kreatif dan Bisnis Digital'],

            // Dept. Pemberdayaan Pemuda, Mahasiswa dan Pelajar (di bawah Ketua IV)
            ['name' => 'Erwin Setiawan', 'position' => 'Ketua', 'division' => 'Departemen Pemberdayaan Pemuda, Mahasiswa dan Pelajar'],
            ['name' => 'Rohmat Hidayatuloh, S.Si, MMT, CRMP, CISA', 'position' => 'Anggota', 'division' => 'Departemen Pemberdayaan Pemuda, Mahasiswa dan Pelajar'],
            ['name' => 'Rafly Kusadi', 'position' => 'Anggota', 'division' => 'Departemen Pemberdayaan Pemuda, Mahasiswa dan Pelajar'],

            // Dept. Pelatihan dan Literasi Ekonomi Syariah (di bawah Ketua IV)
            ['name' => 'Muzakir', 'position' => 'Ketua', 'division' => 'Departemen Pelatihan dan Literasi Ekonomi Syariah'],
            ['name' => 'Andi Rosa', 'position' => 'Anggota', 'division' => 'Departemen Pelatihan dan Literasi Ekonomi Syariah'],
            ['name' => 'Agus Kurniawan', 'position' => 'Anggota', 'division' => 'Departemen Pelatihan dan Literasi Ekonomi Syariah'],

            // Dept. Zakat, Wakaf, dan CSR (di bawah Ketua V)
            ['name' => 'Khoirul Nur Mustaqim', 'position' => 'Ketua', 'division' => 'Departemen Zakat, Wakaf, dan CSR'],
            ['name' => 'Aris', 'position' => 'Anggota', 'division' => 'Departemen Zakat, Wakaf, dan CSR'],
            ['name' => 'Bany Setyawan', 'position' => 'Anggota', 'division' => 'Departemen Zakat, Wakaf, dan CSR'],

            // Dept. UMKM (di bawah Ketua V)
            ['name' => 'Kamaludin Enuh', 'position' => 'Ketua', 'division' => 'Departemen UMKM'],
            ['name' => 'Dini Mufidah', 'position' => 'Anggota', 'division' => 'Departemen UMKM'],
            ['name' => 'Nia Kanialistiowati', 'position' => 'Anggota', 'division' => 'Departemen UMKM'],

            // Dept. Pemberdayaan Ekonomi Perempuan (di bawah Ketua VII)
            ['name' => 'Marlina Ayu Apriyantini, S.Pd., M.E., AWPS, CSFT', 'position' => 'Ketua', 'division' => 'Departemen Pemberdayaan Ekonomi Perempuan'],
            ['name' => 'Iki Farini, S.Pd', 'position' => 'Anggota', 'division' => 'Departemen Pemberdayaan Ekonomi Perempuan'],
            ['name' => 'Rani', 'position' => 'Anggota', 'division' => 'Departemen Pemberdayaan Ekonomi Perempuan'],

            // Dept. Ketahanan Keluarga (di bawah Ketua VII)
            ['name' => 'Rahmayanti Dewi', 'position' => 'Ketua', 'division' => 'Departemen Ketahanan Keluarga'],
            ['name' => 'Nurlela', 'position' => 'Anggota', 'division' => 'Departemen Ketahanan Keluarga'],
            ['name' => 'May', 'position' => 'Anggota', 'division' => 'Departemen Ketahanan Keluarga'],
        ];

        foreach ($data as $item) {
            $sort++;
            OrganizationMember::create(array_merge($item, [
                'sort_order' => $sort,
                'period' => $period,
                'status' => 'active',
            ]));
        }
    }
}
