@extends('layouts.public')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-3xl font-semibold">About EconoComm</h1>
    <p class="mt-3 text-gray-600">We are a network of organizations advancing ethical economics through capacity building, events, and partnerships.</p>
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <x-card>
            <x-slot:title>Our Mission</x-slot:title>
            To empower sustainable, inclusive economies by connecting members, partners, and communities.
        </x-card>
        <x-card>
            <x-slot:title>Our Values</x-slot:title>
            Ethics, transparency, collaboration, and long-term development.
        </x-card>
    </div>
</div>
@endsection
