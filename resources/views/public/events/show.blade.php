@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-emerald-100">
            <!-- Hero Image -->
            <div class="relative h-64 md:h-96 w-full">
                @if($event->thumbnail)
                    <img src="{{ Storage::url($event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-linear-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                        <svg class="w-24 h-24 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-bold text-emerald-700 shadow-sm">
                    {{ $event->category ?? 'Event' }}
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3">
                <!-- Event Details (Left) -->
                <div class="lg:col-span-2 p-8 lg:p-12 border-b lg:border-b-0 lg:border-r border-gray-100">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $event->title }}</h1>
                    
                    <div class="flex flex-col sm:flex-row gap-6 mb-8 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Tanggal & Waktu</p>
                                <p>{{ $event->start_at->format('d F Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Lokasi</p>
                                <p>{{ $event->location ?? 'Online / To be announced' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-emerald max-w-none text-gray-600">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Acara</h3>
                        <p class="whitespace-pre-line">{{ $event->description }}</p>
                    </div>
                </div>

                <!-- Registration Form (Right) -->
                <div class="p-8 lg:p-12 bg-emerald-50/50">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-emerald-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Daftar Acara</h3>
                        
                        @if(session('status'))
                            <div class="mb-6 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 rounded-md bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($event->start_at->isPast())
                             <div class="text-center py-6">
                                <span class="px-4 py-2 rounded-full bg-gray-200 text-gray-600 font-semibold text-sm">Event Telah Selesai</span>
                             </div>
                        @elseif($event->capacity && $event->registrations->count() >= $event->capacity)
                             <div class="text-center py-6">
                                <span class="px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold text-sm">Kuota Penuh</span>
                             </div>
                        @else
                            <form action="{{ route('events.register', $event->slug) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm" required>
                                </div>
                                <button type="submit" class="w-full bg-emerald-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition shadow-lg shadow-emerald-200">
                                    Daftar Sekarang
                                </button>
                            </form>
                            <p class="text-xs text-gray-500 mt-4 text-center">
                                Dengan mendaftar, Anda menyetujui kebijakan privasi kami.
                            </p>
                        @endif
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold text-gray-900 mb-4">Bagikan Event</h4>
                        <div class="flex gap-4">
                            <!-- Social Share Buttons (Mockup) -->
                            <button class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-emerald-600 hover:border-emerald-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-emerald-600 hover:border-emerald-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-emerald-600 hover:border-emerald-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
