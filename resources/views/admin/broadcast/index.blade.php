@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Broadcast</h1>
    <x-button>New Announcement</x-button>
</div>
<x-alert type="info">Compose announcements and schedule email/WhatsApp broadcasts here.</x-alert>
@endsection

