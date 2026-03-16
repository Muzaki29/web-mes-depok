@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Edit Profil</h1>
    <div class="flex items-center gap-2">
        <x-button variant="secondary" href="{{ route('member.dashboard') }}">Kembali</x-button>
    </div>
</div>

@if (session('status'))
    <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
@endif

@if ($errors->any())
    <x-alert type="danger" class="mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-card class="lg:col-span-2">
        <x-slot:title>Data Akun</x-slot:title>
        <form method="POST" action="{{ route('member.profile.save') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @csrf
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Nama</label>
                <input name="name" class="mt-1 w-full rounded-md border-gray-300" value="{{ old('name', $user->name) }}" />
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Email</label>
                <input name="email" type="email" class="mt-1 w-full rounded-md border-gray-300" value="{{ old('email', $user->email) }}" />
            </div>
            <div>
                <label class="text-sm text-gray-600">Password Baru</label>
                <input name="password" type="password" class="mt-1 w-full rounded-md border-gray-300" autocomplete="new-password" />
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password.</p>
            </div>
            <div>
                <label class="text-sm text-gray-600">Konfirmasi Password</label>
                <input name="password_confirmation" type="password" class="mt-1 w-full rounded-md border-gray-300" autocomplete="new-password" />
            </div>
            <div class="sm:col-span-2 flex items-center justify-end gap-2">
                <x-button variant="secondary" href="{{ route('member.dashboard') }}">Batal</x-button>
                <x-button>Simpan</x-button>
            </div>
        </form>
    </x-card>
    <x-card>
        <x-slot:title>Biodata Keanggotaan</x-slot:title>
        @if($member)
            <div class="space-y-3 text-sm">
                <div>
                    <div class="text-gray-500">No. Anggota</div>
                    <div class="font-medium">{{ $member->membership_no }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Kategori</div>
                    <div class="font-medium">{{ optional($member->category)->name ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Status</div>
                    <div class="font-medium">{{ $member->status }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Berlaku Sampai</div>
                    <div class="font-medium">{{ optional($member->valid_until)->format('Y-m-d') ?? '-' }}</div>
                </div>
            </div>
        @else
            <div class="text-sm text-gray-500">Data keanggotaan belum terhubung.</div>
        @endif
    </x-card>
</div>
@endsection

