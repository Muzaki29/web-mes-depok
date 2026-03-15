@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Agenda</h1>
    <x-button x-data @click="$dispatch('openCreateEvent')">Buat Agenda</x-button>
</div>
<livewire:events-manager />
@endsection
