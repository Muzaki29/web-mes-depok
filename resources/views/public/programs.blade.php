@extends('layouts.public')

@section('hero')
    <div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop" alt="Programs Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Program Unggulan</h1>
            <p class="text-xl text-emerald-100 leading-relaxed">
                Inisiatif strategis MES Depok dalam mendorong pertumbuhan ekonomi syariah yang inklusif dan berkelanjutan.
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-20">
    
    <!-- Introduction -->
    <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pilar Program</h2>
        <p class="text-gray-600 text-lg">
            Kami memfokuskan gerak langkah organisasi pada tiga pilar utama untuk memastikan dampak yang luas dan terukur.
        </p>
    </div>

    <!-- Pillars Grid -->
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Pillar 1 -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group">
            <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Literasi & Edukasi</h3>
            <p class="text-gray-600 mb-4">Meningkatkan pemahaman masyarakat tentang konsep dan praktik ekonomi syariah.</p>
            <ul class="space-y-2 text-sm text-gray-500">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> MES Goes to Campus</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Kajian Ekonomi Islam</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Workshop Perencanaan Keuangan</li>
            </ul>
        </div>

        <!-- Pillar 2 -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Pengembangan Usaha</h3>
            <p class="text-gray-600 mb-4">Memberdayakan UMKM dan pelaku usaha agar naik kelas dan berdaya saing.</p>
            <ul class="space-y-2 text-sm text-gray-500">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Klinik Bisnis Syariah</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Pendampingan Sertifikasi Halal</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Kurasi Produk UMKM</li>
            </ul>
        </div>

        <!-- Pillar 3 -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group">
            <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Kemitraan Strategis</h3>
            <p class="text-gray-600 mb-4">Membangun kolaborasi dengan berbagai pihak untuk memperluas dampak.</p>
            <ul class="space-y-2 text-sm text-gray-500">
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span> Business Matching</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span> Forum Silaturahmi Anggota</li>
                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span> Kerjasama Lembaga Keuangan</li>
            </ul>
        </div>
    </div>

    <!-- Detailed Programs List -->
    <section>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 border-l-4 border-emerald-500 pl-4">Program Berjalan</h2>
            <form action="{{ route('programs') }}" method="GET" class="relative w-full md:w-96">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari program..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>

        @if(request('q'))
             <div class="mb-6 flex items-center justify-between bg-emerald-50 p-4 rounded-lg border border-emerald-100">
                <p class="text-emerald-800">Menampilkan hasil pencarian untuk: <span class="font-bold">"{{ request('q') }}"</span></p>
                <a href="{{ route('programs') }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium hover:underline">Reset</a>
            </div>
        @endif

        <div class="space-y-6">
            @forelse($programs as $program)
            <div class="group flex flex-col md:flex-row bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <div class="md:w-1/3 h-48 md:h-auto relative overflow-hidden">
                    @php 
                        $thumb = $program->thumbnail 
                            ? (str_starts_with($program->thumbnail, 'http') || str_starts_with($program->thumbnail, '//') 
                                ? $program->thumbnail 
                                : asset('storage/'.$program->thumbnail))
                            : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $thumb }}" alt="{{ $program->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6 md:w-2/3 flex flex-col justify-center">
                    <div class="text-sm text-emerald-600 font-semibold mb-2">{{ $program->category ?? 'Program' }}</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-700 transition">
                        <a href="{{ route('programs.show', $program->slug) }}">{{ $program->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($program->description, 150) }}</p>
                    <a href="{{ route('programs.show', $program->slug) }}" class="text-emerald-700 font-medium hover:underline inline-flex items-center">
                        Lihat Detail <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-gray-500 bg-white rounded-xl border border-gray-100 shadow-sm">
                Belum ada program aktif saat ini.
            </div>
            @endforelse
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-emerald-600 rounded-2xl p-10 text-center text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
        
        <h2 class="text-3xl font-bold mb-4 relative z-10">Punya Ide Program Kolaborasi?</h2>
        <p class="text-emerald-100 mb-8 max-w-2xl mx-auto relative z-10">Kami selalu terbuka untuk berkolaborasi dengan instansi, komunitas, maupun individu yang memiliki visi sejalan.</p>
        <a href="{{ url('/contact') }}" class="inline-block bg-white text-emerald-700 font-bold py-3 px-8 rounded-lg hover:bg-emerald-50 transition relative z-10 shadow-lg">
            Hubungi Kami
        </a>
    </section>

</div>
@endsection
