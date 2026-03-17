<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari surat..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">Buat Surat</x-button>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Nomor</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Perihal</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Arah</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $l)
        <tr>
            <td class="px-4 py-3">{{ $l['number'] }}</td>
            <td class="px-4 py-3">{{ $l['subject'] }}</td>
            <td class="px-4 py-3 capitalize">{{ $l['direction'] === 'outgoing' ? 'Keluar' : 'Masuk' }}</td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="secondary" wire:click="edit({{ $l['id'] }})">Ubah</x-button>
                <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $l['id'] }})">Hapus</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal wire:model="showCreate" tone="purple">
        <x-slot:title>Buat Surat</x-slot:title>
        <x-slot:subtitle>Pilih template, isi perihal, dan nomor surat.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Template</x-label>
                <x-select wire:model="form.template_id">
                    <option value="">—</option>
                    @foreach($templates as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->code }})</option>
                    @endforeach
                </x-select>
            </div>
            <div class="sm:col-span-2">
                <x-label>Perihal</x-label>
                <x-input wire:model="form.subject" placeholder="Contoh: Undangan Rapat" />
            </div>
            <div>
                <x-label>Arah</x-label>
                <x-select wire:model="form.direction">
                    <option value="outgoing">Keluar</option>
                    <option value="incoming">Masuk</option>
                </x-select>
            </div>
            <div>
                <x-label>Nomor</x-label>
                <x-input wire:model="form.number" placeholder="Otomatis atau manual" />
            </div>
        </div>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showEdit" tone="purple">
        <x-slot:title>Ubah Surat</x-slot:title>
        <x-slot:subtitle>Perbarui detail surat sebelum disimpan.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v2m-4-4L8 12m8-8l-8 8m0 0H6a2 2 0 00-2 2v2m4-6l8 8m0 0v2a2 2 0 01-2 2h-2m4-4l-8-8" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Template</x-label>
                <x-select wire:model="form.template_id">
                    <option value="">—</option>
                    @foreach($templates as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->code }})</option>
                    @endforeach
                </x-select>
            </div>
            <div class="sm:col-span-2">
                <x-label>Perihal</x-label>
                <x-input wire:model="form.subject" />
            </div>
            <div>
                <x-label>Arah</x-label>
                <x-select wire:model="form.direction">
                    <option value="outgoing">Keluar</option>
                    <option value="incoming">Masuk</option>
                </x-select>
            </div>
            <div>
                <x-label>Nomor</x-label>
                <x-input wire:model="form.number" placeholder="Otomatis atau manual" />
            </div>
        </div>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" wire:click="update">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showDelete" maxWidth="sm" tone="red">
        <x-slot:title>Hapus Surat</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan surat.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus surat ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
