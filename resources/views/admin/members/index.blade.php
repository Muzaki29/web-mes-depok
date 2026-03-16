@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Anggota</h1>
    <div class="flex items-center gap-2">
        <x-button variant="secondary" href="{{ route('admin.members.export_csv') }}">Ekspor CSV</x-button>
    </div>
 </div>
 <livewire:members-table />
@endsection
