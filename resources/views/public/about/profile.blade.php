@extends('layouts.public')

@section('hero')
<section class="relative bg-linear-to-br from-emerald-900 via-emerald-800 to-teal-900 py-24 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-20 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl"></div>
    <div class="relative max-w-3xl mx-auto">
        <span class="text-sm font-semibold uppercase tracking-widest text-emerald-300">Tentang Kami</span>
        <h1 class="font-heading text-4xl md:text-5xl font-extrabold mt-3 mb-6">Mengenal MES Depok</h1>
        <p class="text-lg text-emerald-100/90 leading-relaxed">
            Masyarakat Ekonomi Syariah (MES) Daerah Depok adalah organisasi nirlaba yang bertujuan mengembangkan dan mempercepat penerapan sistem ekonomi dan keuangan syariah di Kota Depok.
        </p>
    </div>
</section>
@endsection

@section('content')
<div class="space-y-20 lg:space-y-28 py-4">
    {{-- Intro: two columns --}}
    <section class="grid lg:grid-cols-2 gap-12 items-center" data-reveal>
        <div>
            <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Profil Organisasi</span>
            <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-6">Siapa <span class="gold-underline">Kami?</span></h2>
            <div class="text-gray-600 space-y-4 leading-relaxed">
                <p>
                    Masyarakat Ekonomi Syariah (MES) merupakan wadah inklusif bagi seluruh pemangku kepentingan ekonomi syariah. Kami menghimpun praktisi, akademisi, ulama, pengusaha, dan masyarakat umum yang peduli terhadap perkembangan ekonomi yang berkeadilan.
                </p>
                <p>
                    Di Depok, kami hadir untuk menjadi katalisator pertumbuhan ekonomi syariah yang nyata, menyentuh sektor riil, dan memberikan dampak positif bagi kesejahteraan masyarakat Kota Depok.
                </p>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-emerald-100 rounded-2xl transform rotate-3"></div>
            <img src="https://images.unsplash.com/photo-1577412647305-991150c7d163?q=80&w=2070&auto=format&fit=crop" alt="Kegiatan MES Depok" class="relative rounded-2xl shadow-xl w-full h-72 object-cover">
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="grid lg:grid-cols-2 gap-8">
        <div class="bg-linear-to-br from-emerald-600 to-emerald-700 rounded-2xl p-8 lg:p-10 text-white shadow-lg" data-reveal>
            <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mb-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-heading text-2xl font-bold mb-4">Visi</h3>
            <p class="text-emerald-50/90 leading-relaxed">
                Menjadi organisasi penggerak utama ekonomi syariah di Kota Depok yang inklusif, profesional, dan berdampak nyata bagi kesejahteraan umat.
            </p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-8 lg:p-10 shadow-sm" data-reveal>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="font-heading text-2xl font-bold text-gray-900 mb-4">Misi</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-3"><span class="mt-1 w-5 h-5 shrink-0 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>Meningkatkan edukasi dan literasi ekonomi syariah masyarakat.</li>
                <li class="flex items-start gap-3"><span class="mt-1 w-5 h-5 shrink-0 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>Mengembangkan usaha dan kemitraan berbasis syariah.</li>
                <li class="flex items-start gap-3"><span class="mt-1 w-5 h-5 shrink-0 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>Mengadvokasi kebijakan yang mendukung ekonomi syariah.</li>
                <li class="flex items-start gap-3"><span class="mt-1 w-5 h-5 shrink-0 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></span>Memperkuat sinergi antar pemangku kepentingan.</li>
            </ul>
        </div>
    </section>

    {{-- Nilai-Nilai --}}
    <section class="bg-gray-50 rounded-2xl p-8 md:p-12" data-reveal>
        <div class="text-center mb-10">
            <h2 class="font-heading text-3xl font-bold text-gray-900">Nilai-Nilai Utama</h2>
            <p class="mt-2 text-gray-600">Landasan kami dalam bergerak dan berkarya.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-lg mb-2">Inklusif</h3>
                <p class="text-sm text-gray-600">Terbuka bagi semua kalangan yang ingin berkontribusi pada ekonomi syariah.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-lg mb-2">Progresif</h3>
                <p class="text-sm text-gray-600">Selalu berinovasi dan adaptif terhadap perkembangan zaman dan teknologi.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="font-heading font-bold text-lg mb-2">Kontributif</h3>
                <p class="text-sm text-gray-600">Memberikan dampak nyata bagi penguatan ekonomi umat dan bangsa.</p>
            </div>
        </div>
    </section>

    {{-- Struktur Organisasi --}}
    @php
        $orgMembers = \Illuminate\Support\Facades\Cache::remember('org_structure', 600, function () {
            return \App\Models\OrganizationMember::where('status', 'active')
                ->orderBy('sort_order')
                ->get()
                ->groupBy('division');
        });
        $divisionOrder = [
            'Dewan Pembina',
            'Dewan Pakar',
            'Badan Pengurus Harian',
        ];
        // Remaining divisions (departments) sorted by sort_order of first member
        $departments = $orgMembers->filter(fn ($group, $key) => !in_array($key, $divisionOrder))->sortBy(fn ($group) => $group->first()->sort_order ?? 999);
    @endphp
    <section data-reveal>
        <div class="text-center mb-12">
            <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Kepengurusan</span>
            <h2 class="font-heading text-3xl lg:text-4xl font-bold text-gray-900 mt-3">Struktur Organisasi</h2>
            <p class="text-gray-600 mt-2">Pengurus Daerah MES Depok Periode 2026–2029</p>
        </div>

        {{-- Top boards (Pembina, Pakar, BPH) --}}
        @foreach($divisionOrder as $div)
            @if($orgMembers->has($div))
            <div class="mb-10">
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-5 text-center">{{ $div }}</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 max-w-5xl mx-auto">
                    @foreach($orgMembers[$div] as $m)
                    <div class="text-center group">
                        <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 ring-2 ring-emerald-200 overflow-hidden mb-3">
                            @if($m->photo)
                                <img src="{{ asset('storage/'.$m->photo) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="font-heading font-bold text-lg">{{ strtoupper(substr($m->name, 0, 2)) }}</span>
                            @endif
                        </div>
                        <p class="font-heading font-semibold text-sm text-gray-900 leading-snug">{{ $m->name }}</p>
                        <p class="text-xs text-emerald-600 mt-0.5">{{ $m->position }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach

        {{-- Departments --}}
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($departments as $divName => $members)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
                <h4 class="font-heading font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100 text-sm">{{ $divName }}</h4>
                <ul class="space-y-3">
                    @foreach($members as $m)
                    <li class="flex items-center gap-3">
                        <div class="w-9 h-9 shrink-0 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-700 text-xs font-bold ring-1 ring-emerald-100 overflow-hidden">
                            @if($m->photo)
                                <img src="{{ asset('storage/'.$m->photo) }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($m->name, 0, 2)) }}
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $m->name }}</p>
                            <p class="text-xs text-gray-500">{{ $m->position }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Sejarah Timeline --}}
    <section data-reveal>
        <div class="text-center mb-12">
            <span class="text-sm font-semibold uppercase tracking-widest text-emerald-600">Perjalanan Kami</span>
            <h2 class="font-heading text-3xl font-bold text-gray-900 mt-3">Sejarah Singkat MES Depok</h2>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <div class="absolute left-4 sm:left-1/2 top-0 bottom-0 w-px bg-emerald-200 sm:-translate-x-px"></div>
            @php
                $timeline = [
                    ['year' => '2016', 'title' => 'Pembentukan Awal', 'desc' => 'Inisiasi pembentukan pengurus MES di tingkat Kota Depok oleh para penggiat ekonomi syariah.'],
                    ['year' => '2019', 'title' => 'Penguatan Organisasi', 'desc' => 'Konsolidasi struktur kepengurusan dan perluasan program edukasi literasi syariah.'],
                    ['year' => '2023', 'title' => 'Ekspansi Program', 'desc' => 'Peningkatan kemitraan strategis dengan lembaga keuangan dan UMKM syariah di Depok.'],
                    ['year' => '2026', 'title' => 'Transformasi Digital', 'desc' => 'Digitalisasi layanan keanggotaan dan tata kelola organisasi untuk jangkauan yang lebih luas.'],
                ];
            @endphp
            <div class="space-y-8">
                @foreach($timeline as $i => $t)
                <div class="relative flex flex-col sm:flex-row gap-4 sm:gap-8 {{ $i % 2 === 0 ? 'sm:flex-row' : 'sm:flex-row-reverse' }}">
                    <div class="hidden sm:block sm:w-1/2"></div>
                    <div class="absolute left-4 sm:left-1/2 w-3 h-3 rounded-full bg-emerald-600 ring-4 ring-emerald-100 -translate-x-1 sm:-translate-x-1.5 mt-1.5"></div>
                    <div class="pl-12 sm:pl-0 sm:w-1/2 {{ $i % 2 === 0 ? 'sm:pl-8' : 'sm:pr-8 sm:text-right' }}">
                        <div class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold mb-2">{{ $t['year'] }}</div>
                        <h3 class="font-heading text-lg font-bold text-gray-900">{{ $t['title'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $t['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Quote --}}
    <section class="text-center max-w-2xl mx-auto" data-reveal>
        <svg class="w-12 h-12 mx-auto text-emerald-200 mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.0547 15.592 14.4793 17.5373 14.4793H19.9853L19.9853 21H14.017ZM8.01732 21L8.01732 18C8.01732 16.0547 9.59268 14.4793 11.538 14.4793H13.986L13.986 21H8.01732Z"/></svg>
        <blockquote class="font-heading text-xl lg:text-2xl font-medium text-gray-900 italic leading-relaxed">
            "Ekonomi Syariah bukan hanya untuk umat Islam, tetapi sistem universal yang menawarkan keadilan, kejujuran, dan kesejahteraan bagi seluruh umat manusia."
        </blockquote>
    </section>

    {{-- Sub-page navigation cards --}}
    <section data-reveal>
        <div class="text-center mb-10">
            <h2 class="font-heading text-2xl font-bold text-gray-900">Jelajahi Lebih Lanjut</h2>
            <p class="text-gray-600 mt-2">Informasi lengkap seputar organisasi MES Depok.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $subpages = [
                    ['url' => url('/about/visi-misi'), 'title' => 'Visi dan Misi', 'desc' => 'Arah dan tujuan organisasi.', 'icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['url' => url('/about/anggaran-dasar'), 'title' => 'Anggaran Dasar', 'desc' => 'Landasan hukum organisasi.', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z'],
                    ['url' => url('/about/roadmap'), 'title' => 'Roadmap', 'desc' => 'Peta jalan organisasi.', 'icon' => 'M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z'],
                    ['url' => url('/about/sebaran-jaringan'), 'title' => 'Sebaran Jaringan', 'desc' => 'Jangkauan jaringan MES.', 'icon' => 'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418'],
                ];
            @endphp
            @foreach($subpages as $sp)
            <a href="{{ $sp['url'] }}" class="group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $sp['icon'] }}"/></svg>
                </div>
                <h3 class="font-heading font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $sp['title'] }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $sp['desc'] }}</p>
            </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
