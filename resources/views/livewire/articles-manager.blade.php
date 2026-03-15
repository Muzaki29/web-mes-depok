<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari artikel..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">Buat Artikel</x-button>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Judul</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Terbit</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $a)
        <tr>
            <td class="px-4 py-3">{{ $a->title }}</td>
            <td class="px-4 py-3">
                @php
                    $statusLabel = $a->status === 'published' ? 'Terbit' : 'Draf';
                @endphp
                <span class="inline-flex px-2 py-1 rounded-full text-xs {{ $a->status=='published'?'bg-emerald-50 text-emerald-700':'bg-gray-100 text-gray-700' }}">{{ $statusLabel }}</span>
            </td>
            <td class="px-4 py-3">{{ optional($a->published_at)->format('Y-m-d H:i') ?: '—' }}</td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="secondary" wire:click="edit({{ $a->id }})">Ubah</x-button>
                <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $a->id }})">Hapus</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal :show="$showCreate">
        <x-slot:title>Buat Artikel</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Ringkasan</label>
                <textarea rows="3" wire:model="form.excerpt" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Thumbnail</label>
                <input type="file" wire:model="thumbnailUpload" class="mt-1 w-full text-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Isi</label>
                <textarea rows="6" wire:model="form.body" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="draft">Draf</option>
                    <option value="published">Terbit</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Tanggal Terbit</label>
                <input type="datetime-local" wire:model="form.published_at" class="mt-1 w-full rounded-md border-gray-300">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Batal</x-button>
                <x-button wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal :show="$showEdit">
        <x-slot:title>Ubah Artikel</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Ringkasan</label>
                <textarea rows="3" wire:model="form.excerpt" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Thumbnail</label>
                <input type="file" wire:model="thumbnailUpload" class="mt-1 w-full text-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Isi</label>
                <textarea rows="6" wire:model="form.body" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="draft">Draf</option>
                    <option value="published">Terbit</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Tanggal Terbit</label>
                <input type="datetime-local" wire:model="form.published_at" class="mt-1 w-full rounded-md border-gray-300">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Batal</x-button>
                <x-button wire:click="update">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal :show="$showDelete" maxWidth="sm">
        <x-slot:title>Hapus Artikel</x-slot:title>
        <p>Yakin ingin menghapus artikel ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
