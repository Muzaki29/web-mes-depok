@extends('layouts.public')

@section('hero')
<div class="relative bg-emerald-900 pt-32 pb-20 lg:pt-48 lg:pb-32 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop" alt="MES Depok Background" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-linear-to-t from-emerald-900 via-emerald-900/80 to-transparent"></div>
    </div>
    <div class="relative max-w-4xl mx-auto z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-800/50 backdrop-blur border border-emerald-700 text-emerald-100 text-sm mb-6 animate-fade-in-up">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            <span>Masyarakat Ekonomi Syariah Kota Depok</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight tracking-tight">
            Membangun Ekonomi Umat,<br class="hidden md:block" /> Mensejahterakan Bangsa
        </h1>
        <p class="text-xl text-emerald-100 leading-relaxed max-w-2xl mx-auto mb-10">
            Wadah inklusif untuk mengembangkan ekonomi dan keuangan syariah yang berkeadilan, transparan, dan berkelanjutan di Kota Depok.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('/about') }}" class="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-white rounded-xl font-semibold transition-all transform hover:-translate-y-1 shadow-lg shadow-emerald-900/20">
                Tentang Kami
            </a>
            <a href="{{ url('/programs') }}" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur text-white border border-white/20 rounded-xl font-semibold transition-all">
                Lihat Program
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Stats Section -->
<div class="relative -mt-16 mb-20 z-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto px-4">
        <!-- Members Stat -->
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-emerald-50 text-center transform hover:-translate-y-1 transition-transform duration-300">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="text-4xl font-bold text-gray-900 mb-1">{{ number_format($metrics['members'] ?? 0) }}</div>
            <div class="text-gray-500 font-medium">Anggota Terdaftar</div>
        </div>

        <!-- Events Stat -->
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-emerald-50 text-center transform hover:-translate-y-1 transition-transform duration-300">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="text-4xl font-bold text-gray-900 mb-1">{{ number_format($metrics['events_this_year'] ?? 0) }}</div>
            <div class="text-gray-500 font-medium">Agenda Tahun Ini</div>
        </div>

        <!-- Partners Stat -->
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-emerald-50 text-center transform hover:-translate-y-1 transition-transform duration-300">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div class="text-4xl font-bold text-gray-900 mb-1">{{ number_format($metrics['partners'] ?? 0) }}</div>
            <div class="text-gray-500 font-medium">Mitra Strategis</div>
        </div>
    </div>
</div>

<!-- Introduction Section -->
<div class="mb-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="relative">
            <div class="absolute -left-4 -top-4 w-24 h-24 bg-emerald-100 rounded-full opacity-50 blur-xl"></div>
            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-gray-100">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2064&auto=format&fit=crop" alt="Meeting" class="w-full h-auto">
                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent flex items-end p-8">
                    <p class="text-white font-medium text-lg">"Sinergi untuk Ekonomi Syariah"</p>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Mendorong Pertumbuhan Ekonomi Syariah yang Inklusif</h2>
            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                Masyarakat Ekonomi Syariah (MES) Depok hadir sebagai katalisator pengembangan ekonomi syariah di tingkat daerah. Kami berkomitmen untuk mensinergikan seluruh pemangku kepentingan demi terwujudnya sistem ekonomi yang adil dan mensejahterakan.
            </p>
            <ul class="space-y-4 mb-8">
                <li class="flex items-start">
                    <div class="shrink-0 w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="ml-3 text-gray-700">Edukasi dan literasi ekonomi syariah</span>
                </li>
                <li class="flex items-start">
                    <div class="shrink-0 w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="ml-3 text-gray-700">Pengembangan usaha dan kemitraan</span>
                </li>
                <li class="flex items-start">
                    <div class="shrink-0 w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="ml-3 text-gray-700">Advokasi kebijakan ekonomi syariah</span>
                </li>
            </ul>
            <a href="{{ url('/about') }}" class="inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition-colors">
                Pelajari Lebih Lanjut
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</div>

