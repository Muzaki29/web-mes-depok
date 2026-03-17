@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Member Portal</h1>
    <div class="flex items-center gap-2">
        <x-button variant="secondary">Public Site</x-button>
        <x-button href="{{ route('member.profile') }}">Edit Profile</x-button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-card class="lg:col-span-2">
        <x-slot:title>Digital Membership Card</x-slot:title>
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="rounded-xl bg-linear-to-br from-emerald-600 to-emerald-700 text-white p-6 w-full md:w-96 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="text-sm opacity-90">Member ID</div>
                    <div class="text-sm">Valid Until</div>
                </div>
                <div class="flex items-center justify-between mt-1 font-semibold">
                    <div>EC-2024-0847</div>
                    <div>Dec 2025</div>
                </div>
                <div class="mt-6">
                    <div class="text-2xl font-semibold">Ahmad Rahman</div>
                    <div class="opacity-90 mt-1">Premium Member</div>
                </div>
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-2 gap-3">
                    <x-card>
                        <div class="text-sm text-gray-500">Events Attended</div>
                        <div class="text-2xl font-semibold mt-1">8</div>
                    </x-card>
                    <x-card>
                        <div class="text-sm text-gray-500">Certificates Earned</div>
                        <div class="text-2xl font-semibold mt-1">3</div>
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
        <div class="sm:hidden mt-3 space-y-3">
            @foreach([['Ethical Finance Workshop','Mar 15, 09:00 AM','Confirmed'],['Annual Economic Summit','Apr 22, Full Day','Pending']] as $e)
                <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="font-semibold text-gray-900 truncate">{{ $e[0] }}</div>
                            <div class="mt-0.5 text-xs text-gray-500">{{ $e[1] }}</div>
                        </div>
                        <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ $e[2] }}</span>
                    </div>
                    <div class="mt-4">
                        <x-button class="w-full" variant="secondary">View</x-button>
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
                    <th class="px-4 py-3"></th>
                </tr>
            </x-slot:head>
            @foreach([['Ethical Finance Workshop','Mar 15, 09:00 AM','Confirmed'],['Annual Economic Summit','Apr 22, Full Day','Pending']] as $e)
            <tr>
                <td class="px-4 py-3">{{ $e[0] }}</td>
                <td class="px-4 py-3">{{ $e[1] }}</td>
                <td class="px-4 py-3">{{ $e[2] }}</td>
                <td class="px-4 py-3 text-right"><x-button size="sm" variant="secondary">View</x-button></td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-card>
        <x-slot:title>Certificates</x-slot:title>
        <div class="space-y-3">
            @foreach([['Islamic Finance Basics','2 days ago'],['Sustainable Business','1 month ago']] as $c)
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium">{{ $c[0] }}</p>
                    <p class="text-sm text-gray-500">Issued {{ $c[1] }}</p>
                </div>
                <x-button size="sm">Download</x-button>
            </div>
            @endforeach
        </div>
    </x-card>
</div>

<div class="mt-6">
    <x-card>
        <x-slot:title>Consultation Requests</x-slot:title>
        <div class="sm:hidden mt-2 space-y-3">
            @foreach([['Ethical Finance','Scheduled','Mar 20, 10:00 AM'],['SME Support','Submitted','—']] as $r)
                <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="font-semibold text-gray-900 truncate">{{ $r[0] }}</div>
                            <div class="mt-0.5 text-xs text-gray-500">{{ $r[2] }}</div>
                        </div>
                        <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ $r[1] }}</span>
                    </div>
                    <div class="mt-4">
                        <x-button class="w-full" variant="secondary">View</x-button>
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
                    <th class="px-4 py-3"></th>
                </tr>
            </x-slot:head>
            @foreach([['Ethical Finance','Scheduled','Mar 20, 10:00 AM'],['SME Support','Submitted','—']] as $r)
            <tr>
                <td class="px-4 py-3">{{ $r[0] }}</td>
                <td class="px-4 py-3">{{ $r[1] }}</td>
                <td class="px-4 py-3">{{ $r[2] }}</td>
                <td class="px-4 py-3 text-right"><x-button size="sm" variant="secondary">View</x-button></td>
            </tr>
            @endforeach
        </x-table>
        <div class="mt-4 text-right">
            <x-button>Request Consultation</x-button>
        </div>
    </x-card>
</div>
@endsection
