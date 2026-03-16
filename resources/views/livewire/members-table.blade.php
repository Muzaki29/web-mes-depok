<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari anggota..." class="px-3 py-2 rounded-md border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300">
                <option>5</option>
                <option>10</option>
                <option>20</option>
            </select>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            @if(count($selected) > 0)
                <div class="flex flex-wrap items-center gap-2 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200 animate-fade-in-up">
                    <span class="text-sm text-emerald-700 font-medium">{{ count($selected) }} dipilih</span>
                    <button wire:click="confirmBulkDelete" class="text-xs bg-red-100 text-red-700 hover:bg-red-200 px-2 py-1 rounded transition-colors">
                        Hapus yang Dipilih
                    </button>
                </div>
            @endif
            <x-button wire:click="create">Tambah Anggota</x-button>
        </div>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 w-4">
                    <input type="checkbox" wire:model.live="selectAll" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Anggota</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berlaku Sampai</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $row)
            <tr wire:key="row-{{ $row->id }}" class="{{ in_array($row->id, $selected) ? 'bg-emerald-50' : '' }}">
                <td class="px-4 py-3">
                    <input type="checkbox" value="{{ $row->id }}" wire:model.live="selected" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                </td>
                <td class="px-4 py-3 text-gray-500">#{{ $row->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $row->name }}</td>
                <td class="px-4 py-3">{{ $row->membership_no }}</td>
                <td class="px-4 py-3">
                    @php
                        $categoryLabel = match (optional($row->category)->name) {
                            'Standard' => 'Standar',
                            'Premium' => 'Premium',
                            default => optional($row->category)->name,
                        };
                    @endphp
                    {{ $categoryLabel ?? '—' }}
                </td>
                <td class="px-4 py-3">
                    @php
                        $statusLabel = match ($row->status) {
                            'active' => 'Aktif',
                            'pending' => 'Menunggu',
                            'expired' => 'Kedaluwarsa',
                            'rejected' => 'Ditolak',
                            default => ucfirst($row->status),
                        };
                        $isActive = $row->status === 'active';
                    @endphp
                    <span class="inline-flex items-center gap-1 text-sm {{ $isActive ? 'text-emerald-700' : 'text-amber-700' }}">
                        <span class="h-2 w-2 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $statusLabel }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ optional($row->valid_until)->format('Y-m-d') }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="inline-flex gap-2">
                        <x-button size="sm" wire:click="edit({{ $row->id }})">Ubah</x-button>
                        <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $row->id }})">Hapus</x-button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-table>
    <div class="mt-4">
        {{ $paginator->links() }}
    </div>

    <x-modal wire:model="showCreate">
        <x-slot:title>Tambah Anggota</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nama</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
                <label class="text-sm text-gray-600">No Anggota</label>
                <input type="text" wire:model="form.membership_no" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Kategori</label>
                <select wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="Standard">Standar</option><option value="Premium">Premium</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="Active">Aktif</option>
                    <option value="Pending">Menunggu</option>
                    <option value="Expired">Kedaluwarsa</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Berlaku Sampai</label>
                <input type="date" wire:model="form.valid_until" class="mt-1 w-full rounded-md border-gray-300">
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
        <x-slot:title>Ubah Anggota</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nama</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">No Anggota</label>
                <input type="text" wire:model="form.membership_no" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Kategori</label>
                <select wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="Standard">Standar</option><option value="Premium">Premium</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="Active">Aktif</option>
                    <option value="Pending">Menunggu</option>
                    <option value="Expired">Kedaluwarsa</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Berlaku Sampai</label>
                <input type="date" wire:model="form.valid_until" class="mt-1 w-full rounded-md border-gray-300">
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
        <x-slot:title>Hapus Anggota</x-slot:title>
        <p>Yakin ingin menghapus anggota ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showBulkDelete" maxWidth="sm">
        <x-slot:title>Hapus Anggota Terpilih</x-slot:title>
        <p>Yakin ingin menghapus {{ count($selected) }} anggota terpilih?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroySelected">Hapus Semua</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
