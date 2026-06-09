@extends('layouts.public')

@php
    use Illuminate\Support\Facades\Cache;
    $home = $homeSettings ?? [];
    $setting = fn ($key, $default) => (isset($home[$key]) && trim((string) $home[$key]) !== '') ? $home[$key] : $default;

    $heroTitle = $setting('home.hero_title', 'Menebar Manfaat untuk Umat Depok Berdaulat');
    $heroSubtitle = $setting('home.hero_subtitle', 'Bersama membangun ekosistem ekonomi syariah yang kuat, inklusif, dan berkelanjutan di Kota Depok.');
    $heroBadge = $setting('home.hero_badge', 'Masyarakat Ekonomi Syariah Kota Depok');
    $heroImage = $setting('home.hero_image', null);
@endphp

@section('hero')
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-linear-to-br from-emerald-900 via-emerald-800 to-teal-900">
    {{-- Background image / parallax --}}
    @if($heroImage)
        <div class="absolute inset-0" x-data="{ y: 0 }" @scroll.window="y = window.pageYOffset * 0.25" :style="`transform: translateY(${y}px)`">
            <img src="{{ $heroImage }}" alt="MES Depok" class="w-full h-[120%] object-cover opacity-25">
        </div>
    @endif
    {{-- Decorative gradients --}}
    <div class="absolute inset-0 bg-linear-to-t from-emerald-950/90 via-emerald-900/40 to-emerald-950/30"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -left-24 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white py-32">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur border border-white/20 text-emerald-50 text-sm mb-8 animate-fade-in-up" style="animation-delay:.1s">
            <span class="w-2 h-2 rounded-full bg-gold" style="background-color:#e8c547"></span>
            <span>{{ $heroBadge }}</span>
        </div>
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold mb-8 leading-[1.1] tracking-tight animate-fade-in-up" style="animation-delay:.25s">
            {{ $heroTitle }}
        </h1>
        <p class="text-lg sm:text-xl text-emerald-100/90 leading-relaxed max-w-2xl mx-auto mb-10 animate-fade-in-up" style="animation-delay:.4s">
            {{ $heroSubtitle }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay:.55s">
            <a href="{{ url('/membership') }}" class="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-white rounded-xl font-semibold transition-all transform hover:-translate-y-1 shadow-xl shadow-emerald-900/40">
                Gabung Sekarang
            </a>
            <a href="{{ url('/about') }}" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur text-white border border-white/25 rounded-xl font-semibold transition-all">
                Tentang MES Depok
            </a>
        </div>
    </div>

    {{-- Scroll cue --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/60 animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>
</section>
@endsection

@section('fullwidth')
@php
    $introImage = $setting('home.intro_image', 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2064&auto=format&fit=crop');
    $introBody = $setting('home.intro_body', 'Masyarakat Ekonomi Syariah (MES) Depok adalah organisasi nirlaba yang berkomitmen mengembangkan dan mempercepat penerapan ekonomi serta keuangan syariah di Kota Depok. Kami menghimpun praktisi, akademisi, ulama, dan pelaku usaha untuk bersinergi membangun ekonomi umat yang berkeadilan.');

    $activeMembers = Cache::remember('home_active_members', 600, fn () => \App\Models\Member::where('status', 'active')->count());
    $partnersCount = Cache::remember('home_partners_count', 600, fn () => \App\Models\Partner::count());
    $eventsThisYear = Cache::remember('home_events_year', 600, fn () => \App\Models\Event::whereYear('start_at', now()->year)->count());
    $programs = Cache::remember('home_active_programs', 600, fn () => \App\Models\Program::where('status', 'active')->latest()->limit(6)->get());
@endphp

{{-- ============ B. SELAYANG PANDANG ============ --}}
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-center">
            <div class="lg:col-span-3" data-reveal>
                <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Selayang Pandang</span>
                <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-6 leading-tight">
                    Seputar <span class="gold-underline">MES Depok</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    {{ $introBody }}
                </p>
                <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 text-emerald-600 font-semibold hover:text-emerald-700 transition-colors group">
                    Selengkapnya tentang MES Depok
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="lg:col-span-2" data-reveal>
                <a href="{{ url('/news') }}" class="group relative block rounded-2xl overflow-hidden shadow-2xl aspect-4/5">
                    <img src="{{ $introImage }}" alt="Dokumentasi MES Depok" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-t from-emerald-950/90 via-emerald-900/30 to-transparent"></div>
                    <div class="absolute bottom-0 p-7 text-white">
                        <div class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-emerald-200 mb-2">
                            <span class="w-8 h-px bg-emerald-300"></span> Galeri
                        </div>
                        <p class="font-heading text-xl font-bold">Lihat Galeri Dokumentasi</p>
                        <p class="text-sm text-emerald-100/80 mt-1">Jejak kegiatan dan kiprah MES Depok</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============ C. SEBARAN JARINGAN / COUNTER ============ --}}
<section class="relative py-20 lg:py-28 bg-emerald-950 overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 20% 30%, #34d399 0, transparent 40%),radial-gradient(circle at 80% 70%, #2dd4bf 0, transparent 40%)"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14" data-reveal>
            <span class="text-sm font-semibold uppercase tracking-widest text-emerald-400">Jaringan Kami</span>
            <h2 class="font-heading text-3xl lg:text-4xl font-bold text-white mt-3">Sebaran Jaringan MES</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="text-center" data-reveal>
                <div class="font-heading text-5xl lg:text-6xl font-extrabold text-white mb-2"><span data-counter="{{ $activeMembers }}">0</span><span class="text-emerald-400">+</span></div>
                <div class="text-emerald-200 font-medium tracking-wide">Member Aktif</div>
            </div>
            <div class="text-center md:border-x border-white/10" data-reveal>
                <div class="font-heading text-5xl lg:text-6xl font-extrabold text-white mb-2"><span data-counter="{{ $partnersCount }}">0</span><span class="text-emerald-400">+</span></div>
                <div class="text-emerald-200 font-medium tracking-wide">Mitra Strategis</div>
            </div>
            <div class="text-center" data-reveal>
                <div class="font-heading text-5xl lg:text-6xl font-extrabold text-white mb-2"><span data-counter="{{ $eventsThisYear }}">0</span></div>
                <div class="text-emerald-200 font-medium tracking-wide">Kegiatan Tahun Ini</div>
            </div>
        </div>
    </div>
</section>

{{-- ============ D. BERITA TERBARU (SLIDER) ============ --}}
<section class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4" data-reveal>
            <div>
                <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Informasi</span>
                <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3">
                    Artikel &amp; Berita <span class="bg-linear-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent">Terbaru</span>
                </h2>
            </div>
            <a href="{{ url('/news') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-emerald-200 rounded-lg text-emerald-700 hover:bg-emerald-50 transition-colors font-semibold shrink-0">
                Selengkapnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        @if(($latestArticles ?? collect())->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-200 text-gray-500">Belum ada artikel terbaru.</div>
        @else
        <div class="flex gap-6 overflow-x-auto pb-6 snap-x snap-mandatory -mx-4 px-4 scroll-smooth" style="scrollbar-width:thin">
            @foreach($latestArticles as $a)
                @php $thumb = $a->thumbnail ? (str_starts_with($a->thumbnail,'http') || str_starts_with($a->thumbnail,'//') ? $a->thumbnail : asset('storage/'.$a->thumbnail)) : null; @endphp
                <a href="{{ route('news.show', $a->slug) }}" class="group relative shrink-0 w-80 sm:w-96 snap-start rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 aspect-4/3 bg-emerald-900">
                    @if($thumb)
                        <img src="{{ $thumb }}" alt="{{ $a->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="absolute inset-0 bg-linear-to-br from-emerald-700 to-teal-800"></div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-black/85 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 p-6 text-white">
                        <span class="inline-block px-3 py-1 rounded-full bg-emerald-500/90 text-xs font-semibold mb-3">Berita</span>
                        <h3 class="font-heading text-lg font-bold leading-snug line-clamp-2 mb-2 group-hover:text-emerald-200 transition-colors">{{ $a->title }}</h3>
                        <div class="text-xs text-gray-300">{{ optional($a->published_at)->translatedFormat('d F Y') }}</div>
                    </div>
                </a>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ============ E. PROGRAM KERJA ============ --}}
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14" data-reveal>
            <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Apa yang Kami Lakukan</span>
            <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3">Program Kerja Unggulan</h2>
            <p class="text-gray-600 mt-4">Inisiatif strategis untuk mendorong pertumbuhan ekonomi syariah yang inklusif di Depok.</p>
        </div>

        @if($programs->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200 text-gray-500">Program akan segera ditampilkan.</div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($programs as $p)
                @php $thumb = $p->thumbnail ? (str_starts_with($p->thumbnail,'http') || str_starts_with($p->thumbnail,'//') ? $p->thumbnail : asset('storage/'.$p->thumbnail)) : null; @endphp
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl overflow-hidden transition-all duration-300 border-b-4 border-b-transparent hover:border-b-emerald-500" data-reveal>
                    <div class="relative h-48 overflow-hidden bg-emerald-50">
                        @if($thumb)
                            <img src="{{ $thumb }}" alt="{{ $p->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-linear-to-br from-emerald-100 to-emerald-200 text-emerald-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        @if($p->category)
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/90 backdrop-blur text-xs font-semibold text-emerald-700 shadow-sm">{{ $p->category }}</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-heading text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $p->title }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-5">{{ Str::limit(strip_tags($p->description), 120) }}</p>
                        <a href="{{ route('programs.show', $p->slug) }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                            Detail Program
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ============ F. AGENDA TERDEKAT (TIMELINE) ============ --}}
<section class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4" data-reveal>
            <div>
                <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Jadwal Kegiatan</span>
                <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3">Agenda Kegiatan Terdekat</h2>
            </div>
            <a href="{{ url('/events') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-emerald-200 rounded-lg text-emerald-700 hover:bg-emerald-50 transition-colors font-semibold shrink-0">
                Semua Agenda
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        @php $agenda = ($upcomingEvents ?? collect())->take(3); @endphp
        @if($agenda->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-200 text-gray-500">Belum ada agenda mendatang. Cek kembali nanti.</div>
        @else
        <div class="space-y-5">
            @foreach($agenda as $e)
            <div class="group flex flex-col sm:flex-row items-stretch gap-5 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 p-5" data-reveal>
                {{-- Date badge --}}
                <div class="shrink-0 w-full sm:w-24 flex sm:flex-col items-center justify-center gap-2 sm:gap-0 rounded-xl bg-linear-to-br from-emerald-600 to-emerald-700 text-white py-4">
                    <div class="font-heading text-3xl sm:text-4xl font-extrabold leading-none">{{ optional($e->start_at)->format('d') }}</div>
                    <div class="text-sm font-medium uppercase tracking-wide text-emerald-100">{{ optional($e->start_at)->translatedFormat('M Y') }}</div>
                </div>
                {{-- Content --}}
                <div class="flex-1 flex flex-col justify-center">
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-100 font-medium">{{ $e->category ?? 'Kegiatan' }}</span>
                        <span>•</span>
                        <span>{{ optional($e->start_at)->format('H:i') }} WIB</span>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors line-clamp-1">{{ $e->title }}</h3>
                    <div class="flex items-center gap-1.5 text-sm text-gray-500 mt-1.5">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        {{ $e->location ?? 'Kota Depok' }}
                    </div>
                </div>
                {{-- Action --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('events.show', $e->slug) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors">
                        Daftar
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ============ G. MITRA & PARTNER (AUTO-SCROLL) ============ --}}
@php $partners = $partners ?? collect(); @endphp
<section class="py-20 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-reveal>
            <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Kolaborasi</span>
            <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3">Mitra &amp; Partner</h2>
            <p class="text-gray-500 mt-3">Bersinergi dengan berbagai instansi untuk kemajuan ekonomi syariah.</p>
        </div>
    </div>

    @if($partners->isEmpty())
        <div class="text-center text-sm text-gray-400 italic">(Mitra akan segera ditambahkan)</div>
    @else
    <div class="marquee-wrap relative overflow-hidden" style="mask-image:linear-gradient(to right,transparent,#000 8%,#000 92%,transparent);-webkit-mask-image:linear-gradient(to right,transparent,#000 8%,#000 92%,transparent)">
        <div class="marquee-track gap-6">
            @foreach($partners->concat($partners) as $p)
                <div class="shrink-0 w-44 h-24 flex items-center justify-center px-6 bg-white border border-gray-100 rounded-xl shadow-sm">
                    @if($p->logo)
                        <img src="{{ asset('storage/'.$p->logo) }}" alt="{{ $p->name }}" class="max-h-12 max-w-full grayscale hover:grayscale-0 transition-all">
                    @else
                        <span class="text-sm font-semibold text-gray-400 text-center">{{ $p->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

{{-- ============ CTA STRIP ============ --}}
<section class="bg-linear-to-br from-emerald-700 to-teal-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center text-white" data-reveal>
        <h2 class="font-heading text-3xl lg:text-4xl font-bold mb-4">Mari Bergabung Bersama MES Depok</h2>
        <p class="text-emerald-100 max-w-2xl mx-auto mb-8">Jadilah bagian dari gerakan ekonomi syariah dan berkontribusi untuk kemaslahatan umat di Kota Depok.</p>
        <a href="{{ url('/membership') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-emerald-700 rounded-xl font-bold hover:bg-emerald-50 transition-all transform hover:-translate-y-1 shadow-xl">
            Gabung Sekarang
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
</section>
@endsection
