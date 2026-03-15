@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-semibold">Laporan</h1>
    <div class="flex flex-wrap items-center gap-2">
        <x-button variant="secondary" href="{{ route('admin.members.export_csv') }}">Ekspor Anggota (CSV)</x-button>
        <x-button variant="secondary" href="{{ route('admin.consultations.export_csv') }}">Ekspor Konsultasi (CSV)</x-button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-card class="lg:col-span-2">
        <x-slot:title>Pertumbuhan Anggota</x-slot:title>
        <div class="relative h-72 w-full">
            <canvas id="reportMembersGrowthChart"></canvas>
        </div>
    </x-card>
    <x-card>
        <x-slot:title>Partisipasi Agenda</x-slot:title>
        <div class="relative h-72 w-full">
            <canvas id="reportEventParticipationChart"></canvas>
        </div>
    </x-card>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const mg = await fetch('/api/v1/charts/members-growth').then(r=>r.json());
        const ep = await fetch('/api/v1/charts/event-participation').then(r=>r.json());

        new Chart(document.getElementById('reportMembersGrowthChart'), {
            type: 'bar',
            data: {
                labels: mg.labels,
                datasets: [{
                    label: 'Anggota Baru',
                    data: mg.data,
                    backgroundColor: 'rgba(16, 185, 129, 0.35)',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });

        new Chart(document.getElementById('reportEventParticipationChart'), {
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
                cutout: '70%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 18, font: { size: 11 } } }
                }
            }
        });
    } catch (e) {
        console.error('Error loading reports:', e);
    }
});
</script>
@endpush
