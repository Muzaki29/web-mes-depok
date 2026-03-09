<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Org Portal') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @else
        <style>[x-cloak]{display:none!important}</style>
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        @if (request()->is('admin/*'))
                        <button type="button" x-data @click="$dispatch('toggle-sidebar')" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        @endif
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-emerald-600 text-white font-semibold">EC</span>
                            <span class="font-semibold text-lg">EconoComm</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-3">
                        <div x-data="{open:false}" class="relative">
                            <button @click="open=!open" class="relative p-2 rounded-full hover:bg-gray-100 focus:outline-none">
                                <svg class="h-6 w-6 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span class="absolute -top-0.5 -right-0.5 inline-flex h-4 w-4 items-center justify-center rounded-full bg-emerald-600 text-white text-[10px]">3</span>
                            </button>
                            <div x-cloak x-show="open" @click.outside="open=false" class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg ring-1 ring-black/5 overflow-hidden">
                                <div class="px-4 py-3 border-b text-sm font-medium">Notifications</div>
                                <div class="divide-y">
                                    <div class="p-4 text-sm">
                                        <p class="font-medium">Membership renewal reminder</p>
                                        <p class="text-gray-500">Your membership expires in 30 days.</p>
                                    </div>
                                    <div class="p-4 text-sm">
                                        <p class="font-medium">New event invitation</p>
                                        <p class="text-gray-500">Member Networking Night</p>
                                    </div>
                                    <div class="p-4 text-sm">
                                        <p class="font-medium">Certificate available</p>
                                        <p class="text-gray-500">Workshop certificate ready for download.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-data="{open:false}" class="relative">
                            <button @click="open=!open" class="flex items-center gap-3 focus:outline-none">
                                <img class="h-9 w-9 rounded-full ring-2 ring-emerald-100" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=16a34a&color=fff" alt="user">
                                <span class="hidden sm:block text-sm font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                                <svg class="h-4 w-4 text-gray-500 sm:block hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <div x-cloak x-show="open" @click.outside="open=false" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black/5 overflow-hidden">
                                @auth
                                    <a href="{{ url('/member/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Member Portal</a>
                                    @if(auth()->user()->role === 'super_admin' || auth()->user()->role === 'org_admin')
                                        <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Admin Panel</a>
                                    @endif
                                    <div class="border-t"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">Sign out</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Sign in</a>
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
                            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-emerald-50 hover:text-emerald-700 {{ request()->is('admin/dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700' }}">
                                <span class="h-5 w-5 inline-block"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                <span>Dashboard</span>
                            </a>
                            @php $items = ['members'=>'Members','programs'=>'Programs','events'=>'Events','letters'=>'Letters','announcements'=>'Announcements','articles'=>'Articles','applications'=>'Membership Applications','broadcast'=>'Broadcast','consultations'=>'Consultations','partners'=>'Partners','documents'=>'Documents','reports'=>'Reports','settings'=>'Settings']; @endphp
                            @foreach($items as $key=>$label)
                                <a href="{{ url('/admin/'.$key) }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-50 {{ request()->is('admin/'.$key.'*') ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }}">
                                    <span class="h-5 w-5 inline-block"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="2"/></svg></span>
                                    <span>{{ $label }}</span>
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
                        <p class="mt-3 text-sm text-gray-400">Building sustainable economic communities through ethical practices and collaborative growth.</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Quick Links</p>
                        <ul class="mt-3 space-y-2 text-sm">
                            <li><a class="hover:text-white" href="{{ url('/about') }}">About Us</a></li>
                            <li><a class="hover:text-white" href="{{ route('member.dashboard') }}">Membership</a></li>
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
                            <li><a class="hover:text-white" href="mailto:contact@econocomm.org">contact@econocomm.org</a></li>
                            <li><span>+1 (555) 123–4567</span></li>
                            <li><span>123 Business District</span></li>
                            <li><span>Economic City, EC 12345</span></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-800 pt-6 flex items-center justify-between text-sm">
                    <p class="text-gray-400">© {{ date('Y') }} EconoComm. All rights reserved.</p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="hover:text-white">Privacy Policy</a>
                        <a href="#" class="hover:text-white">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>
</html>

