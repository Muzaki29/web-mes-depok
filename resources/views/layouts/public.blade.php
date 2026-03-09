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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @else
        <style>[x-cloak]{display:none!important}</style>
        <script>
            window.tailwind=window.tailwind||{};window.tailwind.config={theme:{extend:{colors:{brand:'#16a34a'}}}}
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .reveal{opacity:0;transform:translateY(12px);transition:all .6s cubic-bezier(.2,.8,.2,1)}
        .reveal-visible{opacity:1;transform:translateY(0)}
        .nav-underline{background-image:linear-gradient(#16a34a,#16a34a);background-repeat:no-repeat;background-position:left calc(100% - 0px);background-size:0% 2px;transition:background-size .25s ease}
        .nav-underline:hover{background-size:100% 2px}
        .nav-underline.is-active{background-size:100% 2px}
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    <header :class="{ 'bg-white/95 backdrop-blur shadow-md': scrolled, 'bg-white border-b border-gray-200': !scrolled }" class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-emerald-600 text-white font-semibold shadow-sm">MD</span>
                    <span class="font-semibold text-lg tracking-tight">MES Depok</span>
                </a>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a class="nav-underline py-1 {{ request()->is('/')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }}" href="{{ url('/') }}">Beranda</a>
                    <div x-data="{open:false}" class="relative">
                        <button @mouseenter="open=true" @mouseleave="open=false" @click="open=!open" type="button" class="nav-underline py-1 {{ request()->is('about*')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }} inline-flex items-center gap-1 outline-none">
                            <span>Tentang</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor"><path d="M5.25 7.5 10 12.25 14.75 7.5" /></svg>
                        </button>
                        <div x-cloak x-show="open" @mouseenter="open=true" @mouseleave="open=false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-0 z-20 mt-2 w-56 rounded-xl bg-white shadow-xl ring-1 ring-black/5 p-2 origin-top-left">
                            <a href="{{ url('/about') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Profil Organisasi</a>
                            <a href="{{ url('/about/anggaran-dasar') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Anggaran Dasar</a>
                            <a href="{{ url('/about/visi-misi') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Visi dan Misi</a>
                            <a href="{{ url('/about/roadmap') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Roadmap Organisasi</a>
                            <a href="{{ url('/about/sebaran-jaringan') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-700 transition-colors">Sebaran Jaringan</a>
                        </div>
                    </div>
                    <a class="nav-underline py-1 {{ request()->is('programs')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }}" href="{{ url('/programs') }}">Program</a>
                    <a class="nav-underline py-1 {{ request()->is('news*')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }}" href="{{ url('/news') }}">Berita</a>
                    <a class="nav-underline py-1 {{ request()->is('events')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }}" href="{{ url('/events') }}">Agenda</a>
                    <a class="nav-underline py-1 {{ request()->is('membership')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }}" href="{{ url('/membership') }}">Keanggotaan</a>
                    <a class="nav-underline py-1 {{ request()->is('contact')?'is-active text-emerald-700':'text-gray-700 hover:text-emerald-600' }}" href="{{ url('/contact') }}">Kontak</a>
                </nav>

                <!-- Desktop Actions -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ url('/member/dashboard') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg border border-emerald-200 text-emerald-700 hover:bg-emerald-50 transition-colors">Member Portal</a>
                        @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'org_admin')
                            <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm shadow-emerald-200 transition-all hover:shadow-md">Admin</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm shadow-emerald-200 transition-all hover:shadow-md">Sign in</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-emerald-600 hover:bg-gray-100 focus:outline-none transition-colors">
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
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-emerald-600 text-white font-semibold shadow-sm">MD</span>
                        <span class="font-semibold text-lg tracking-tight">MES Depok</span>
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
                            @else
                                <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Sign in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="pt-16">

        @yield('hero')
        @isset($hero)
            {{ $hero }}
        @endisset
        
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </main>
    <footer class="bg-gray-950 text-gray-300 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-emerald-600 text-white font-semibold">MD</span>
                        <span class="font-semibold text-lg text-white">MES Depok</span>
                    </div>
                    <p class="mt-3 text-sm text-gray-400">Gerakan sosial ekonomi untuk kemaslahatan umat di Depok.</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Quick Links</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a class="hover:text-white" href="{{ url('/about') }}">About Us</a></li>
                        <li><a class="hover:text-white" href="{{ url('/programs') }}">Programs</a></li>
                        <li><a class="hover:text-white" href="{{ url('/events') }}">Events</a></li>
                        <li><a class="hover:text-white" href="{{ url('/news') }}">News</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Services</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a class="hover:text-white" href="#">Consultation</a></li>
                        <li><a class="hover:text-white" href="#">Certification</a></li>
                        <li><a class="hover:text-white" href="#">Training</a></li>
                        <li><a class="hover:text-white" href="#">Resources</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Contact</p>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a class="hover:text-white" href="mailto:info@mesdepok.org">info@mesdepok.org</a></li>
                        <li><span>+62 812-3456-7890</span></li>
                        <li><span>Depok, Jawa Barat</span></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-800 pt-6 flex items-center justify-between text-sm">
                <p class="text-gray-400">© {{ date('Y') }} MES Depok. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scroll to Top Button -->
    <button x-cloak x-show="scrolled" @click="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-8 right-8 z-40 p-3 bg-emerald-600 text-white rounded-full shadow-lg hover:bg-emerald-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    <script>
        const o=new IntersectionObserver((e)=>{e.forEach(i=>{i.isIntersecting&&i.target.classList.add('reveal-visible')})},{threshold:.15});
        document.querySelectorAll('[data-reveal]').forEach(el=>{o.observe(el)});
    </script>
    @livewireScripts
    </body>
    </html>
