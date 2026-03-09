@extends('layouts.public')

@section('hero')
    <div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1529400971008-f566de0e6dfc?q=80&w=2070&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Roadmap Organisasi</h1>
            <p class="text-xl text-emerald-100 leading-relaxed">
                Peta jalan strategis MES Depok dalam mewujudkan visi ekonomi syariah.
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="space-y-12">
        <!-- Phase 1 -->
        <div class="relative pl-8 md:pl-0">
            <div class="md:flex items-center justify-between group">
                <div class="md:w-5/12 text-left md:text-right md:pr-8 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-900">Fase 1: Penguatan Fondasi</h3>
                    <div class="text-emerald-600 font-semibold mb-2">2023 - 2024</div>
                    <p class="text-gray-600">Fokus pada konsolidasi organisasi, penguatan database anggota, dan sosialisasi dasar ekonomi syariah ke masyarakat luas.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-4 h-4 bg-emerald-500 rounded-full border-4 border-white shadow -translate-x-1.5 md:-translate-x-2"></div>
                <div class="md:w-5/12 md:pl-8">
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Pembentukan pengurus lengkap</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Digitalisasi keanggotaan</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Roadshow kampus & pesantren</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Connector Line -->
        <div class="absolute left-2 md:left-1/2 top-0 bottom-0 w-0.5 bg-gray-200 -z-10 transform md:-translate-x-0.5"></div>

        <!-- Phase 2 -->
        <div class="relative pl-8 md:pl-0">
            <div class="md:flex flex-row-reverse items-center justify-between group">
                <div class="md:w-5/12 text-left md:pl-8 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-900">Fase 2: Akselerasi Program</h3>
                    <div class="text-emerald-600 font-semibold mb-2">2025 - 2026</div>
                    <p class="text-gray-600">Implementasi program-program unggulan yang berdampak langsung pada sektor riil dan UMKM.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-4 h-4 bg-white border-4 border-emerald-500 rounded-full shadow -translate-x-1.5 md:-translate-x-2"></div>
                <div class="md:w-5/12 md:pr-8 md:text-right">
                    <ul class="space-y-2 text-sm text-gray-600 inline-block text-left">
                        <li class="flex items-center gap-2"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Inkubasi Bisnis Syariah</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Sertifikasi Halal Massal</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Kemitraan Lembaga Keuangan</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Phase 3 -->
        <div class="relative pl-8 md:pl-0">
            <div class="md:flex items-center justify-between group">
                <div class="md:w-5/12 text-left md:text-right md:pr-8 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-900">Fase 3: Ekspansi & Kolaborasi</h3>
                    <div class="text-emerald-600 font-semibold mb-2">2027 - 2028</div>
                    <p class="text-gray-600">Memperluas jangkauan dampak hingga ke tingkat regional dan nasional serta membangun ekosistem digital yang terintegrasi.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-4 h-4 bg-white border-4 border-gray-300 rounded-full shadow -translate-x-1.5 md:-translate-x-2"></div>
                <div class="md:w-5/12 md:pl-8">
                     <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><span class="w-2 h-2 bg-gray-300 rounded-full"></span> Hub Ekspor Halal</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 bg-gray-300 rounded-full"></span> Smart Sharia City</li>
                        <li class="flex items-center gap-2"><span class="w-2 h-2 bg-gray-300 rounded-full"></span> Global Forum Participation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
