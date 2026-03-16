@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Notifikasi</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <livewire:notifications-sender />
    <livewire:notifications-center />
</div>
@endsection

