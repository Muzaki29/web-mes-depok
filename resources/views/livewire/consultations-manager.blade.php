<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari konsultasi..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="status" class="px-2 py-2 rounded-md border border-gray-300">
                <option value="all">Semua Status</option>
                <option value="submitted">Diajukan</option>
                <option value="assigned">Ditugaskan</option>
                <option value="scheduled">Terjadwal</option>
                <option value="completed">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300">
                <option>5</option><option>10</option><option>20</option>
            </select>
        </div>
        <x-button wire:click="create">Tambah Konsultasi</x-button>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Pemohon</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Topik</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Jadwal</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>

        @forelse($paginator as $c)
            @php
                $statusLabel = match ($c->status) {
                    'submitted' => 'Diajukan',
                    'assigned' => 'Ditugaskan',
                    'scheduled' => 'Terjadwal',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => $c->status,
                };
                $statusClass = match ($c->status) {
                    'submitted' => 'bg-gray-100 text-gray-700',
                    'assigned' => 'bg-blue-50 text-blue-700',
                    'scheduled' => 'bg-amber-50 text-amber-700',
                    'completed' => 'bg-emerald-50 text-emerald-700',
                    'cancelled' => 'bg-red-50 text-red-700',
                    default => 'bg-gray-100 text-gray-700',
                };
            @endphp
            <tr>
                <td class="px-4 py-3 font-medium">{{ $c->requester_name }}</td>
                <td class="px-4 py-3">{{ $c->topic }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex px-2 py-1 rounded-full text-xs {{ $statusClass }}">{{ $statusLabel }}</span>
                </td>
                <td class="px-4 py-3">{{ optional($c->scheduled_at)->format('Y-m-d H:i') ?: '—' }}</td>
                <td class="px-4 py-3 text-right">
                    <x-button size="sm" variant="secondary" wire:click="edit({{ $c->id }})">Ubah</x-button>
                    <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $c->id }})">Hapus</x-button>
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-4 py-6 text-center text-sm text-gray-500" colspan="5">Belum ada data konsultasi.</td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-4">
        {{ $paginator->links() }}
    </div>

    <x-modal wire:model="showCreate">
        <x-slot:title>Tambah Konsultasi</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nama Pemohon</label>
                <input type="text" wire:model="form.requester_name" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.requester_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="submitted">Diajukan</option>
                    <option value="assigned">Ditugaskan</option>
                    <option value="scheduled">Terjadwal</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                @error('form.status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Topik</label>
                <input type="text" wire:model="form.topic" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.topic')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Jadwal (opsional)</label>
                <input type="datetime-local" wire:model="form.scheduled_at" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.scheduled_at')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
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
        <x-slot:title>Ubah Konsultasi</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nama Pemohon</label>
                <input type="text" wire:model="form.requester_name" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.requester_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="submitted">Diajukan</option>
                    <option value="assigned">Ditugaskan</option>
                    <option value="scheduled">Terjadwal</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                @error('form.status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Topik</label>
                <input type="text" wire:model="form.topic" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.topic')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Jadwal (opsional)</label>
                <input type="datetime-local" wire:model="form.scheduled_at" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.scheduled_at')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
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
        <x-slot:title>Hapus Konsultasi</x-slot:title>
        <p>Yakin ingin menghapus konsultasi ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
