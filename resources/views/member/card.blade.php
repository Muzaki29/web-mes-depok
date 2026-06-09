@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Kartu Tanda Anggota (KTA)</h1>
    <div class="flex items-center gap-2">
        <x-button variant="secondary" href="{{ route('member.dashboard') }}">Kembali</x-button>
    </div>
</div>

@php
    $member = auth()->user()->member ?? null;
@endphp

@if($member)
<div class="max-w-lg mx-auto">
    {{-- Card Front --}}
    <div class="rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-800 text-white p-6 shadow-xl relative overflow-hidden">
        {{-- Background pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 250" fill="none">
                <circle cx="350" cy="50" r="120" fill="white"/>
                <circle cx="50" cy="220" r="80" fill="white"/>
            </svg>
        </div>

        <div class="relative z-10">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="text-xs uppercase tracking-wider opacity-80">Masyarakat Ekonomi Syariah</div>
                    <div class="text-sm font-semibold">MES Kota Depok</div>
                </div>
                <div class="h-12 w-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Member ID & Valid Until --}}
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs opacity-80">Nomor Anggota</div>
                    <div class="text-lg font-bold tracking-wide">{{ $member->membership_no }}</div>
                </div>
                <div class="text-right">
                    <div class="text-xs opacity-80">Berlaku Sampai</div>
                    <div class="text-sm font-semibold">{{ $member->valid_until ? $member->valid_until->format('M Y') : '-' }}</div>
                </div>
            </div>

            {{-- Name & Category --}}
            <div class="mt-6 pt-4 border-t border-white/20">
                <div class="text-xl font-bold">{{ $member->name }}</div>
                <div class="text-sm opacity-90 mt-1">{{ optional($member->category)->name ?? 'Anggota' }}</div>
            </div>

            {{-- Status badge --}}
            <div class="mt-4 flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium
                    {{ $member->status === 'active' ? 'bg-green-400/30 text-green-100' : 'bg-yellow-400/30 text-yellow-100' }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $member->status === 'active' ? 'bg-green-300' : 'bg-yellow-300' }}"></span>
                    {{ ucfirst($member->status) }}
                </span>
                <div class="text-xs opacity-70">Kartu Digital</div>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-6 flex items-center justify-center gap-3">
        <x-button variant="secondary" onclick="window.print()">
            <svg class="h-4 w-4 mr-1.5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak
        </x-button>
        <x-button href="{{ route('member.dashboard') }}">Kembali ke Dashboard</x-button>
    </div>
</div>
@else
<x-card class="max-w-lg mx-auto">
    <div class="text-center py-8">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
        </svg>
        <h3 class="mt-3 text-lg font-medium text-gray-900">Kartu Belum Tersedia</h3>
        <p class="mt-2 text-sm text-gray-500">Data keanggotaan Anda belum terhubung dengan akun ini. Silakan hubungi admin untuk informasi lebih lanjut.</p>
    </div>
</x-card>
@endif
@endsection
