@extends('layouts.public')

@section('hero')
<div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1423666639041-f140481d806d?q=80&w=2074&auto=format&fit=crop" alt="Contact Background" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
    </div>
    <div class="relative max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Hubungi Kami</h1>
        <p class="text-xl text-emerald-100 leading-relaxed">
            Kami siap mendengar masukan, pertanyaan, dan peluang kolaborasi dari Anda untuk kemajuan ekonomi syariah.
        </p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Contact Information (Left Column) -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Info Cards -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-emerald-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <span class="w-2 h-8 bg-emerald-500 rounded-full mr-3"></span>
                    Informasi Kontak
                </h3>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Alamat Sekretariat</p>
                            <p class="text-gray-900 mt-1">Jl. Margonda Raya No. 1, Depok, Jawa Barat 16431</p>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <a href="mailto:sekretariat@mesdepok.id" class="text-emerald-600 hover:text-emerald-700 mt-1 block">sekretariat@mesdepok.id</a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Telepon / WhatsApp</p>
                            <p class="text-gray-900 mt-1">+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-900 mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h.165zm-1.8 2h3.37c2.236 0 2.508.01 3.393.05.88.04 1.36.19 1.678.31.42.163.72.358.935.572.215.215.41.514.572.935.12.318.27.798.31 1.678.04.885.05 1.157.05 3.393v.232c0 2.236-.01 2.508-.05 3.393-.04.88-.19 1.36-.31 1.678-.163.42-.358.72-.572.935-.215.215-.514.41-.935.572-.318.12-.798.27-1.678.31-.885.04-1.157.05-3.393.05h-.232c-2.236 0-2.508-.01-3.393-.05-.88-.04-1.36-.19-1.678-.31-.42-.163-.72-.358-.935-.572-.215-.215-.41-.514-.572-.935-.12-.318-.27-.798-.31-1.678-.04-.885-.05-1.157-.05-3.393v-.232c0-2.236.01-2.508.05-3.393.04-.88.19-1.36.31-1.678.163-.42.358-.72.572-.935.215-.215.514-.41.935-.572.318-.12.798-.27-1.678-.31-.885-.04-1.157-.05-3.393-.05L10.35 4zm1.965 3.633a5.368 5.368 0 00-5.368 5.368 5.368 5.368 0 005.368 5.368 5.368 5.368 0 005.368-5.368 5.368 5.368 0 00-5.368-5.368zm0 1.8a3.568 3.568 0 110 7.136 3.568 3.568 0 010-7.136zm5.888-5.23a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Map Placeholder -->
            <div class="bg-gray-200 rounded-xl h-64 overflow-hidden shadow-sm relative group">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.196396587448!2d106.82098487499169!3d-6.368625993621535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec11b225969f%3A0x629555196316279f!2sDepok%2C%20Depok%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1710000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="grayscale group-hover:grayscale-0 transition-all duration-300"></iframe>
            </div>
        </div>

        <!-- Contact Form (Right Column) -->
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-emerald-100">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Kirim Pesan</h3>
                    <p class="text-gray-600">
                        Silakan isi formulir di bawah ini. Tim kami akan segera merespons pesan Anda.
                    </p>
                </div>

                @if(session('status'))
                    <div class="mb-6 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="Nama Anda" required>
                            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="nama@email.com" required>
                            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                        <select name="subject" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" required>
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Pilih Subjek</option>
                            <option value="Pertanyaan Umum" {{ old('subject') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                            <option value="Kemitraan & Kerjasama" {{ old('subject') == 'Kemitraan & Kerjasama' ? 'selected' : '' }}>Kemitraan & Kerjasama</option>
                            <option value="Layanan Keanggotaan" {{ old('subject') == 'Layanan Keanggotaan' ? 'selected' : '' }}>Layanan Keanggotaan</option>
                            <option value="Media & Pers" {{ old('subject') == 'Media & Pers' ? 'selected' : '' }}>Media & Pers</option>
                            <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('subject')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea name="message" rows="6" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition-colors" placeholder="Tuliskan pesan Anda di sini..." required>{{ old('message') }}</textarea>
                        @error('message')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
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

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-lg shadow-emerald-200">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
