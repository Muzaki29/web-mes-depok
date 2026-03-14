@extends('layouts.public')

@section('hero')
<div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop" alt="Membership Background" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
    </div>
    <div class="relative max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Keanggotaan</h1>
        <p class="text-xl text-emerald-100 leading-relaxed">
            Bergabunglah bersama kami dalam membangun ekosistem ekonomi syariah yang kuat dan berkelanjutan di Kota Depok.
        </p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Benefits Section -->
    <div class="mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Bergabung dengan MES Depok?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Menjadi bagian dari komunitas profesional dan praktisi ekonomi syariah terbesar dengan berbagai manfaat eksklusif.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Benefit 1 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-emerald-100 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Networking Luas</h3>
                <p class="text-gray-600">
                    Perluas jaringan profesional Anda dengan bertemu para ahli, praktisi, dan pemangku kepentingan di bidang ekonomi syariah.
                </p>
            </div>

            <!-- Benefit 2 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-emerald-100 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Edukasi & Literasi</h3>
                <p class="text-gray-600">
                    Akses prioritas ke berbagai seminar, workshop, dan pelatihan untuk meningkatkan pemahaman dan kompetensi ekonomi syariah.
                </p>
            </div>

            <!-- Benefit 3 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-emerald-100 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Kolaborasi Bisnis</h3>
                <p class="text-gray-600">
                    Peluang kolaborasi dan sinergi bisnis antar anggota serta akses informasi terkini seputar perkembangan industri halal.
                </p>
            </div>
        </div>
    </div>

    <!-- Registration Form Section -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-emerald-100">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Left Column: Instructions -->
            <div class="bg-emerald-900 p-8 lg:p-12 text-white flex flex-col justify-center">
                <h3 class="text-2xl font-bold mb-6">Formulir Pendaftaran</h3>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="shrink-0 w-8 h-8 rounded-full bg-emerald-800 flex items-center justify-center border border-emerald-700 font-bold text-sm">1</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-emerald-200">Isi Data Diri</h4>
                            <p class="text-emerald-100/80 text-sm mt-1">Lengkapi formulir dengan data yang valid dan terbaru.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="shrink-0 w-8 h-8 rounded-full bg-emerald-800 flex items-center justify-center border border-emerald-700 font-bold text-sm">2</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-emerald-200">Verifikasi Admin</h4>
                            <p class="text-emerald-100/80 text-sm mt-1">Tim kami akan memverifikasi data pendaftaran Anda.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="shrink-0 w-8 h-8 rounded-full bg-emerald-800 flex items-center justify-center border border-emerald-700 font-bold text-sm">3</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-emerald-200">Konfirmasi Keanggotaan</h4>
                            <p class="text-emerald-100/80 text-sm mt-1">Anda akan menerima email konfirmasi status keanggotaan.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 pt-8 border-t border-emerald-800">
                    <p class="text-sm text-emerald-300">
                        Butuh bantuan? Hubungi kami di <a href="mailto:sekretariat@mesdepok.id" class="text-white hover:underline">sekretariat@mesdepok.id</a>
                    </p>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="p-8 lg:p-12 bg-white">
                @if(session('status'))
                    <div class="mb-6 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('membership.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="Masukkan nama lengkap Anda">
                            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="nama@email.com">
                            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="0812...">
                            @error('phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Instansi / Organisasi</label>
                            <input type="text" name="organization" value="{{ old('organization') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="Nama instansi atau organisasi Anda">
                            @error('organization')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" rows="4" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="Tuliskan pesan atau pertanyaan jika ada...">{{ old('notes') }}</textarea>
                            @error('notes')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Keamanan</label>
                            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                                <div class="bg-gray-100 rounded-lg p-2 border border-gray-200 select-none shrink-0">
                                    <img src="{{ $captcha }}" alt="Captcha" class="h-12 w-auto rounded">
                                </div>
                                <div class="flex-1 w-full">
                                    <input type="text" name="captcha" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors uppercase tracking-widest font-bold text-center sm:text-left" placeholder="MASUKKAN KODE" required autocomplete="off">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Masukkan kode karakter yang terlihat pada gambar diatas.</p>
                            @error('captcha')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-lg shadow-emerald-200">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
