<x-card>
    <x-slot:title>Buat Notifikasi</x-slot:title>

    @if (session('status'))
        <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="text-sm text-gray-600">Target</label>
            <select wire:model="form.audience" class="mt-1 w-full rounded-md border-gray-300">
                <option value="members">Anggota</option>
                <option value="admins">Admin</option>
                <option value="all">Semua pengguna</option>
                <option value="email">Email tertentu</option>
            </select>
            @error('form.audience') <div class="text-xs text-rose-600 mt-1">{{ $message }}</div> @enderror
        </div>
        <div>
            <label class="text-sm text-gray-600">Email (jika target email)</label>
            <input wire:model="form.email" class="mt-1 w-full rounded-md border-gray-300" placeholder="nama@domain.com" />
            @error('form.email') <div class="text-xs text-rose-600 mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="sm:col-span-2">
            <label class="text-sm text-gray-600">Judul</label>
            <input wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300" placeholder="Judul notifikasi" />
            @error('form.title') <div class="text-xs text-rose-600 mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="sm:col-span-2">
            <label class="text-sm text-gray-600">Pesan</label>
            <textarea wire:model="form.body" rows="4" class="mt-1 w-full rounded-md border-gray-300" placeholder="Isi notifikasi (opsional)"></textarea>
            @error('form.body') <div class="text-xs text-rose-600 mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="sm:col-span-2">
            <label class="text-sm text-gray-600">URL (opsional)</label>
            <input wire:model="form.url" class="mt-1 w-full rounded-md border-gray-300" placeholder="/member/dashboard atau https://..." />
            @error('form.url') <div class="text-xs text-rose-600 mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="sm:col-span-2 flex items-center justify-end gap-2">
            <x-button variant="secondary" wire:click="resetForm">Reset</x-button>
            <x-button wire:click="send">Kirim</x-button>
        </div>
    </div>
</x-card>
