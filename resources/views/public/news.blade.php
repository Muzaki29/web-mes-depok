@extends('layouts.public')

@section('hero')
<div class="relative bg-emerald-900 py-20 px-4 sm:px-6 lg:px-8 text-center text-white overflow-hidden">
    <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop" alt="News Background" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-linear-to-t from-emerald-900 to-transparent"></div>
        </div>
    <div class="relative max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Berita & Artikel</h1>
        <p class="text-xl text-emerald-100 leading-relaxed">
            Informasi terkini, wawasan ekonomi syariah, dan kabar kegiatan dari MES Depok.
        </p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-emerald-50">
        <form action="{{ route('news') }}" method="GET" class="relative">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" class="block w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 sm:text-base transition duration-200 ease-in-out shadow-inner" placeholder="Cari berita, artikel, atau wawasan...">
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-linear-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200 shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5">
                    Temukan
                </button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    @if(request('q'))
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Hasil pencarian untuk: <span class="text-emerald-600">"{{ request('q') }}"</span></h2>
            <a href="{{ route('news') }}" class="text-emerald-600 hover:text-emerald-700 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Reset Filter
            </a>
        </div>
    @endif

    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            @foreach($articles as $article)
                <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 flex flex-col h-full group hover:-translate-y-1">
                    <a href="{{ route('news.show', $article->slug) }}" class="relative h-64 overflow-hidden block">
                        @if($article->thumbnail)
                            @php $src = str_starts_with($article->thumbnail,'http') || str_starts_with($article->thumbnail,'//') ? $article->thumbnail : asset('storage/'.$article->thumbnail); @endphp
                            <img src="{{ $src }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-linear-to-br from-emerald-50 to-emerald-100 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                                <svg class="w-16 h-16 text-emerald-200 group-hover:text-emerald-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                        <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-emerald-700 shadow-sm border border-emerald-100">
                            {{ optional($article->published_at)->translatedFormat('d M Y') }}
                        </div>
                    </a>
                    
                    <div class="p-8 flex-1 flex flex-col relative">
                        <div class="mb-4">
                             <a href="{{ route('news.show', $article->slug) }}" class="block">
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight group-hover:text-emerald-600 transition-colors">
                                    {{ $article->title }}
                                </h2>
                            </a>
                        </div>
                        
                        <div class="text-gray-600 text-base leading-relaxed line-clamp-3 mb-6 flex-1">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                        </div>
                        
                        <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-xs">
                                    {{ substr($article->author ?? 'A', 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-500 font-medium">
                                    {{ $article->author ?? 'Admin' }}
                                </span>
                            </div>
                            <a href="{{ route('news.show', $article->slug) }}" class="group/btn inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700">
                                Baca Artikel
                                <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-16 flex justify-center">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="bg-emerald-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="h-12 w-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak ada artikel ditemukan</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                @if(request('q'))
                    Kami tidak dapat menemukan artikel yang cocok dengan pencarian "<span class="font-medium text-gray-900">{{ request('q') }}</span>". Coba kata kunci lain.
                @else
                    Belum ada artikel yang diterbitkan saat ini.
                @endif
            </p>
            @if(request('q'))
                <a href="{{ route('news') }}" class="inline-flex items-center mt-6 text-emerald-600 font-medium hover:text-emerald-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke semua artikel
                </a>
            @endif
        </div>
    @endif
</div>
@endsection
