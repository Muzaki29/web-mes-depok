@extends('layouts.app')

@php
    $kpis = [
        ['key' => 'totalMembers', 'label' => 'Total Anggota', 'value' => $totalMembers ?? 0, 'icon' => '👥', 'color' => 'blue', 'desc' => 'Anggota terdaftar'],
        ['key' => 'upcomingEvents', 'label' => 'Agenda Mendatang', 'value' => $upcomingEvents ?? 0, 'icon' => '📅', 'color' => 'emerald', 'desc' => 'Dalam 30 hari'],
        ['key' => 'activeConsultations', 'label' => 'Konsultasi Aktif', 'value' => $activeConsultations ?? 0, 'icon' => '💬', 'color' => 'purple', 'desc' => 'Perlu respon'],
        ['key' => 'documentsCount', 'label' => 'Dokumen', 'value' => $documentsCount ?? 0, 'icon' => '📂', 'color' => 'amber', 'desc' => 'Total arsip'],
    ];
@endphp

@section('content')
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard Admin</h1>
            <p class="text-gray-500 mt-1">
                Ringkasan aktivitas dan performa organisasi MES Depok.
                <span class="mx-1 text-gray-300">•</span>
                <span class="text-gray-600">Waktu: <span id="serverClock" class="font-medium">—</span></span>
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Lihat Website
            </a>
            <x-button href="{{ route('admin.announcements') }}" class="shadow-lg shadow-emerald-500/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                Buat Pengumuman
            </x-button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($kpis as $kpi)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-{{ $kpi['color'] }}-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-{{ $kpi['color'] }}-50 text-{{ $kpi['color'] }}-600">
                            <span class="text-2xl">{{ $kpi['icon'] }}</span>
                        </div>
                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-{{ $kpi['color'] }}-50 text-{{ $kpi['color'] }}-700 border border-{{ $kpi['color'] }}-100">
                            {{ $kpi['desc'] }}
                        </span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1" id="kpi-{{ $kpi['key'] }}">{{ $kpi['value'] }}</h3>
                    <p class="text-sm text-gray-500 font-medium">{{ $kpi['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Pertumbuhan Anggota</h3>
                <select class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    <option>6 Bulan Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div class="relative h-72 w-full">
                <canvas id="membersGrowthChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Partisipasi Event</h3>
            <div class="relative h-64 flex items-center justify-center">
                <canvas id="eventParticipationChart"></canvas>
            </div>
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-500">Total pendaftar (3 agenda terakhir)</p>
                <p class="text-2xl font-bold text-gray-900" id="eventTotalRegistrations">—</p>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions & Recent Members -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Quick Actions -->
            <div class="bg-linear-to-r from-emerald-600 to-emerald-800 rounded-2xl p-6 text-white shadow-lg">
                <h3 class="text-lg font-bold mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.members') }}" class="flex flex-col items-center justify-center p-4 bg-white/10 rounded-xl hover:bg-white/20 transition-colors backdrop-blur-sm cursor-pointer">
                        <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="text-sm font-medium">Tambah Anggota</span>
                    </a>
                    <a href="{{ route('admin.events') }}" class="flex flex-col items-center justify-center p-4 bg-white/10 rounded-xl hover:bg-white/20 transition-colors backdrop-blur-sm cursor-pointer">
                        <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-sm font-medium">Buat Event</span>
                    </a>
                    <a href="{{ route('admin.letters') }}" class="flex flex-col items-center justify-center p-4 bg-white/10 rounded-xl hover:bg-white/20 transition-colors backdrop-blur-sm cursor-pointer">
                        <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="text-sm font-medium">Buat Surat</span>
                    </a>
                    <a href="{{ route('admin.documents') }}" class="flex flex-col items-center justify-center p-4 bg-white/10 rounded-xl hover:bg-white/20 transition-colors backdrop-blur-sm cursor-pointer">
                        <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <span class="text-sm font-medium">Unggah Dokumen</span>
                    </a>
                </div>
            </div>

            <!-- Recent Members Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Anggota Terbaru</h3>
                    <a href="{{ route('admin.members') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">Lihat Semua &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase font-medium">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse(($recentMembers ?? []) as $row)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $row->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                {{ optional($row->category)->name ?? '—' }}
                            </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $row->status=='active'?'bg-emerald-50 text-emerald-700':'bg-amber-50 text-amber-700' }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $row->status=='active'?'bg-emerald-500':'bg-amber-500' }}"></span>
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-emerald-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada anggota baru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Lists -->
        <div class="space-y-8">
            <!-- Latest Registrations -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Pendaftaran Terbaru</h3>
                <ul class="space-y-4">
                    @forelse(($latestRegistrations ?? []) as $r)
                        <li class="flex items-start gap-3">
                            <div class="shrink-0 w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs font-bold">
                                {{ substr($r->name, 0, 2) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $r->name }}</p>
                                <p class="text-xs text-gray-500">{{ optional($r->event)->title ?? 'Event tidak ditemukan' }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500 text-center py-2">Belum ada pendaftaran.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Recent Documents -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Dokumen Terbaru</h3>
                <ul class="space-y-3">
                    @forelse(($recentDocuments ?? []) as $d)
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span class="text-sm text-gray-700 truncate">{{ $d->title }}</span>
                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap">{{ $d->created_at->format('d M') }}</span>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500 text-center py-2">Belum ada dokumen.</li>
                    @endforelse
                </ul>
            </div>

            <!-- System Activity -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aktivitas Sistem</h3>
                <div class="relative pl-4 border-l-2 border-gray-100 space-y-6">
                    @forelse(($activities ?? []) as $activity)
                        <div class="relative">
                            <div class="absolute -left-5.25 top-1.5 w-3 h-3 bg-gray-200 rounded-full border-2 border-white ring-1 ring-gray-100"></div>
                            <p class="text-sm text-gray-600">{{ $activity }}</p>
                            <span class="text-xs text-gray-400">Baru saja</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Tidak ada aktivitas terbaru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const clockEl = document.getElementById('serverClock');
    const kpiEls = {
        totalMembers: document.getElementById('kpi-totalMembers'),
        upcomingEvents: document.getElementById('kpi-upcomingEvents'),
        activeConsultations: document.getElementById('kpi-activeConsultations'),
        documentsCount: document.getElementById('kpi-documentsCount'),
    };
    const eventTotalRegistrationsEl = document.getElementById('eventTotalRegistrations');

    const formatIdDateTime = (date) => {
        return new Intl.DateTimeFormat('id-ID', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
        }).format(date);
    };

    let serverNow = null;
    let clockTimer = null;

    const startClock = (isoString) => {
        const parsed = new Date(isoString);
        if (Number.isNaN(parsed.getTime())) return;
        serverNow = parsed;
        if (clockTimer) clearInterval(clockTimer);
        clockEl.textContent = formatIdDateTime(serverNow);
        clockTimer = setInterval(() => {
            serverNow = new Date(serverNow.getTime() + 1000);
            clockEl.textContent = formatIdDateTime(serverNow);
        }, 1000);
    };

    const refreshKpis = async () => {
        const res = await fetch('{{ route('admin.dashboard.summary') }}', { headers: { 'Accept': 'application/json' } });
        if (!res.ok) return;
        const data = await res.json();

        if (typeof data.totalMembers !== 'undefined' && kpiEls.totalMembers) kpiEls.totalMembers.textContent = data.totalMembers;
        if (typeof data.upcomingEvents !== 'undefined' && kpiEls.upcomingEvents) kpiEls.upcomingEvents.textContent = data.upcomingEvents;
        if (typeof data.activeConsultations !== 'undefined' && kpiEls.activeConsultations) kpiEls.activeConsultations.textContent = data.activeConsultations;
        if (typeof data.documentsCount !== 'undefined' && kpiEls.documentsCount) kpiEls.documentsCount.textContent = data.documentsCount;
        if (data.serverTime) startClock(data.serverTime);
    };

    try {
        const mg = await fetch('/api/v1/charts/members-growth').then(r=>r.json());
        const ep = await fetch('/api/v1/charts/event-participation').then(r=>r.json());
        if (eventTotalRegistrationsEl && Array.isArray(ep.data)) {
            const total = ep.data.reduce((sum, n) => sum + (Number(n) || 0), 0);
            eventTotalRegistrationsEl.textContent = total.toString();
        }
        
        // Members Growth Chart
        new Chart(document.getElementById('membersGrowthChart'), {
            type: 'line',
            data: {
                labels: mg.labels,
                datasets: [{
                    label: 'Anggota Baru',
                    data: mg.data,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 4], color: '#f3f4f6' },
                        ticks: { font: { size: 11 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 } }
                    }
                }
            }
        });

        // Event Participation Chart
        new Chart(document.getElementById('eventParticipationChart'), {
            type: 'doughnut',
            data: {
                labels: ep.labels,
                datasets: [{
                    data: ep.data,
                    backgroundColor: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20, font: { size: 11 } }
                    }
                }
            }
        });
    } catch (e) {
        console.error('Error loading charts:', e);
    }

    await refreshKpis();
    setInterval(refreshKpis, 30000);
});
</script>
@endpush
