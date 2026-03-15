@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Mitra</h1>
    <x-button x-data @click="$dispatch('openCreatePartner')">Tambah Mitra</x-button>
</div>
<livewire:partners-manager />
@endsection
