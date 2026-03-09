@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Events</h1>
    <x-button>Create Event</x-button>
</div>
<livewire:events-manager />
@endsection

