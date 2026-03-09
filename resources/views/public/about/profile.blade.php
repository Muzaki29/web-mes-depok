@extends('layouts.public')

@section('hero')
    <div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=2074&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Tentang MES Depok</h1>
            <p class="text-xl text-emerald-100 leading-relaxed">
                Masyarakat Ekonomi Syariah (MES) Daerah Depok adalah organisasi nirlaba yang bertujuan mengembangkan dan mempercepat penerapan sistem ekonomi dan keuangan syariah di Kota Depok.
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-16">
    <!-- Introduction Section -->
    <section class="grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Siapa Kami?</h2>
            <div class="prose text-gray-600 space-y-4">
                <p>
                    Masyarakat Ekonomi Syariah (MES) merupakan wadah yang inklusif bagi seluruh pemangku kepentingan ekonomi syariah. Kami menghimpun praktisi, akademisi, ulama, pengusaha, dan masyarakat umum yang peduli terhadap perkembangan ekonomi yang berkeadilan.
                </p>
                <p>
                    Di Depok, kami hadir untuk menjadi katalisator pertumbuhan ekonomi syariah yang nyata, menyentuh sektor riil, dan memberikan dampak positif bagi kesejahteraan masyarakat kota Depok.
                </p>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-emerald-100 rounded-xl transform rotate-3"></div>
            <img src="https://images.unsplash.com/photo-1577412647305-991150c7d163?q=80&w=2070&auto=format&fit=crop" alt="Meeting" class="relative rounded-xl shadow-lg w-full h-64 object-cover">
        </div>
    </section>

    <!-- Values Section -->
    <section class="bg-gray-50 rounded-2xl p-8 md:p-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Nilai-Nilai Utama</h2>
            <p class="mt-2 text-gray-600">Landasan kami dalam bergerak dan berkarya.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Inklusif</h3>
                <p class="text-sm text-gray-600">Terbuka bagi semua kalangan yang ingin berkontribusi pada ekonomi syariah.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Progresif</h3>
                <p class="text-sm text-gray-600">Selalu berinovasi dan adaptif terhadap perkembangan zaman dan teknologi.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:-translate-y-1 transition duration-300">
                <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Kontributif</h3>
                <p class="text-sm text-gray-600">Memberikan dampak nyata bagi penguatan ekonomi umat dan bangsa.</p>
            </div>
        </div>
    </section>

    <!-- Quote / Leadership -->
    <section class="text-center max-w-2xl mx-auto">
        <svg class="w-12 h-12 mx-auto text-emerald-200 mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.0547 15.592 14.4793 17.5373 14.4793H19.9853L19.9853 21H14.017ZM8.01732 21L8.01732 18C8.01732 16.0547 9.59268 14.4793 11.538 14.4793H13.986L13.986 21H8.01732ZM4.01732 21L4.01732 18C4.01732 16.0547 5.59268 14.4793 7.53799 14.4793H9.986L9.986 21H4.01732ZM2.00035 12C2.00035 6.47715 6.4775 2 12.0003 2C17.5232 2 22.0003 6.47715 22.0003 12C22.0003 17.5228 17.5232 22 12.0003 22C6.4775 22 2.00035 17.5228 2.00035 12ZM4.00035 12C4.00035 16.4183 7.58207 20 12.0003 20C16.4186 20 20.0003 16.4183 20.0003 12C20.0003 7.58172 16.4186 4 12.0003 4C7.58207 4 4.00035 7.58172 4.00035 12Z" fill-opacity="0.2"/></svg>
        <blockquote class="text-xl font-medium text-gray-900 italic">
            "Ekonomi Syariah bukan hanya untuk umat Islam, tetapi merupakan sistem universal yang menawarkan keadilan, kejujuran, dan kesejahteraan bagi seluruh umat manusia."
        </blockquote>
        <div class="mt-6">
            <div class="font-bold text-gray-900">Dr. H. Erick Thohir, B.A., M.B.A.</div>
            <div class="text-emerald-600 text-sm">Ketua Umum Pengurus Pusat MES</div>
        </div>
    </section>
</div>
@endsection
