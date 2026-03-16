@extends('layouts.app')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold">Konsultasi</h1>
    <div class="flex flex-wrap items-center gap-2">
        <x-button variant="secondary" href="{{ route('admin.consultations.export_csv') }}">Ekspor Konsultasi (CSV)</x-button>
    </div>
</div>
<livewire:consultations-manager />
@endsection
