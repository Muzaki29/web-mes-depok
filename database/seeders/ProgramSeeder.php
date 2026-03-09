<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Kajian Ekonomi Syariah (KES)',
                'category' => 'Rutin Bulanan',
                'description' => 'Forum diskusi rutin yang membahas isu-isu terkini seputar ekonomi syariah, mulai dari fiqh muamalah hingga tren fintech syariah.',
                'content' => '
                    <h3 class="text-xl font-bold mb-4">Tentang Program</h3>
                    <p class="mb-4">Kajian Ekonomi Syariah (KES) adalah program unggulan MES Depok yang diselenggarakan setiap bulan. Program ini bertujuan untuk memberikan edukasi dan pemahaman mendalam mengenai prinsip-prinsip ekonomi Islam dan penerapannya dalam kehidupan sehari-hari maupun dunia bisnis.</p>
                    
                    <h3 class="text-xl font-bold mb-4">Materi Bahasan</h3>
                    <ul class="list-disc pl-5 mb-4 space-y-2">
                        <li>Fiqh Muamalah Kontemporer</li>
                        <li>Manajemen Bisnis Syariah</li>
                        <li>Perbankan dan Keuangan Islam</li>
                        <li>Zakat, Infaq, Sedekah, dan Wakaf (ZISWAF)</li>
                        <li>Etika Bisnis Islam</li>
                    </ul>

                    <h3 class="text-xl font-bold mb-4">Jadwal & Lokasi</h3>
                    <p class="mb-4">Dilaksanakan setiap pekan ke-2 setiap bulannya, bertempat di Aula Masjid Balaikota Depok atau secara daring melalui Zoom Meeting.</p>
                ',
                'thumbnail' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop',
            ],
            [
                'title' => 'Pendampingan Sertifikasi Halal',
                'category' => 'Program Unggulan',
                'description' => 'Layanan pendampingan bagi UMKM untuk mendapatkan sertifikasi halal melalui jalur Self Declare maupun Reguler, bekerjasama dengan BPJPH.',
                'content' => '
                    <h3 class="text-xl font-bold mb-4">Deskripsi Program</h3>
                    <p class="mb-4">Program ini dirancang untuk membantu pelaku Usaha Mikro dan Kecil (UMK) di Kota Depok dalam memperoleh sertifikat halal. Kami menyediakan pendampingan teknis mulai dari penyiapan dokumen, pendaftaran di SIHALAL, hingga audit lapangan oleh Pendamping Proses Produk Halal (PPH).</p>

                    <h3 class="text-xl font-bold mb-4">Layanan Kami</h3>
                    <ul class="list-disc pl-5 mb-4 space-y-2">
                        <li>Sosialisasi Regulasi Jaminan Produk Halal</li>
                        <li>Verifikasi Bahan dan Proses Produksi</li>
                        <li>Bantuan Input Data di SIHALAL</li>
                        <li>Konsultasi Berkelanjutan</li>
                    </ul>

                    <h3 class="text-xl font-bold mb-4">Syarat Peserta</h3>
                    <p class="mb-4">Memiliki NIB, produk tidak berisiko tinggi, dan menggunakan bahan yang sudah dipastikan kehalalannya.</p>
                ',
                'thumbnail' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2032&auto=format&fit=crop',
            ],
            [
                'title' => 'Depok Sharia Festival',
                'category' => 'Event Tahunan',
                'description' => 'Festival ekonomi syariah terbesar di Depok yang menghadirkan pameran produk halal, talkshow inspiratif, dan kompetisi wirausaha muda.',
                'content' => '
                    <h3 class="text-xl font-bold mb-4">Tentang Festival</h3>
                    <p class="mb-4">Depok Sharia Festival (DSF) merupakan ajang tahunan terbesar yang mempertemukan seluruh pemangku kepentingan ekonomi syariah di Kota Depok. Acara ini menjadi wadah promosi, edukasi, dan kolaborasi bagi pelaku usaha, lembaga keuangan, akademisi, dan masyarakat umum.</p>

                    <h3 class="text-xl font-bold mb-4">Rangkaian Acara</h3>
                    <ul class="list-disc pl-5 mb-4 space-y-2">
                        <li>Expo Produk Halal & UMKM</li>
                        <li>Seminar Nasional Ekonomi Syariah</li>
                        <li>Kompetisi Business Plan</li>
                        <li>Lomba Cerdas Cermat Ekonomi Islam</li>
                        <li>Fashion Show Muslim</li>
                    </ul>

                    <h3 class="text-xl font-bold mb-4">Dampak</h3>
                    <p class="mb-4">Telah diikuti oleh lebih dari 500 UMKM dan dikunjungi oleh 10.000+ pengunjung setiap tahunnya.</p>
                ',
                'thumbnail' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=2070&auto=format&fit=crop',
            ],
        ];

        foreach ($programs as $p) {
            Program::firstOrCreate(
                ['title' => $p['title']],
                [
                    'slug' => Str::slug($p['title']),
                    'category' => $p['category'],
                    'description' => $p['description'],
                    'content' => $p['content'],
                    'thumbnail' => $p['thumbnail'],
                    'status' => 'active',
                ]
            );
        }
    }
}
