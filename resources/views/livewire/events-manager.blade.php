<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari agenda..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300">
                <option>5</option><option>10</option><option>20</option>
            </select>
        </div>
        <x-button wire:click="create">Buat Agenda</x-button>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Judul</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Mulai</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Lokasi</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Kuota</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Publik</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @forelse($paginator as $e)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $e->title }}</td>
                <td class="px-4 py-3">{{ optional($e->start_at)->format('Y-m-d H:i') ?: '—' }}</td>
                <td class="px-4 py-3">{{ $e->location ?: '—' }}</td>
                <td class="px-4 py-3">{{ $e->capacity ?: '—' }}</td>
                <td class="px-4 py-3">{{ $e->is_public ? 'Ya' : 'Tidak' }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="inline-flex items-center gap-2">
                        <x-button size="sm" variant="secondary" wire:click="openParticipants({{ $e->id }})">Peserta</x-button>
                        <x-button size="sm" variant="secondary" wire:click="edit({{ $e->id }})">Ubah</x-button>
                        <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $e->id }})">Hapus</x-button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-4 py-6 text-center text-sm text-gray-500" colspan="6">Belum ada agenda.</td>
            </tr>
        @endforelse
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal wire:model="showCreate">
        <x-slot:title>Buat Agenda</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Mulai</label>
                <input type="datetime-local" wire:model="form.start_at" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Selesai (opsional)</label>
                <input type="datetime-local" wire:model="form.end_at" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Kategori (opsional)</label>
                <input type="text" wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Deskripsi (opsional)</label>
                <textarea rows="4" wire:model="form.description" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Lokasi (opsional)</label>
                <input type="text" wire:model="form.location" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Kuota</label>
                <input type="number" wire:model="form.capacity" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="flex items-end">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" class="rounded border-gray-300" wire:model="form.is_public">
                    <span class="text-sm text-gray-700">Publik</span>
                </label>
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
        <x-slot:title>Ubah Agenda</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Mulai</label>
                <input type="datetime-local" wire:model="form.start_at" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Selesai (opsional)</label>
                <input type="datetime-local" wire:model="form.end_at" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Kategori (opsional)</label>
                <input type="text" wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Deskripsi (opsional)</label>
                <textarea rows="4" wire:model="form.description" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Lokasi (opsional)</label>
                <input type="text" wire:model="form.location" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Kuota</label>
                <input type="number" wire:model="form.capacity" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="flex items-end">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" class="rounded border-gray-300" wire:model="form.is_public">
                    <span class="text-sm text-gray-700">Publik</span>
                </label>
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
        <x-slot:title>Hapus Agenda</x-slot:title>
        <p>Yakin ingin menghapus agenda ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showParticipants" maxWidth="lg">
        <x-slot:title>Peserta</x-slot:title>
        <div class="rounded-lg border border-gray-200 divide-y">
            @forelse($participants as $p)
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-start gap-3">
                        <span class="mt-2 h-2 w-2 rounded-full {{ $p['checked_in'] ? 'bg-emerald-500' : 'bg-gray-300' }}"></span>
                        <div class="leading-tight">
                            <div class="font-medium">{{ $p['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $p['email'] ?: '—' }}</div>
                        </div>
                    </div>
                    <x-button size="sm" wire:click="toggleCheckIn({{ (int) $participantsEventId }}, {{ $p['id'] }})">
                        {{ $p['checked_in'] ? 'Batalkan' : 'Absen' }}
                    </x-button>
                </div>
            @empty
                <div class="px-4 py-8 text-center text-sm text-gray-500">Belum ada peserta.</div>
            @endforelse
        </div>
        <x-slot:footer>
            <div class="flex justify-end">
                <x-button variant="secondary" x-on:click="open=false">Tutup</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
