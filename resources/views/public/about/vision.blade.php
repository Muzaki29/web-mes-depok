@extends('layouts.public')

@section('hero')
    <div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2070&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Visi & Misi</h1>
            <p class="text-xl text-emerald-100 leading-relaxed">
                Arah perjuangan dan langkah nyata kami dalam mewujudkan ekonomi yang berkeadilan.
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-20">
    <!-- Vision -->
    <section class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Visi</h2>
        <div class="max-w-3xl mx-auto bg-emerald-50 rounded-2xl p-8 md:p-12 border border-emerald-100 shadow-sm">
            <p class="text-2xl font-serif text-emerald-800 leading-relaxed">
                "Ekonomi Syariah menjadi arus utama perekonomian nasional dan menjadikannya sebagai gaya hidup masyarakat."
            </p>
        </div>
    </section>

    <!-- Mission -->
    <section>
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Misi</h2>
            <p class="mt-2 text-gray-600">Langkah-langkah strategis untuk mencapai visi.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="flex gap-4 p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="shrink-0 w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">1</div>
                <div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Edukasi & Literasi</h3>
                    <p class="text-gray-600">Meningkatkan pemahaman masyarakat tentang ekonomi dan keuangan syariah melalui sosialisasi yang berkelanjutan.</p>
                </div>
            </div>
            <div class="flex gap-4 p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="shrink-0 w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">2</div>
                <div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Pengembangan SDM</h3>
                    <p class="text-gray-600">Mempersiapkan sumber daya manusia yang kompeten dan profesional di bidang ekonomi syariah.</p>
                </div>
            </div>
            <div class="flex gap-4 p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="shrink-0 w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">3</div>
                <div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Penguatan Industri</h3>
                    <p class="text-gray-600">Mendorong pertumbuhan industri halal dan keuangan syariah yang berdaya saing.</p>
                </div>
            </div>
            <div class="flex gap-4 p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="shrink-0 w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">4</div>
                <div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Sinergi & Kolaborasi</h3>
                    <p class="text-gray-600">Membangun kemitraan strategis dengan pemerintah, swasta, dan ormas untuk percepatan ekonomi syariah.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
