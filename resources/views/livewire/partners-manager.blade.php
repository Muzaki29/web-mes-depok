<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari mitra..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">Tambah Mitra</x-button>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Logo</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Nama</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Tipe</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Website</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $p)
        <tr>
            <td class="px-4 py-3">
                @if(!empty($p->logo))
                    <img class="h-10 w-10 rounded-lg object-cover ring-1 ring-gray-200" src="{{ asset('storage/'.$p->logo) }}" alt="{{ $p->name }}">
                @else
                    <div class="h-10 w-10 rounded-lg bg-gray-100 ring-1 ring-gray-200"></div>
                @endif
            </td>
            <td class="px-4 py-3">{{ $p->name }}</td>
            <td class="px-4 py-3">
                @php
                    $typeLabel = match ($p->type) {
                        'company' => 'Perusahaan',
                        'ngo' => 'NGO',
                        'gov' => 'Pemerintah',
                        'edu' => 'Pendidikan',
                        'other' => 'Lainnya',
                        default => $p->type,
                    };
                @endphp
                <span class="capitalize">{{ $typeLabel }}</span>
            </td>
            <td class="px-4 py-3">
                @if(!empty($p->website))
                    <a href="{{ $p->website }}" target="_blank" rel="noopener noreferrer" class="text-emerald-700 hover:underline">{{ $p->website }}</a>
                @else
                    <span class="text-gray-400">—</span>
                @endif
            </td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="secondary" wire:click="edit({{ $p->id }})">Ubah</x-button>
                <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $p->id }})">Hapus</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal wire:model="showCreate" tone="blue">
        <x-slot:title>Tambah Mitra</x-slot:title>
        <x-slot:subtitle>Tambahkan mitra baru beserta logo dan tautan.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-label>Nama</x-label>
                <x-input wire:model="form.name" placeholder="Nama mitra" />
            </div>
            <div>
                <x-label>Tipe</x-label>
                <x-select wire:model="form.type">
                    <option value="company">Perusahaan</option><option value="ngo">NGO</option><option value="gov">Pemerintah</option><option value="edu">Pendidikan</option><option value="other">Lainnya</option>
                </x-select>
            </div>
            <div class="sm:col-span-2">
                <x-label>Website</x-label>
                <x-input wire:model="form.website" placeholder="https://..." />
            </div>
            <div class="sm:col-span-2">
                <x-label>Logo (opsional)</x-label>
                <input type="file" wire:model="logoUpload" class="mt-1 w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
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
        <x-slot:title>Ubah Mitra</x-slot:title>
        <x-slot:subtitle>Perbarui info mitra dan ganti logo bila perlu.</x-slot:subtitle>
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
                <x-label>Tipe</x-label>
                <x-select wire:model="form.type">
                    <option value="company">Perusahaan</option><option value="ngo">NGO</option><option value="gov">Pemerintah</option><option value="edu">Pendidikan</option><option value="other">Lainnya</option>
                </x-select>
            </div>
            <div class="sm:col-span-2">
                <x-label>Website</x-label>
                <x-input wire:model="form.website" placeholder="https://..." />
            </div>
            <div class="sm:col-span-2">
                <x-label>Ganti Logo (opsional)</x-label>
                <input type="file" wire:model="logoUpload" class="mt-1 w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                @if(!empty($form['logo']))
                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                        <img class="h-10 w-10 rounded-lg object-cover ring-1 ring-gray-200" src="{{ asset('storage/'.$form['logo']) }}" alt="{{ $form['name'] }}">
                        <span>Logo saat ini</span>
                    </div>
                @endif
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
        <x-slot:title>Hapus Mitra</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan mitra.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus mitra ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
