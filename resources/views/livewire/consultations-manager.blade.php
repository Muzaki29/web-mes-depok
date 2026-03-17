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

    <x-modal wire:model="showCreate" tone="blue">
        <x-slot:title>Tambah Konsultasi</x-slot:title>
        <x-slot:subtitle>Catat permintaan konsultasi dan jadwal (opsional).</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8M8 14h5m-8 6h10a2 2 0 002-2V8l-6-5H5a2 2 0 00-2 2v13a2 2 0 002 2z" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Nama Pemohon</x-label>
                <x-input wire:model="form.requester_name" placeholder="Nama lengkap" />
                @error('form.requester_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-label>Status</x-label>
                <x-select wire:model="form.status">
                    <option value="submitted">Diajukan</option>
                    <option value="assigned">Ditugaskan</option>
                    <option value="scheduled">Terjadwal</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </x-select>
                @error('form.status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Topik</x-label>
                <x-input wire:model="form.topic" placeholder="Contoh: Konsultasi pembiayaan syariah" />
                @error('form.topic')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Jadwal (opsional)</x-label>
                <x-input type="datetime-local" wire:model="form.scheduled_at" />
                @error('form.scheduled_at')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showEdit" tone="blue">
        <x-slot:title>Ubah Konsultasi</x-slot:title>
        <x-slot:subtitle>Perbarui detail permintaan konsultasi.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v2m-4-4L8 12m8-8l-8 8m0 0H6a2 2 0 00-2 2v2m4-6l8 8m0 0v2a2 2 0 01-2 2h-2m4-4l-8-8" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Nama Pemohon</x-label>
                <x-input wire:model="form.requester_name" />
                @error('form.requester_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-label>Status</x-label>
                <x-select wire:model="form.status">
                    <option value="submitted">Diajukan</option>
                    <option value="assigned">Ditugaskan</option>
                    <option value="scheduled">Terjadwal</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </x-select>
                @error('form.status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Topik</x-label>
                <x-input wire:model="form.topic" />
                @error('form.topic')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Jadwal (opsional)</x-label>
                <x-input type="datetime-local" wire:model="form.scheduled_at" />
                @error('form.scheduled_at')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
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
        <x-slot:title>Hapus Konsultasi</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan konsultasi.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus konsultasi ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
