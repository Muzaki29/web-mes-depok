@extends('layouts.public')

@section('content')
<div class="bg-white">
    <!-- Hero Header -->
    <div class="relative py-20 bg-emerald-900 text-white overflow-hidden">
        <div class="absolute inset-0">
             @php 
                $bg = $program->thumbnail 
                    ? (str_starts_with($program->thumbnail, 'http') || str_starts_with($program->thumbnail, '//') 
                        ? $program->thumbnail 
                        : asset('storage/'.$program->thumbnail))
                    : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop';
            @endphp
            <img src="{{ $bg }}" alt="Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-800 text-emerald-100 mb-6 border border-emerald-700">
                {{ $program->category ?? 'Program Unggulan' }}
            </span>
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-6 leading-tight">
                {{ $program->title }}
            </h1>
            <p class="text-lg md:text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                {{ $program->description }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="prose prose-lg prose-emerald text-gray-600">
                    {!! $program->content !!}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- CTA Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Tertarik dengan Program Ini?</h3>
                    <p class="text-sm text-gray-500 mb-6">Dapatkan informasi lebih lanjut atau daftarkan diri Anda untuk mengikuti program ini.</p>
                    
                    <div class="space-y-3">
                        <a href="{{ url('/contact') }}" class="block w-full text-center bg-emerald-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-emerald-700 transition shadow-md shadow-emerald-200">
                            Hubungi Kami
                        </a>
                        <a href="{{ url('/membership') }}" class="block w-full text-center bg-white border border-gray-200 text-gray-700 font-bold py-3 px-4 rounded-xl hover:bg-gray-50 transition">
                            Jadi Anggota
                        </a>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Bagikan Program</h4>
                        <div class="flex gap-2">
                            <button class="p-2 rounded-full bg-gray-50 text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </button>
                            <!-- Add more share buttons as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($otherPrograms->isNotEmpty())
    <div class="bg-gray-50 py-16 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Program Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($otherPrograms as $op)
                <a href="{{ route('programs.show', $op->slug) }}" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="h-48 overflow-hidden relative">
                         @php 
                            $thumb = $op->thumbnail 
                                ? (str_starts_with($op->thumbnail, 'http') || str_starts_with($op->thumbnail, '//') 
                                    ? $op->thumbnail 
                                    : asset('storage/'.$op->thumbnail))
                                : 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop';
                        @endphp
                        <img src="{{ $thumb }}" alt="{{ $op->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="text-xs font-semibold text-emerald-600 mb-2">{{ $op->category }}</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-emerald-700 transition">{{ $op->title }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ $op->description }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
