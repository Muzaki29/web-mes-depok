@extends('layouts.public')

@section('hero')
    <div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=2071&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Anggaran Dasar & Rumah Tangga</h1>
            <p class="text-xl text-emerald-100 leading-relaxed">
                Landasan konstitusional organisasi Masyarakat Ekonomi Syariah.
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-red-100 text-red-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dokumen AD/ART MES</h2>
                    <p class="text-gray-500">Versi terbaru hasil Musyawarah Nasional.</p>
                </div>
            </div>

            <div class="prose prose-emerald max-w-none text-gray-600 mb-8">
                <p>
                    Anggaran Dasar (AD) dan Anggaran Rumah Tangga (ART) merupakan pedoman utama yang mengatur tata kelola, hak, kewajiban, dan mekanisme pengambilan keputusan dalam organisasi Masyarakat Ekonomi Syariah. Dokumen ini menjadi rujukan bagi seluruh pengurus dan anggota dalam menjalankan roda organisasi.
                </p>
                <h3>Poin-Poin Penting:</h3>
                <ul>
                    <li><strong>Asas dan Tujuan:</strong> Menjelaskan landasan filosofis dan cita-cita organisasi.</li>
                    <li><strong>Keanggotaan:</strong> Mengatur syarat, hak, dan kewajiban anggota biasa, luar biasa, dan kehormatan.</li>
                    <li><strong>Struktur Organisasi:</strong> Menjelaskan susunan kepengurusan dari tingkat pusat hingga daerah.</li>
                    <li><strong>Musyawarah dan Rapat:</strong> Mengatur mekanisme pengambilan keputusan tertinggi.</li>
                    <li><strong>Keuangan:</strong> Mengatur sumber pendanaan dan pengelolaan aset organisasi.</li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh AD/ART (PDF)
                </a>
                <a href="{{ route('about.statute') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Baca Online
                </a>
            </div>
        </div>
        <div class="bg-gray-50 px-8 py-6 border-t border-gray-100">
            <p class="text-sm text-gray-500">Terakhir diperbarui: Musyawarah Nasional V, 2023</p>
        </div>
    </div>
</div>
@endsection
