@extends('layouts.public')

@section('content')
<div class="relative overflow-hidden rounded-2xl bg-[url('https://images.unsplash.com/photo-1531058020387-3be344556be6?q=80&w=1974&auto=format&fit=crop')] bg-cover bg-center">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative p-10 sm:p-14 text-white">
        <h1 class="text-3xl sm:text-4xl font-semibold">Event Ekonomi & Keuangan Syariah</h1>
        <p class="mt-2 text-white/90">Temukan agenda terdekat, capaian kegiatan, dan dokumentasi program MES Depok.</p>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-4 gap-3 bg-white/10 backdrop-blur rounded-xl p-3 ring-1 ring-white/20">
            <input placeholder="Cari event..." class="px-3 py-2 rounded-md bg-white text-gray-900">
            <select class="px-3 py-2 rounded-md bg-white text-gray-900"><option>Semua Kategori</option><option>Seminar</option><option>Workshop</option><option>Webinar</option></select>
            <input type="date" class="px-3 py-2 rounded-md bg-white text-gray-900">
            <x-button class="bg-emerald-600 hover:bg-emerald-700">Cari</x-button>
        </div>
        <div class="mt-6">
            <nav class="flex flex-wrap items-center gap-3 text-sm">
                <a href="#upcoming" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 ring-1 ring-white/20">Event Mendatang</a>
                <a href="#types" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 ring-1 ring-white/20">Jenis Kegiatan</a>
                <a href="#metrics" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 ring-1 ring-white/20">Capaian</a>
                <a href="#gallery" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 ring-1 ring-white/20">Galeri</a>
                <a href="#partners" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 ring-1 ring-white/20">Mitra Kerja</a>
                <a href="#past" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 ring-1 ring-white/20">Event Kemarin</a>
            </nav>
        </div>
    </div>
</div>

<div id="upcoming" class="mt-10">
    <h2 class="text-xl font-semibold mb-3">Event Mendatang</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach([['Ethical Finance Workshop','Mar 15, 09:00 AM • Online'],['Annual Economic Summit','Apr 22 • Convention Center']] as $e)
        <x-card>
            <div class="flex items-start justify-between">
                <div>
                    <p class="font-medium">{{ $e[0] }}</p>
                    <p class="text-sm text-gray-500">{{ $e[1] }}</p>
                </div>
                <x-button>Detail</x-button>
            </div>
        </x-card>
        @endforeach
    </div>
</div>

<div id="types" class="mt-12">
    <h2 class="text-xl font-semibold mb-3">Jenis Kegiatan</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach(['Seminar','Workshop','Webinar','Pelatihan','Talkshow','Kunjungan'] as $t)
        <x-card class="text-center py-6">
            <div class="text-lg font-semibold">{{ $t }}</div>
        </x-card>
        @endforeach
    </div>
</div>

<div id="metrics" class="mt-12">
    <h2 class="text-xl font-semibold mb-3">Capaian Kegiatan</h2>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <x-card><div class="text-3xl font-semibold">1.2K</div><div class="text-sm text-gray-500">Peserta</div></x-card>
        <x-card><div class="text-3xl font-semibold">48</div><div class="text-sm text-gray-500">Event/Tahun</div></x-card>
        <x-card><div class="text-3xl font-semibold">63</div><div class="text-sm text-gray-500">Mitra</div></x-card>
        <x-card><div class="text-3xl font-semibold">149</div><div class="text-sm text-gray-500">Dokumentasi</div></x-card>
    </div>
</div>

<div id="gallery" class="mt-12">
    <h2 class="text-xl font-semibold mb-3">Galeri Dokumentasi</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @for($i=1;$i<=8;$i++)
        <div class="rounded-xl overflow-hidden">
            <img class="w-full h-32 object-cover" src="https://picsum.photos/seed/event{{ $i }}/400/240" alt="doc {{ $i }}">
        </div>
        @endfor
    </div>
</div>

<div id="partners" class="mt-12">
    <h2 class="text-xl font-semibold mb-3">Mitra Kerja</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
        @foreach(['OJK','IDX','BSI','PNM','Permodalan','Komunitas'] as $p)
        <x-card class="text-center py-3">{{ $p }}</x-card>
        @endforeach
    </div>
</div>

<div id="past" class="mt-12">
    <h2 class="text-xl font-semibold mb-3">Event Kemarin</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([1,2,3] as $e)
        <x-card>
            <div class="rounded-lg overflow-hidden">
                <img class="w-full h-36 object-cover" src="https://picsum.photos/seed/past{{ $e }}/640/360" alt="past">
            </div>
            <div class="mt-3">
                <p class="font-medium">Literasi Ekonomi Syariah #{{ $e }}</p>
                <p class="text-sm text-gray-500 mt-1">Sukses terselenggara dengan partisipasi aktif anggota dan masyarakat.</p>
            </div>
        </x-card>
        @endforeach
    </div>
</div>
@endsection
