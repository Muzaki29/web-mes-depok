<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle ?? ($title ?? 'MES Depok') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'MES Depok • Gerakan sosial ekonomi untuk kemaslahatan umat di Depok.' }}">
    <link rel="canonical" href="{{ $metaUrl ?? url()->current() }}">
    <meta property="og:type" content="{{ $metaType ?? 'website' }}">
    <meta property="og:title" content="{{ $metaTitle ?? ($title ?? 'MES Depok') }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'MES Depok • Gerakan sosial ekonomi untuk kemaslahatan umat di Depok.' }}">
    <meta property="og:image" content="{{ $metaImage ?? asset('images/og-default.png') }}">
    <meta property="og:url" content="{{ $metaUrl ?? url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?? ($title ?? 'MES Depok') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'MES Depok • Gerakan sosial ekonomi untuk kemaslahatan umat di Depok.' }}">
    <meta name="twitter:image" content="{{ $metaImage ?? asset('images/og-default.png') }}">
    @stack('meta')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @else
        <style>[x-cloak]{display:none!important}</style>
        <script>
            window.tailwind=window.tailwind||{};window.tailwind.config={theme:{extend:{colors:{brand:'#16a34a',gold:'#e8c547'},fontFamily:{sans:['DM Sans','ui-sans-serif','system-ui','sans-serif'],heading:['Manrope','ui-sans-serif','system-ui','sans-serif']}}}}
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        :root{--mes-gold:#e8c547}
        body{font-family:'DM Sans',ui-sans-serif,system-ui,sans-serif}
        h1,h2,h3,h4,.font-heading{font-family:'Manrope',ui-sans-serif,system-ui,sans-serif}
        .reveal{opacity:0;transform:translateY(12px);transition:all .6s cubic-bezier(.2,.8,.2,1)}
        .reveal-visible{opacity:1;transform:translateY(0)}
        [data-reveal]{opacity:0;transform:translateY(28px);transition:opacity .8s cubic-bezier(.2,.8,.2,1),transform .8s cubic-bezier(.2,.8,.2,1)}
        [data-reveal].reveal-visible{opacity:1;transform:translateY(0)}
        .nav-underline{background-image:linear-gradient(currentColor,currentColor);background-repeat:no-repeat;background-position:left calc(100% - 0px);background-size:0% 2px;transition:background-size .25s ease}
        .nav-underline:hover{background-size:100% 2px}
        .nav-underline.is-active{background-size:100% 2px}
        /* Gold highlight animation triggered on scroll-in */
        .gold-underline{background-image:linear-gradient(var(--mes-gold),var(--mes-gold));background-repeat:no-repeat;background-position:0 92%;background-size:0% 36%;transition:background-size 1s cubic-bezier(.2,.8,.2,1) .25s}
        .reveal-visible .gold-underline,.gold-underline.reveal-visible{background-size:100% 36%}
        /* Transparent vs solid navbar link colors */
        header.nav-transparent .navlink{color:#ffffff}
        header.nav-transparent .navlink:hover{color:var(--mes-gold)}
        header.nav-transparent .brand-text{color:#ffffff}
        header.nav-transparent .nav-toggle{color:#ffffff}
        header.nav-solid .navlink{color:#374151}
        header.nav-solid .navlink:hover{color:#059669}
        header.nav-solid .brand-text{color:#111827}
        header.nav-solid .navlink.is-active{color:#047857}
        /* Partner marquee */
        @keyframes mes-marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
        .marquee-track{display:flex;width:max-content;animation:mes-marquee 38s linear infinite}
        .marquee-wrap:hover .marquee-track{animation-play-state:paused}
        .animate-fade-in-up{animation:fadeInUp .9s cubic-bezier(.2,.8,.2,1) both}
        @keyframes fadeInUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ mobileMenuOpen: false, scrolled: false, searchOpen: false, isHome: {{ request()->is('/') ? 'true' : 'false' }} }" @scroll.window="scrolled = (window.pageYOffset > 20)" @keydown.escape.window="searchOpen = false">
    <header :class="(isHome && !scrolled) ? 'nav-transparent' : 'nav-solid bg-white shadow-sm'" class="fixed w-full top-0 z-50 transition-all duration-300">
        <!-- Top Bar -->
        <div :class="(isHome && !scrolled) ? 'bg-emerald-950/40 backdrop-blur-sm border-b border-white/10' : 'bg-emerald-900 border-b border-emerald-800'" class="hidden sm:block transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-8 items-center justify-between text-xs text-emerald-100">
                    <div class="flex items-center gap-2">
                        <a href="https://twitter.com/MESDepok" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 hover:text-white transition-colors">
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            <span class="font-medium">@MESDepok</span>
                        </a>
                        <span class="text-emerald-300/60">•</span>
                        <span class="hidden md:inline text-emerald-200/90">Gerakan ekonomi syariah untuk umat</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="https://instagram.com/mesdepok" target="_blank" rel="noopener" class="hover:text-white transition-colors" aria-label="Instagram">
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://youtube.com/@mesdepok" target="_blank" rel="noopener" class="hover:text-white transition-colors" aria-label="YouTube">
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0C.488 3.45.029 5.804 0 12c.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0C23.512 20.55 23.971 18.196 24 12c-.029-6.185-.484-8.549-4.385-8.816zM9 16V8l8 3.993L9 16z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('Logo MES.jpg') }}" alt="Logo MES Depok" class="h-11 w-11 rounded-lg object-cover shadow-sm ring-1 ring-gray-200/30 group-hover:shadow-md transition-shadow duration-200" />
                    <span class="brand-text font-heading font-bold text-lg tracking-tight transition-colors">MES Depok</span>
                </a>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">
                    <a class="navlink nav-underline py-1 {{ request()->is('/')?'is-active':'' }}" href="{{ url('/') }}">Beranda</a>
                    <div x-data="{open:false}" class="relative">
                        <button @mouseenter="open=true" @mouseleave="open=false" @click="open=!open" type="button" class="navlink nav-underline py-1 {{ request()->is('about*')?'is-active':'' }} inline-flex items-center gap-1 outline-none">
                            <span>Tentang</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor"><path d="M5.25 7.5 10 12.25 14.75 7.5" /></svg>
                        </button>
                        <div x-cloak x-show="open" @mouseenter="open=true" @mouseleave="open=false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-0 z-20 mt-2 w-56 rounded-xl bg-white shadow-xl ring-1 ring-black/5 p-2 origin-top-left">
                            <a href="{{ url('/about') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Profil Organisasi</a>
                            <a href="{{ url('/about/anggaran-dasar') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Anggaran Dasar</a>
                            <a href="{{ url('/about/visi-misi') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Visi dan Misi</a>
                            <a href="{{ url('/about/roadmap') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Roadmap Organisasi</a>
                            <a href="{{ url('/about/sebaran-jaringan') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Sebaran Jaringan</a>
                        </div>
                    </div>
                    <a class="navlink nav-underline py-1 {{ request()->is('programs')?'is-active':'' }}" href="{{ url('/programs') }}">Program</a>
                    <a class="navlink nav-underline py-1 {{ request()->is('news*')?'is-active':'' }}" href="{{ url('/news') }}">Berita</a>
                    <a class="navlink nav-underline py-1 {{ request()->is('events')?'is-active':'' }}" href="{{ url('/events') }}">Agenda</a>
                    <a class="navlink nav-underline py-1 {{ request()->is('membership')?'is-active':'' }}" href="{{ url('/membership') }}">Keanggotaan</a>
                    <a class="navlink nav-underline py-1 {{ request()->is('contact')?'is-active':'' }}" href="{{ url('/contact') }}">Kontak</a>
                </nav>

                <!-- Desktop Actions -->
                <div class="hidden md:flex items-center gap-2">
                    <!-- Search -->
                    <div class="relative">
                        <button @click="searchOpen = !searchOpen; $nextTick(() => { if (searchOpen) $refs.searchInput.focus() })" type="button" class="navlink p-2 rounded-lg hover:bg-black/5 transition-colors" aria-label="Cari">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </button>
                        <div x-cloak x-show="searchOpen" @click.outside="searchOpen = false"
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute right-0 z-30 mt-3 w-80 rounded-xl bg-white shadow-xl ring-1 ring-black/5 p-3 origin-top-right">
                            <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                                    </div>
                                    <input x-ref="searchInput" name="q" type="search" value="{{ request('q') }}" placeholder="Cari berita, agenda, program..." class="w-full pl-9 pr-3 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg placeholder:text-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                                </div>
                                <button type="submit" class="shrink-0 px-3 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors">Cari</button>
                            </form>
                        </div>
                    </div>
                    @auth
                        <a href="{{ url('/member/dashboard') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-lg bg-white/90 border border-emerald-200 text-emerald-700 hover:bg-emerald-50 transition-colors">Member Portal</a>
                        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'org_admin')
                            <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm shadow-emerald-200 transition-all hover:shadow-md">Admin</a>
                        @endif
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="nav-toggle inline-flex items-center justify-center p-2 rounded-md hover:bg-black/5 focus:outline-none transition-colors">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" x-cloak fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 z-50"></div>
            <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 shadow-2xl transition-transform origin-right" 
                 x-transition:enter="transform transition ease-in-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">
                <div class="flex items-center justify-between">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                        <img src="{{ asset('Logo MES.jpg') }}" alt="Logo MES Depok" class="h-9 w-9 rounded-lg object-cover shadow-sm ring-1 ring-gray-200/60" />
                        <span class="font-medium text-lg tracking-tight text-gray-900">MES Depok</span>
                    </a>
                    <button type="button" @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-700 hover:bg-gray-100 transition-colors">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <form action="{{ route('search') }}" method="GET" class="relative mb-3">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                                </div>
                                <input name="q" type="search" value="{{ request('q') }}" placeholder="Cari berita, agenda, program..." class="w-full pl-9 pr-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg placeholder:text-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                            </form>
                            <a href="{{ url('/') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">Beranda</a>
                            
                            <div x-data="{ subOpen: false }" class="-mx-3">
                                <button type="button" @click="subOpen = !subOpen" class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                                    Tentang
                                    <svg class="h-5 w-5 flex-none" :class="{ 'rotate-180': subOpen }" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                                </button>
                                <div x-show="subOpen" x-cloak class="mt-2 space-y-2 pl-6">
                                    <a href="{{ url('/about') }}" class="block rounded-lg py-2 pr-3 text-sm font-semibold leading-7 text-gray-600 hover:text-emerald-600 hover:bg-gray-50">Profil Organisasi</a>
                                    <a href="{{ url('/about/anggaran-dasar') }}" class="block rounded-lg py-2 pr-3 text-sm font-semibold leading-7 text-gray-600 hover:text-emerald-600 hover:bg-gray-50">Anggaran Dasar</a>
                                    <a href="{{ url('/about/visi-misi') }}" class="block rounded-lg py-2 pr-3 text-sm font-semibold leading-7 text-gray-600 hover:text-emerald-600 hover:bg-gray-50">Visi dan Misi</a>
                                    <a href="{{ url('/about/roadmap') }}" class="block rounded-lg py-2 pr-3 text-sm font-semibold leading-7 text-gray-600 hover:text-emerald-600 hover:bg-gray-50">Roadmap Organisasi</a>
                                    <a href="{{ url('/about/sebaran-jaringan') }}" class="block rounded-lg py-2 pr-3 text-sm font-semibold leading-7 text-gray-600 hover:text-emerald-600 hover:bg-gray-50">Sebaran Jaringan</a>
                                </div>
                            </div>
                            
                            <a href="{{ url('/programs') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">Program</a>
                            <a href="{{ url('/news') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">Berita</a>
                            <a href="{{ url('/events') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">Agenda</a>
                            <a href="{{ url('/membership') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">Keanggotaan</a>
                            <a href="{{ url('/contact') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 hover:text-emerald-600 transition-colors">Kontak</a>
                        </div>
                        <div class="py-6 space-y-3">
                            @auth
                                <a href="{{ url('/member/dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Member Portal</a>
                                @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'org_admin')
                                    <a href="{{ url('/admin/dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-emerald-600 hover:bg-emerald-50">Admin Dashboard</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="-mx-3">
                                    @csrf
                                    <button type="submit" class="block w-full text-left rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-red-600 hover:bg-red-50">Sign out</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="{{ request()->is('/') ? '' : 'pt-24' }}">

        @yield('hero')
        @isset($hero)
            {{ $hero }}
        @endisset
        
        @hasSection('fullwidth')
            @yield('fullwidth')
        @else
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            @yield('content')
            {{ $slot ?? '' }}
        </div>
        @endif
    </main>
    <footer class="bg-slate-950 text-gray-300 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('Logo MES.jpg') }}" alt="Logo MES Depok" class="h-10 w-10 rounded-lg object-cover ring-1 ring-white/10 shadow-lg" />
                        <span class="font-semibold text-lg text-white tracking-tight">MES Depok</span>
                    </div>
                    <p class="mt-4 text-sm text-gray-400 leading-relaxed">Masyarakat Ekonomi Syariah Kota Depok — Menebar manfaat untuk umat Depok berdaulat.</p>
                    <div class="mt-5 flex items-center gap-3">
                        <a href="https://twitter.com/MESDepok" target="_blank" rel="noopener" aria-label="Twitter" class="h-9 w-9 inline-flex items-center justify-center rounded-lg bg-white/5 hover:bg-emerald-600 text-gray-400 hover:text-white transition-all duration-200">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://instagram.com/mesdepok" target="_blank" rel="noopener" aria-label="Instagram" class="h-9 w-9 inline-flex items-center justify-center rounded-lg bg-white/5 hover:bg-emerald-600 text-gray-400 hover:text-white transition-all duration-200">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://youtube.com/@mesdepok" target="_blank" rel="noopener" aria-label="YouTube" class="h-9 w-9 inline-flex items-center justify-center rounded-lg bg-white/5 hover:bg-emerald-600 text-gray-400 hover:text-white transition-all duration-200">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0C.488 3.45.029 5.804 0 12c.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0C23.512 20.55 23.971 18.196 24 12c-.029-6.185-.484-8.549-4.385-8.816zM9 16V8l8 3.993L9 16z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white uppercase tracking-wider">Tautan</p>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ url('/about') }}">Tentang Kami</a></li>
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ url('/programs') }}">Program</a></li>
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ url('/events') }}">Agenda</a></li>
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ url('/news') }}">Berita</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white uppercase tracking-wider">Layanan</p>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ route('contact') }}">Konsultasi</a></li>
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ route('programs') }}">Sertifikasi</a></li>
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ route('programs') }}">Pelatihan</a></li>
                        <li><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="{{ route('membership') }}">Keanggotaan</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white uppercase tracking-wider">Kontak</p>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li class="flex items-center gap-2"><svg class="h-4 w-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg><a class="text-gray-400 hover:text-emerald-400 transition-colors" href="mailto:info@mesdepok.org">info@mesdepok.org</a></li>
                        <li class="flex items-center gap-2"><svg class="h-4 w-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg><span class="text-gray-400">+62 812-3456-7890</span></li>
                        <li class="flex items-start gap-2"><svg class="h-4 w-4 text-emerald-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg><span class="text-gray-400">Depok, Jawa Barat, Indonesia</span></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 border-t border-white/10 pt-7 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm">
                <p class="text-gray-500">© {{ date('Y') }} MES Kota Depok. Hak cipta dilindungi.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('about') }}" class="text-gray-500 hover:text-gray-300 transition-colors">Kebijakan Privasi</a>
                    <a href="{{ route('about.statute') }}" class="text-gray-500 hover:text-gray-300 transition-colors">Syarat & Ketentuan</a>
                    @auth
                        <a href="{{ url('/member/dashboard') }}" class="text-gray-500 hover:text-gray-300 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-300 transition-colors">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scroll to Top Button -->
    <button x-cloak x-show="scrolled" @click="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-8 right-8 z-40 p-3 bg-emerald-600 text-white rounded-full shadow-lg hover:bg-emerald-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    <script>
        // Scroll reveal animations
        const o=new IntersectionObserver((e)=>{e.forEach(i=>{i.isIntersecting&&(i.target.classList.add('reveal-visible'),o.unobserve(i.target))})},{threshold:.15});
        document.querySelectorAll('[data-reveal]').forEach(el=>{o.observe(el)});

        // Animated counters (count up from 0 when entering viewport)
        const easeOut = t => 1 - Math.pow(1 - t, 3);
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                counterObserver.unobserve(el);
                const target = parseInt(el.getAttribute('data-counter') || '0', 10);
                const duration = 1800;
                const start = performance.now();
                const step = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const value = Math.floor(easeOut(progress) * target);
                    el.textContent = value.toLocaleString('id-ID');
                    if (progress < 1) requestAnimationFrame(step);
                    else el.textContent = target.toLocaleString('id-ID');
                };
                requestAnimationFrame(step);
            });
        }, { threshold: 0.4 });
        document.querySelectorAll('[data-counter]').forEach(el => counterObserver.observe(el));
    </script>
    @livewireScripts
    </body>
    </html>
