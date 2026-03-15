@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Siaran</h1>
    <x-button href="{{ route('admin.announcements') }}">Buat Pengumuman</x-button>
</div>
<x-alert type="info">Gunakan pengumuman sebagai konten broadcast. Integrasi email/WhatsApp bisa ditambahkan pada tahap berikutnya.</x-alert>
<div class="mt-6">
    <livewire:announcements-manager />
</div>
@endsection
