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

    <x-modal wire:model="showCreate" tone="emerald">
        <x-slot:title>Tambah Anggota</x-slot:title>
        <x-slot:subtitle>Lengkapi data dasar anggota.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-2a4 4 0 014-4h4" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Nama</x-label>
                <x-input wire:model="form.name" placeholder="Nama lengkap" />
            </div>
            <div>
                <x-label>No Anggota</x-label>
                <x-input wire:model="form.membership_no" placeholder="Contoh: MES-0001" />
            </div>
            <div>
                <x-label>Kategori</x-label>
                <x-select wire:model="form.category">
                    <option value="Standard">Standar</option><option value="Premium">Premium</option>
                </x-select>
            </div>
            <div>
                <x-label>Status</x-label>
                <x-select wire:model="form.status">
                    <option value="Active">Aktif</option>
                    <option value="Pending">Menunggu</option>
                    <option value="Expired">Kedaluwarsa</option>
                </x-select>
            </div>
            <div class="sm:col-span-2">
                <x-label>Berlaku Sampai</x-label>
                <x-input type="date" wire:model="form.valid_until" />
            </div>
        </div>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showEdit" tone="emerald">
        <x-slot:title>Ubah Anggota</x-slot:title>
        <x-slot:subtitle>Perbarui data anggota dan masa berlaku.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v2m-4-4L8 12m8-8l-8 8m0 0H6a2 2 0 00-2 2v2m4-6l8 8m0 0v2a2 2 0 01-2 2h-2m4-4l-8-8" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Nama</x-label>
                <x-input wire:model="form.name" />
            </div>
            <div>
                <x-label>No Anggota</x-label>
                <x-input wire:model="form.membership_no" />
            </div>
            <div>
                <x-label>Kategori</x-label>
                <x-select wire:model="form.category">
                    <option value="Standard">Standar</option><option value="Premium">Premium</option>
                </x-select>
            </div>
            <div>
                <x-label>Status</x-label>
                <x-select wire:model="form.status">
                    <option value="Active">Aktif</option>
                    <option value="Pending">Menunggu</option>
                    <option value="Expired">Kedaluwarsa</option>
                </x-select>
            </div>
            <div class="sm:col-span-2">
                <x-label>Berlaku Sampai</x-label>
                <x-input type="date" wire:model="form.valid_until" />
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
        <x-slot:title>Hapus Anggota</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan anggota.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus anggota ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showBulkDelete" maxWidth="sm" tone="red">
        <x-slot:title>Hapus Anggota Terpilih</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan massal.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus {{ count($selected) }} anggota terpilih? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroySelected">Hapus Semua</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
