@extends('layouts.public')

@section('hero')
    <div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=2033&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Sebaran Jaringan</h1>
            <p class="text-xl text-emerald-100 leading-relaxed">
                Jaringan kolaborasi MES Depok yang tersebar di berbagai sektor dan wilayah.
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-16">
    <!-- Map Section -->
    <section class="text-center">
        <div class="bg-emerald-50 rounded-2xl p-8 border border-emerald-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Peta Sebaran Anggota</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Anggota dan mitra MES Depok tersebar di 11 Kecamatan, memperkuat ekosistem ekonomi syariah di setiap sudut kota.
            </p>
            
            <div class="relative w-full aspect-video bg-emerald-200 rounded-xl overflow-hidden flex items-center justify-center">
                <!-- Placeholder for Map -->
                <div class="absolute inset-0 bg-[url('https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/Depok_City_Map.png/1200px-Depok_City_Map.png')] bg-cover bg-center opacity-50 mix-blend-multiply"></div>
                <div class="relative z-10 bg-white/90 backdrop-blur px-6 py-4 rounded-xl shadow-lg">
                    <div class="text-4xl font-bold text-emerald-600 mb-1">11</div>
                    <div class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Kecamatan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Network List -->
    <section>
        <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Mitra Strategis</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-emerald-200 transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Lembaga Keuangan</h3>
                </div>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li>• Bank Syariah Indonesia (BSI)</li>
                    <li>• Bank Muamalat</li>
                    <li>• BJB Syariah</li>
                    <li>• BPRS HIK Parahyangan</li>
                </ul>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-emerald-200 transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Pendidikan</h3>
                </div>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li>• Universitas Indonesia (PEBS)</li>
                    <li>• Gunadarma Sharia Center</li>
                    <li>• STEI SEBI</li>
                    <li>• Pesantren Al-Hamidiyah</li>
                </ul>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-emerald-200 transition">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900">Komunitas & Ormas</h3>
                </div>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li>• MUI Kota Depok</li>
                    <li>• Baznas Depok</li>
                    <li>• HIPMI Depok</li>
                    <li>• Salimah Depok</li>
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection
