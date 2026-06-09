@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Member Portal</h1>
    <div class="flex items-center gap-2">
        <x-button variant="secondary" href="{{ route('home') }}">Public Site</x-button>
        <x-button href="{{ route('member.profile') }}">Edit Profile</x-button>
    </div>
</div>

@php
    $member = auth()->user()->member;
    $registrations = $member ? $member->registrations()->with('event')->latest()->get() : collect();
    $eventsAttended = $registrations->count();
    $consultations = $member
        ? \App\Models\Consultation::where('requester_name', $member->name)->latest()->get()
        : collect();
@endphp

@if($member)
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-card class="lg:col-span-2">
        <x-slot:title>Digital Membership Card</x-slot:title>
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <a href="{{ route('member.card') }}" class="block w-full md:w-96">
                <div class="rounded-xl bg-linear-to-br from-emerald-600 to-emerald-700 text-white p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="text-sm opacity-90">Member ID</div>
                        <div class="text-sm">Valid Until</div>
                    </div>
                    <div class="flex items-center justify-between mt-1 font-semibold">
                        <div>{{ $member->membership_no }}</div>
                        <div>{{ $member->valid_until ? $member->valid_until->format('M Y') : '-' }}</div>
                    </div>
                    <div class="mt-6">
                        <div class="text-2xl font-semibold">{{ $member->name }}</div>
                        <div class="opacity-90 mt-1">{{ optional($member->category)->name ?? 'Anggota' }}</div>
                    </div>
                </div>
            </a>
            <div class="flex-1">
                <div class="grid grid-cols-2 gap-3">
                    <x-card>
                        <div class="text-sm text-gray-500">Events Registered</div>
                        <div class="text-2xl font-semibold mt-1">{{ $eventsAttended }}</div>
                    </x-card>
                    <x-card>
                        <div class="text-sm text-gray-500">Consultations</div>
                        <div class="text-2xl font-semibold mt-1">{{ $consultations->count() }}</div>
                    </x-card>
                </div>
            </div>
        </div>
    </x-card>
    <x-card>
        <x-slot:title>Notifications</x-slot:title>
        @php
            $notificationsEnabled = \Illuminate\Support\Facades\Schema::hasTable('notifications');
            $latest = $notificationsEnabled ? auth()->user()->notifications()->latest()->limit(3)->get() : collect();
        @endphp
        <ul class="divide-y">
            @forelse($latest as $n)
                @php
                    $title = $n->data['title'] ?? 'Notifikasi';
                    $url = $n->data['url'] ?? route('notifications.index');
                @endphp
                <li class="py-2 text-sm">
                    <a href="{{ $url }}" class="{{ $n->read_at ? 'text-gray-700' : 'text-emerald-800 font-medium' }} hover:underline">
                        {{ $title }}
                    </a>
                </li>
            @empty
                <li class="py-2 text-sm text-gray-500">Belum ada notifikasi.</li>
            @endforelse
        </ul>
        <div class="mt-3 text-right">
            <a href="{{ route('notifications.index') }}" class="text-sm text-emerald-700 hover:underline">Lihat semua</a>
        </div>
    </x-card>
</div>

<div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
    <x-card>
        <x-slot:title>My Registered Events</x-slot:title>
        @if($registrations->isEmpty())
            <p class="text-sm text-gray-500 py-4">Belum ada event yang didaftarkan.</p>
        @else
            <div class="sm:hidden mt-3 space-y-3">
                @foreach($registrations->take(5) as $reg)
                    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="font-semibold text-gray-900 truncate">{{ optional($reg->event)->title ?? '-' }}</div>
                                <div class="mt-0.5 text-xs text-gray-500">{{ optional(optional($reg->event)->start_at)->format('M d, Y H:i') ?? '-' }}</div>
                            </div>
                            <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ ucfirst($reg->status ?? 'registered') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-table class="hidden sm:block mt-3">
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Event</th>
                        <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Schedule</th>
                        <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                    </tr>
                </x-slot:head>
                @foreach($registrations->take(5) as $reg)
                <tr>
                    <td class="px-4 py-3">{{ optional($reg->event)->title ?? '-' }}</td>
                    <td class="px-4 py-3">{{ optional(optional($reg->event)->start_at)->format('M d, Y H:i') ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ ucfirst($reg->status ?? 'registered') }}</span>
                    </td>
                </tr>
                @endforeach
            </x-table>
        @endif
    </x-card>
    <x-card>
        <x-slot:title>Consultation Requests</x-slot:title>
        @if($consultations->isEmpty())
            <p class="text-sm text-gray-500 py-4">Belum ada riwayat konsultasi.</p>
        @else
            <div class="sm:hidden mt-2 space-y-3">
                @foreach($consultations->take(5) as $c)
                    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="font-semibold text-gray-900 truncate">{{ $c->topic }}</div>
                                <div class="mt-0.5 text-xs text-gray-500">{{ $c->scheduled_at ? $c->scheduled_at->format('M d, H:i A') : '—' }}</div>
                            </div>
                            <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ ucfirst($c->status) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-table class="hidden sm:block mt-2">
                <x-slot:head>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Topic</th>
                        <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Schedule</th>
                    </tr>
                </x-slot:head>
                @foreach($consultations->take(5) as $c)
                <tr>
                    <td class="px-4 py-3">{{ $c->topic }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ ucfirst($c->status) }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $c->scheduled_at ? $c->scheduled_at->format('M d, H:i A') : '—' }}</td>
                </tr>
                @endforeach
            </x-table>
        @endif
    </x-card>
</div>
@else
{{-- Fallback: user has no linked member record --}}
<x-card>
    <div class="text-center py-12">
        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">Data Keanggotaan Belum Terhubung</h3>
        <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">
            Akun Anda belum terhubung dengan data keanggotaan. Jika Anda telah mendaftar, silakan hubungi admin atau tunggu proses persetujuan selesai.
        </p>
        <div class="mt-6">
            <x-button variant="secondary" href="{{ route('membership') }}">Daftar Keanggotaan</x-button>
        </div>
    </div>
</x-card>
@endif
@endsection
