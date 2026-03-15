@extends('layouts.app')

@section('content')
@php
    $defaults = [
        'hero_badge' => 'Masyarakat Ekonomi Syariah Kota Depok',
        'hero_title' => "Membangun Ekonomi Umat,\nMensejahterakan Bangsa",
        'hero_subtitle' => 'Wadah inklusif untuk mengembangkan ekonomi dan keuangan syariah yang berkeadilan, transparan, dan berkelanjutan di Kota Depok.',
        'hero_image' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop',
        'cta_primary_label' => 'Tentang Kami',
        'cta_primary_url' => '/about',
        'cta_secondary_label' => 'Lihat Program',
        'cta_secondary_url' => '/programs',
        'intro_image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2064&auto=format&fit=crop',
        'intro_title' => 'Mendorong Pertumbuhan Ekonomi Syariah yang Inklusif',
        'intro_body' => 'Masyarakat Ekonomi Syariah (MES) Depok hadir sebagai katalisator pengembangan ekonomi syariah di tingkat daerah. Kami berkomitmen untuk mensinergikan seluruh pemangku kepentingan demi terwujudnya sistem ekonomi yang adil dan mensejahterakan.',
        'intro_quote' => 'Sinergi untuk Ekonomi Syariah',
    ];

    $initial = [
        'hero_badge' => old('home.hero_badge', $settings['home.hero_badge'] ?? $defaults['hero_badge']),
        'hero_title' => old('home.hero_title', $settings['home.hero_title'] ?? $defaults['hero_title']),
        'hero_subtitle' => old('home.hero_subtitle', $settings['home.hero_subtitle'] ?? $defaults['hero_subtitle']),
        'hero_image' => old('home.hero_image', $settings['home.hero_image'] ?? $defaults['hero_image']),
        'cta_primary_label' => old('home.cta_primary_label', $settings['home.cta_primary_label'] ?? $defaults['cta_primary_label']),
        'cta_primary_url' => old('home.cta_primary_url', $settings['home.cta_primary_url'] ?? $defaults['cta_primary_url']),
        'cta_secondary_label' => old('home.cta_secondary_label', $settings['home.cta_secondary_label'] ?? $defaults['cta_secondary_label']),
        'cta_secondary_url' => old('home.cta_secondary_url', $settings['home.cta_secondary_url'] ?? $defaults['cta_secondary_url']),
        'intro_image' => old('home.intro_image', $settings['home.intro_image'] ?? $defaults['intro_image']),
        'intro_title' => old('home.intro_title', $settings['home.intro_title'] ?? $defaults['intro_title']),
        'intro_body' => old('home.intro_body', $settings['home.intro_body'] ?? $defaults['intro_body']),
        'intro_quote' => old('home.intro_quote', $settings['home.intro_quote'] ?? $defaults['intro_quote']),
    ];
@endphp

<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tampilan Landing Page</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola konten utama di halaman beranda (hero & pengantar).</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
        Buka Website
    </a>
</div>

@if(session('status'))
    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span>{{ session('status') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6" x-data="{ form: @js($initial) }">
    <x-card>
        <x-slot:title>Pengaturan Konten</x-slot:title>
        <form method="POST" action="{{ route('admin.appearance.home.save') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Hero Background Image (URL)</label>
                    <input name="home[hero_image]" x-model="form.hero_image" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="https://..." />
                    @error('home.hero_image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Badge</label>
                    <input name="home[hero_badge]" x-model="form.hero_badge" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" />
                    @error('home.hero_badge')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Judul Hero</label>
                    <textarea name="home[hero_title]" x-model="form.hero_title" rows="3" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                    <div class="mt-1 text-xs text-gray-500">Gunakan baris baru untuk memaksa pindah baris.</div>
                    @error('home.hero_title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="text-sm font-medium text-gray-700">Subjudul Hero</label>
                    <textarea name="home[hero_subtitle]" x-model="form.hero_subtitle" rows="3" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                    @error('home.hero_subtitle')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <div class="text-sm font-semibold text-gray-900 mb-3">Tombol Call-To-Action</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Label Tombol Utama</label>
                        <input name="home[cta_primary_label]" x-model="form.cta_primary_label" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" />
                        @error('home.cta_primary_label')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">URL Tombol Utama</label>
                        <input name="home[cta_primary_url]" x-model="form.cta_primary_url" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="/about atau https://..." />
                        @error('home.cta_primary_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Label Tombol Kedua</label>
                        <input name="home[cta_secondary_label]" x-model="form.cta_secondary_label" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" />
                        @error('home.cta_secondary_label')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">URL Tombol Kedua</label>
                        <input name="home[cta_secondary_url]" x-model="form.cta_secondary_url" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="/programs atau https://..." />
                        @error('home.cta_secondary_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <div class="text-sm font-semibold text-gray-900 mb-3">Bagian Pengantar</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Gambar Pengantar (URL)</label>
                        <input name="home[intro_image]" x-model="form.intro_image" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="https://..." />
                        @error('home.intro_image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Judul Pengantar</label>
                        <input name="home[intro_title]" x-model="form.intro_title" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" />
                        @error('home.intro_title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Isi Pengantar</label>
                        <textarea name="home[intro_body]" x-model="form.intro_body" rows="4" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                        @error('home.intro_body')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-sm font-medium text-gray-700">Quote di Gambar</label>
                        <input name="home[intro_quote]" x-model="form.intro_quote" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" />
                        @error('home.intro_quote')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <x-button variant="secondary" type="reset" x-data @click.prevent="form = @js($defaults)">Reset</x-button>
                <x-button type="submit">Simpan Perubahan</x-button>
            </div>
        </form>
    </x-card>

    <x-card>
        <x-slot:title>Preview</x-slot:title>
        <div class="rounded-2xl overflow-hidden border border-gray-200">
            <div class="relative bg-emerald-900 text-white px-6 py-14">
                <div class="absolute inset-0">
                    <img :src="form.hero_image" alt="" class="w-full h-full object-cover opacity-25">
                    <div class="absolute inset-0 bg-linear-to-t from-emerald-900 via-emerald-900/70 to-transparent"></div>
                </div>
                <div class="relative">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-800/50 backdrop-blur border border-emerald-700 text-emerald-100 text-sm mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span x-text="form.hero_badge"></span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4 leading-tight">
                        <template x-for="(line, idx) in (form.hero_title || '').split('\n')" :key="idx">
                            <span>
                                <span x-text="line"></span><br>
                            </span>
                        </template>
                    </h2>
                    <p class="text-emerald-100 max-w-2xl leading-relaxed mb-8" x-text="form.hero_subtitle"></p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a :href="form.cta_primary_url" class="inline-flex justify-center px-6 py-3 bg-emerald-500 hover:bg-emerald-400 rounded-xl font-semibold transition-colors">
                            <span x-text="form.cta_primary_label"></span>
                        </a>
                        <a :href="form.cta_secondary_url" class="inline-flex justify-center px-6 py-3 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl font-semibold transition-colors">
                            <span x-text="form.cta_secondary_label"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <div class="relative rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                        <img :src="form.intro_image" alt="" class="w-full h-56 object-cover">
                        <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent flex items-end p-5">
                            <p class="text-white font-medium" x-text="'“' + form.intro_quote + '”'"></p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3" x-text="form.intro_title"></h3>
                        <p class="text-gray-600 leading-relaxed" x-text="form.intro_body"></p>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
</div>
@endsection
