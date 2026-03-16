<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Org Portal') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>[x-cloak]{display:none!important}</style>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @else
        <script>
            window.tailwind=window.tailwind||{};window.tailwind.config={theme:{extend:{colors:{brand:'#16a34a'}}}}
        </script>
        <script src="https://cdn.tailwindcss.com/4.0.0"></script>
    @endif
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen">
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b border-gray-200">
            <div class="{{ request()->is('admin/*') ? 'w-full' : 'max-w-7xl mx-auto' }} px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if (request()->is('admin/*'))
                        <button type="button" x-data @click="$dispatch('toggle-sidebar')" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        @endif
                        <a href="{{ url('/') }}" class="flex items-center gap-2 {{ request()->is('admin/*') ? 'lg:pl-3' : '' }}">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-emerald-600 text-white font-semibold">EC</span>
                            <span class="font-semibold text-lg">EconoComm</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-3">
                        @auth
                            @php
                                $notificationsEnabled = \Illuminate\Support\Facades\Schema::hasTable('notifications');
                                $unreadCount = $notificationsEnabled ? auth()->user()->unreadNotifications()->count() : 0;
                                $latestNotifications = $notificationsEnabled
                                    ? auth()->user()->notifications()->latest()->limit(5)->get()
                                    : collect();
                            @endphp
                            <div x-data="{open:false}" class="relative">
                                <button @click="open=!open" class="relative p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                                    <svg class="h-6 w-6 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    @if($unreadCount > 0)
                                        <span class="absolute -top-0.5 -right-0.5 inline-flex min-w-4 h-4 px-1 items-center justify-center rounded-full bg-emerald-600 text-white text-[10px]">
                                            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                        </span>
                                    @endif
                                </button>
                                <div x-cloak x-show="open" @click.outside="open=false"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg ring-1 ring-black/5 overflow-hidden">
                                    <div class="px-4 py-3 border-b text-sm font-medium flex items-center justify-between">
                                        <span>Notifikasi</span>
                                        <a href="{{ route('notifications.index') }}" class="text-xs text-emerald-700 hover:underline">Lihat semua</a>
                                    </div>
                                    <div class="divide-y">
                                        @forelse($latestNotifications as $n)
                                            @php
                                                $title = $n->data['title'] ?? 'Notifikasi';
                                                $body = $n->data['body'] ?? null;
                                                $url = $n->data['url'] ?? route('notifications.index');
                                            @endphp
                                            <a href="{{ $url }}" class="block p-4 text-sm hover:bg-gray-50">
                                                <p class="font-medium {{ $n->read_at ? 'text-gray-900' : 'text-emerald-800' }}">{{ $title }}</p>
                                                @if($body)
                                                    <p class="text-gray-500 mt-0.5 line-clamp-2">{{ $body }}</p>
                                                @endif
                                            </a>
                                        @empty
                                            <div class="p-4 text-sm text-gray-500">Belum ada notifikasi.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endauth
                        <div x-data="{open:false}" class="relative">
                            <button @click="open=!open" class="flex items-center gap-3 focus:outline-none">
                                @php
                                    $avatar = auth()->check() && auth()->user()->avatar
                                        ? \Illuminate\Support\Facades\Storage::disk('public')->url(auth()->user()->avatar)
                                        : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Guest').'&background=16a34a&color=fff';
                                @endphp
                                <img class="h-9 w-9 rounded-full ring-2 ring-emerald-100 object-cover" src="{{ $avatar }}" alt="user">
                                <span class="hidden sm:block text-sm font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                                <svg class="h-4 w-4 text-gray-500 sm:block hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <div x-cloak x-show="open" @click.outside="open=false"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black/5 overflow-hidden">
                                @auth
                                    <a href="{{ url('/member/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Portal Anggota</a>
                                    @if(in_array(auth()->user()->role, ['member','super_admin','org_admin'], true))
                                        <a href="{{ route('member.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Edit Profil</a>
                                        <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Notifikasi</a>
                                    @endif
                                    @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'org_admin')
                                        <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Panel Admin</a>
                                    @endif
                                    <div class="border-t"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">Keluar</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Masuk</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="flex">
            @if (request()->is('admin/*'))
                <aside x-data="{open:true}" @toggle-sidebar.window="open=!open" class="w-72 shrink-0 border-r border-gray-200 bg-white min-h-[calc(100vh-4rem)] hidden lg:block" :class="{'hidden lg:block':!open}">
                    <div class="p-4">
                        <nav class="space-y-1">
                            @php
                                $navItems = [
                                    'dashboard' => [
                                        'label' => 'Dashboard',
                                        'href' => url('/admin/dashboard'),
                                        'active' => request()->is('admin/dashboard'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'members' => [
                                        'label' => 'Anggota',
                                        'href' => url('/admin/members'),
                                        'active' => request()->is('admin/members*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 20h5v-1a4 4 0 00-4-4h-1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 20H2v-1a4 4 0 014-4h3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11a4 4 0 10-8 0 4 4 0 008 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 8a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'programs' => [
                                        'label' => 'Program',
                                        'href' => url('/admin/programs'),
                                        'active' => request()->is('admin/programs*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2l1.5 4.5L18 8l-4.5 1.5L12 14l-1.5-4.5L6 8l4.5-1.5L12 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 13l1 3 3 1-3 1-1 3-1-3-3-1 3-1 1-3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'events' => [
                                        'label' => 'Agenda',
                                        'href' => url('/admin/events'),
                                        'active' => request()->is('admin/events*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M8 7V3m8 4V3M4 11h16M6 5h12a2 2 0 012 2v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'letters' => [
                                        'label' => 'Surat',
                                        'href' => url('/admin/letters'),
                                        'active' => request()->is('admin/letters*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 7a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 8l8 5 8-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'announcements' => [
                                        'label' => 'Pengumuman',
                                        'href' => url('/admin/announcements'),
                                        'active' => request()->is('admin/announcements*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M11 5l10-3v16l-10-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 10v4a2 2 0 002 2h1l1 4h3l-1-4h1a4 4 0 000-8H6a2 2 0 00-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'articles' => [
                                        'label' => 'Artikel',
                                        'href' => url('/admin/articles'),
                                        'active' => request()->is('admin/articles*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 2h11a3 3 0 013 3v15a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 6h8M8 10h8M8 14h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'applications' => [
                                        'label' => 'Pendaftaran Anggota',
                                        'href' => url('/admin/applications'),
                                        'active' => request()->is('admin/applications*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 3h6a2 2 0 012 2v2H7V5a2 2 0 012-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 7h10v14a2 2 0 01-2 2H9a2 2 0 01-2-2V7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 13l2 2 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'broadcast' => [
                                        'label' => 'Broadcast',
                                        'href' => url('/admin/broadcast'),
                                        'active' => request()->is('admin/broadcast*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 11a8 8 0 0116 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 11a5 5 0 0110 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 14a2 2 0 00-2 2v4h4v-4a2 2 0 00-2-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'notifications' => [
                                        'label' => 'Notifikasi',
                                        'href' => url('/admin/notifications'),
                                        'active' => request()->is('admin/notifications*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.73 21a2 2 0 01-3.46 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'consultations' => [
                                        'label' => 'Konsultasi',
                                        'href' => url('/admin/consultations'),
                                        'active' => request()->is('admin/consultations*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 15a4 4 0 01-4 4H8l-5 3V7a4 4 0 014-4h10a4 4 0 014 4v8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 10h8M8 14h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'partners' => [
                                        'label' => 'Mitra',
                                        'href' => url('/admin/partners'),
                                        'active' => request()->is('admin/partners*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 12l3-3a4 4 0 015.657 0L17 10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 12l5 5 3-3a2 2 0 012.828 0l1.172 1.172a2 2 0 002.828 0L22 10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'documents' => [
                                        'label' => 'Dokumen',
                                        'href' => url('/admin/documents'),
                                        'active' => request()->is('admin/documents*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 6a2 2 0 012-2h6l2 2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 10h20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'reports' => [
                                        'label' => 'Laporan',
                                        'href' => url('/admin/reports'),
                                        'active' => request()->is('admin/reports*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 19V5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 19h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 17v-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 17V9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 17v-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'appearance' => [
                                        'label' => 'Landing Page',
                                        'href' => url('/admin/appearance/home'),
                                        'active' => request()->is('admin/appearance*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 4h16v16H4V4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 9h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 20V9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 14h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                    'settings' => [
                                        'label' => 'Pengaturan',
                                        'href' => url('/admin/settings'),
                                        'active' => request()->is('admin/settings*'),
                                        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 15.5a3.5 3.5 0 110-7 3.5 3.5 0 010 7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M19.4 15a7.97 7.97 0 00.1-1 7.97 7.97 0 00-.1-1l2-1.5-2-3.5-2.4 1a8.36 8.36 0 00-1.7-1l-.4-2.6h-4l-.4 2.6a8.36 8.36 0 00-1.7 1l-2.4-1-2 3.5 2 1.5a7.97 7.97 0 00-.1 1c0 .34.03.67.1 1l-2 1.5 2 3.5 2.4-1a8.36 8.36 0 001.7 1l.4 2.6h4l.4-2.6a8.36 8.36 0 001.7-1l2.4 1 2-3.5-2-1.5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    ],
                                ];
                            @endphp

                            @foreach($navItems as $key => $item)
                                @php
                                    $active = (bool) ($item['active'] ?? false);
                                    $linkClasses = $active
                                        ? 'bg-emerald-50 text-emerald-800 ring-1 ring-emerald-100 shadow-sm'
                                        : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900';
                                    $iconWrapClasses = $active
                                        ? 'bg-emerald-600 text-white shadow'
                                        : 'bg-gray-50 text-gray-600 group-hover:bg-white group-hover:text-gray-900';
                                @endphp
                                <a href="{{ $item['href'] }}" class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 ease-out hover:translate-x-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500/40 {{ $linkClasses }}">
                                    <span class="h-9 w-9 inline-flex items-center justify-center rounded-lg transition-all duration-200 ease-out group-hover:scale-[1.03] {{ $iconWrapClasses }}">
                                        <span class="h-5 w-5 inline-block">{!! $item['icon'] !!}</span>
                                    </span>
                                    <span class="font-medium">{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>
            @endif
            <main class="flex-1 min-h-[calc(100vh-4rem)]">
                <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                    @yield('content')
                </div>
            </main>
        </div>
        <footer class="bg-gray-950 text-gray-300 mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-emerald-600 text-white font-semibold">EC</span>
                            <span class="font-semibold text-lg text-white">EconoComm</span>
                        </div>
                        <p class="mt-3 text-sm text-gray-400">Membangun komunitas ekonomi yang berkelanjutan melalui praktik etis dan pertumbuhan kolaboratif.</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Tautan Cepat</p>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a class="hover:text-white" href="{{ url('/about') }}">Tentang Kami</a></li>
                            <li><a class="hover:text-white" href="{{ route('member.dashboard') }}">Keanggotaan</a></li>
                            <li><a class="hover:text-white" href="{{ url('/events') }}">Agenda</a></li>
                            <li><a class="hover:text-white" href="{{ url('/news') }}">Berita</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Layanan</p>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a class="hover:text-white" href="#">Konsultasi</a></li>
                            <li><a class="hover:text-white" href="#">Sertifikasi</a></li>
                            <li><a class="hover:text-white" href="#">Pelatihan</a></li>
                            <li><a class="hover:text-white" href="#">Sumber Daya</a></li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Kontak</p>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a class="hover:text-white" href="mailto:info@mesdepok.org">info@mesdepok.org</a></li>
                            <li><span>+62 812-0000-0000</span></li>
                            <li><span>Kota Depok</span></li>
                            <li><span>Jawa Barat, Indonesia</span></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-800 pt-6 flex items-center justify-between text-sm">
                    <p class="text-gray-400">© {{ date('Y') }} EconoComm. Hak cipta dilindungi.</p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @livewireScripts
    @stack('scripts')
</body>
</html>

