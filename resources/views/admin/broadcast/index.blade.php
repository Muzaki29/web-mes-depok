@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Siaran</h1>
</div>
<div class="mt-6">
    <livewire:notifications-sender />
</div>
@endsection
