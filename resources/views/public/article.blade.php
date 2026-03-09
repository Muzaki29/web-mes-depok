@extends('layouts.public')

@php
    $metaTitle = $article->title . ' • MES Depok';
    $metaDescription = $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->body), 160);
    $metaImage = $article->thumbnail 
        ? (str_starts_with($article->thumbnail, 'http') || str_starts_with($article->thumbnail, '//') 
            ? $article->thumbnail 
            : asset('storage/'.$article->thumbnail)) 
        : asset('images/og-default.png');
    $metaType = 'article';
@endphp

@push('meta')
    <meta property="article:published_time" content="{{ optional($article->published_at)->toAtomString() }}">
    <meta property="article:author" content="{{ $article->author->name ?? 'Admin' }}">
@endpush

@section('content')
<div class="bg-white">
    <!-- Hero Header -->
    <div class="relative py-16 bg-gray-50 border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-2 mb-6">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                    {{ $article->category->name ?? 'Berita' }}
                </span>
                <span class="text-gray-400">•</span>
                <span class="text-sm text-gray-500">
                    {{ optional($article->published_at)->translatedFormat('d F Y') }}
                </span>
            </div>
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight mb-6 leading-tight">
                {{ $article->title }}
            </h1>

            <div class="flex items-center justify-center gap-3">
                <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-sm">
                    {{ substr($article->author->name ?? 'A', 0, 1) }}
                </div>
                <div class="text-left">
                    <p class="text-sm font-medium text-gray-900">{{ $article->author->name ?? 'Admin MES Depok' }}</p>
                    <p class="text-xs text-gray-500">Penulis</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($article->thumbnail)
            @php 
                $src = str_starts_with($article->thumbnail, 'http') || str_starts_with($article->thumbnail, '//') 
                    ? $article->thumbnail 
                    : asset('storage/'.$article->thumbnail); 
            @endphp
            <div class="relative aspect-video rounded-2xl overflow-hidden shadow-lg mb-12">
                <img src="{{ $src }}" alt="{{ $article->title }}" class="absolute inset-0 w-full h-full object-cover">
            </div>
        @endif

        <div class="prose prose-lg prose-emerald mx-auto text-gray-600">
            {!! $article->body !!}
        </div>

        <!-- Share & Tags -->
        <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-900">Bagikan:</span>
                <div class="flex gap-2">
                    <button class="p-2 rounded-full bg-gray-50 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </button>
                    <button class="p-2 rounded-full bg-gray-50 text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                    </button>
                    <button class="p-2 rounded-full bg-gray-50 text-gray-600 hover:bg-green-50 hover:text-green-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.894-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@if($more->isNotEmpty())
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Baca Artikel Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($more as $m)
            <a href="{{ url('/news/'.$m->slug) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col h-full">
                <div class="relative h-48 overflow-hidden">
                    @php 
                        $thumb = $m->thumbnail 
                            ? (str_starts_with($m->thumbnail, 'http') || str_starts_with($m->thumbnail, '//') 
                                ? $m->thumbnail 
                                : asset('storage/'.$m->thumbnail))
                            : asset('images/og-default.png');
                    @endphp
                    <img src="{{ $thumb }}" alt="{{ $m->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/90 text-emerald-800 backdrop-blur-sm">
                            {{ $m->category->name ?? 'Berita' }}
                        </span>
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ optional($m->published_at)->translatedFormat('d M Y') }}
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-2">
                        {{ $m->title }}
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4 flex-1">
                        {{ $m->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($m->body), 100) }}
                    </p>
                    <span class="text-sm font-medium text-emerald-600 group-hover:translate-x-1 transition-transform inline-flex items-center">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