<!-- Upcoming Events Section -->
<div class="mb-24">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Agenda Terdekat</h2>
            <p class="text-gray-600 mt-2">Jangan lewatkan kegiatan dan acara penting dari MES Depok.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ url('/events') }}" class="inline-flex items-center px-4 py-2 border border-emerald-200 rounded-lg text-emerald-700 hover:bg-emerald-50 transition-colors font-medium">
                Lihat Semua Agenda
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse(($upcomingEvents ?? []) as $e)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all group">
            <div class="relative h-48 bg-emerald-100 overflow-hidden">
                @if($e->thumbnail)
                     @php $thumb = (str_starts_with($e->thumbnail,'http') || str_starts_with($e->thumbnail,'//')) ? $e->thumbnail : asset('storage/'.$e->thumbnail); @endphp
                    <img src="{{ $thumb }}" alt="{{ $e->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-xs font-bold text-emerald-700 shadow-sm">
                    {{ optional($e->start_at)->format('d M Y') }}
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center text-xs text-gray-500 mb-3 space-x-2">
                    <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-100">{{ $e->category ?? 'Event' }}</span>
                    <span>•</span>
                    <span>{{ optional($e->start_at)->format('H:i') }} WIB</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors">
                    {{ $e->title }}
                </h3>
                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                    {{ $e->description ?? 'Ikuti kegiatan ini untuk menambah wawasan dan jaringan.' }}
                </p>
                <a href="{{ url('/events') }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    Detail Acara
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada agenda</h3>
            <p class="mt-1 text-sm text-gray-500">Cek kembali nanti untuk info terbaru.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Latest News Section -->
<div class="mb-24">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Berita & Artikel</h2>
            <p class="text-gray-600 mt-2">Wawasan dan informasi terkini seputar ekonomi syariah.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ url('/news') }}" class="inline-flex items-center px-4 py-2 border border-emerald-200 rounded-lg text-emerald-700 hover:bg-emerald-50 transition-colors font-medium">
                Lihat Semua Berita
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse(($latestArticles ?? []) as $a)
        @php $thumb = $a->thumbnail ? (str_starts_with($a->thumbnail,'http') || str_starts_with($a->thumbnail,'//') ? $a->thumbnail : asset('storage/'.$a->thumbnail)) : null; @endphp
        <article class="flex flex-col group h-full">
            <div class="relative h-56 rounded-xl overflow-hidden mb-5">
                @if($thumb)
                    <img src="{{ $thumb }}" alt="{{ $a->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-linear-to-br from-emerald-100 to-emerald-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-linear-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <div class="flex-1">
                <div class="text-sm text-emerald-600 font-medium mb-2">
                    {{ optional($a->published_at)->translatedFormat('d F Y') }}
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                    <a href="{{ route('news.show', $a->slug) }}">
                        {{ $a->title }}
                    </a>
                </h3>
                <p class="text-gray-600 line-clamp-3 mb-4">
                    {{ Str::limit(strip_tags($a->content), 120) }}
                </p>
            </div>
            <div class="mt-auto pt-4 border-t border-gray-100">
                <a href="{{ route('news.show', $a->slug) }}" class="inline-flex items-center text-sm font-semibold text-gray-900 group-hover:text-emerald-600 transition-colors">
                    Baca Selengkapnya
                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            Belum ada artikel terbaru.
        </div>
        @endforelse
    </div>
</div>

<!-- Partners Section -->
<div class="border-t border-gray-100 pt-16">
    <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-900">Mitra Strategis</h2>
        <p class="text-gray-500 mt-2">Bekerjasama dengan berbagai instansi untuk kemajuan bersama.</p>
    </div>
    
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 items-center opacity-70">
        @forelse(($partners ?? []) as $p)
            <div class="p-4 bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md hover:border-emerald-100 hover:opacity-100 transition-all text-center h-20 flex items-center justify-center group">
                @if($p->logo)
                     <img src="{{ asset('storage/'.$p->logo) }}" alt="{{ $p->name }}" class="max-h-12 max-w-full grayscale group-hover:grayscale-0 transition-all">
                @else
                    <span class="text-sm font-semibold text-gray-400 group-hover:text-emerald-600">{{ $p->name }}</span>
                @endif
            </div>
        @empty
            <div class="col-span-full text-center text-sm text-gray-400 italic">
                (Mitra akan segera ditambahkan)
            </div>
        @endforelse
    </div>
</div>
@endsection
