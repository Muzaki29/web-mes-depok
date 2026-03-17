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

    <x-modal wire:model="showCreate">
        <x-slot:title>Buat Surat</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Template</label>
                <select wire:model="form.template_id" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="">—</option>
                    @foreach($templates as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Perihal</label>
                <input type="text" wire:model="form.subject" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Arah</label>
                <select wire:model="form.direction" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="outgoing">Keluar</option>
                    <option value="incoming">Masuk</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Nomor</label>
                <input type="text" wire:model="form.number" class="mt-1 w-full rounded-md border-gray-300" placeholder="Otomatis atau manual">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showEdit">
        <x-slot:title>Ubah Surat</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Template</label>
                <select wire:model="form.template_id" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="">—</option>
                    @foreach($templates as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Perihal</label>
                <input type="text" wire:model="form.subject" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Arah</label>
                <select wire:model="form.direction" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="outgoing">Keluar</option>
                    <option value="incoming">Masuk</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Nomor</label>
                <input type="text" wire:model="form.number" class="mt-1 w-full rounded-md border-gray-300" placeholder="Otomatis atau manual">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button wire:click="update">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showDelete" maxWidth="sm">
        <x-slot:title>Hapus Surat</x-slot:title>
        <p>Yakin ingin menghapus surat ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
