@extends('layouts.app')

@section('content')
@php
    $orgName = 'MES Depok';
    $primaryColor = '#16a34a';
    if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
        $orgName = \App\Models\SiteSetting::getValue('org.name', $orgName) ?? $orgName;
        $primaryColor = \App\Models\SiteSetting::getValue('theme.primary_color', $primaryColor) ?? $primaryColor;
    }
@endphp
<h1 class="text-2xl font-semibold mb-6">Pengaturan</h1>
<x-card>
    <x-slot:title>Pengaturan Umum</x-slot:title>
    @if (session('status'))
        <x-alert type="success">{{ session('status') }}</x-alert>
    @endif
    <form method="POST" action="{{ route('admin.settings.save') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @csrf
        <div>
            <label class="text-sm text-gray-600">Nama Organisasi</label>
            <input name="org_name" class="mt-1 w-full rounded-md border-gray-300" value="{{ old('org_name', $orgName) }}" />
            @error('org_name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="text-sm text-gray-600">Warna Utama</label>
            <input name="primary_color" type="color" class="mt-1 w-full rounded-md border-gray-300" value="{{ old('primary_color', $primaryColor) }}" />
            @error('primary_color')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-button>Simpan</x-button>
        </div>
    </form>
 </x-card>
@endsection
