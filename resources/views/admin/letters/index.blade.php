@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Surat</h1>
    <x-button x-data @click="$dispatch('openCreateLetter')">Buat Surat</x-button>
</div>
<livewire:letters-manager />
@endsection
