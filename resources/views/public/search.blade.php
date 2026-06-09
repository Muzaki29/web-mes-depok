@extends('layouts.public')

@section('hero')
<section class="relative bg-linear-to-br from-emerald-900 via-emerald-800 to-teal-900 py-16 px-4 sm:px-6 lg:px-8 text-white overflow-hidden">
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl"></div>
    <div class="relative max-w-3xl mx-auto text-center">
        <h1 class="font-heading text-3xl md:text-4xl font-extrabold mb-6">Pencarian</h1>
        <form action="{{ route('search') }}" method="GET" class="relative max-w-xl mx-auto">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
            </div>
            <input name="q" type="search" value="{{ $q }}" autofocus placeholder="Cari berita, agenda, atau program..." class="w-full pl-12 pr-28 py-3.5 text-gray-900 bg-white rounded-xl shadow-lg placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400" />
            <button type="submit" class="absolute inset-y-0 right-0 m-1.5 px-5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors">Cari</button>
        </form>
    </div>
</section>
@endsection

@section('content')
@php $total = $articles->count() + $events->count() + $programs->count(); @endphp

@if($q === '')
    <div class="text-center py-20 text-gray-500">
        <svg class="mx-auto h-14 w-14 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
        <p>Masukkan kata kunci untuk mulai mencari.</p>
    </div>
@else
    <div class="mb-8">
        <p class="text-gray-600">
            Menampilkan <span class="font-semibold text-gray-900">{{ $total }}</span> hasil untuk
            <span class="font-semibold text-emerald-700">"{{ $q }}"</span>
        </p>
    </div>

    @if($total === 0)
        <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <h3 class="font-heading text-lg font-bold text-gray-900">Tidak ada hasil ditemukan</h3>
            <p class="text-gray-500 mt-2">Coba gunakan kata kunci lain atau lebih umum.</p>
        </div>
    @else
    <div class="space-y-12">
        {{-- Berita --}}
        @if($articles->isNotEmpty())
        <section>
            <div class="flex items-center gap-2 mb-5">
                <h2 class="font-heading text-xl font-bold text-gray-900">Berita &amp; Artikel</h2>
                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">{{ $articles->count() }}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $a)
                    @php $thumb = $a->thumbnail ? (str_starts_with($a->thumbnail,'http') || str_starts_with($a->thumbnail,'//') ? $a->thumbnail : asset('storage/'.$a->thumbnail)) : null; @endphp
                    <a href="{{ route('news.show', $a->slug) }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1">
                        <div class="relative h-40 bg-emerald-50 overflow-hidden">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $a->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-linear-to-br from-emerald-100 to-emerald-200 text-emerald-300"><svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9"></path></svg></div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-emerald-600 font-medium mb-1">{{ optional($a->published_at)->translatedFormat('d F Y') }}</div>
                            <h3 class="font-heading font-bold text-gray-900 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $a->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Agenda --}}
        @if($events->isNotEmpty())
        <section>
            <div class="flex items-center gap-2 mb-5">
                <h2 class="font-heading text-xl font-bold text-gray-900">Agenda &amp; Kegiatan</h2>
                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">{{ $events->count() }}</span>
            </div>
            <div class="space-y-3">
                @foreach($events as $e)
                <a href="{{ route('events.show', $e->slug) }}" class="group flex items-center gap-4 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all p-4">
                    <div class="shrink-0 w-16 text-center rounded-lg bg-linear-to-br from-emerald-600 to-emerald-700 text-white py-2">
                        <div class="font-heading text-2xl font-extrabold leading-none">{{ optional($e->start_at)->format('d') }}</div>
                        <div class="text-xs uppercase text-emerald-100">{{ optional($e->start_at)->translatedFormat('M') }}</div>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 truncate group-hover:text-emerald-600 transition-colors">{{ $e->title }}</h3>
                        <div class="text-sm text-gray-500 truncate">{{ $e->location ?? 'Kota Depok' }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Program --}}
        @if($programs->isNotEmpty())
        <section>
            <div class="flex items-center gap-2 mb-5">
                <h2 class="font-heading text-xl font-bold text-gray-900">Program</h2>
                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">{{ $programs->count() }}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($programs as $p)
                <a href="{{ route('programs.show', $p->slug) }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg p-6 transition-all duration-300 hover:-translate-y-1 border-b-4 border-b-transparent hover:border-b-emerald-500">
                    @if($p->category)
                        <span class="inline-block px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold mb-3">{{ $p->category }}</span>
                    @endif
                    <h3 class="font-heading font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $p->title }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($p->description), 110) }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </div>
    @endif
@endif
@endsection
