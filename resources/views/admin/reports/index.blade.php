@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Reports</h1>
<x-card>
    <x-slot:title>Analytics</x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="rounded-lg border p-4 h-64">Members report chart placeholder.</div>
        <div class="rounded-lg border p-4 h-64">Events report chart placeholder.</div>
    </div>
</x-card>
@endsection

