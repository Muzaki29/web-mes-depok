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

    <x-modal wire:model="showCreate">
        <x-slot:title>Tambah Mitra</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nama</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Tipe</label>
                <select wire:model="form.type" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="company">Perusahaan</option><option value="ngo">NGO</option><option value="gov">Pemerintah</option><option value="edu">Pendidikan</option><option value="other">Lainnya</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Website</label>
                <input type="text" wire:model="form.website" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Logo (opsional)</label>
                <input type="file" wire:model="logoUpload" class="mt-1 w-full text-sm">
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
        <x-slot:title>Ubah Mitra</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nama</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Tipe</label>
                <select wire:model="form.type" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="company">Perusahaan</option><option value="ngo">NGO</option><option value="gov">Pemerintah</option><option value="edu">Pendidikan</option><option value="other">Lainnya</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Website</label>
                <input type="text" wire:model="form.website" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Ganti Logo (opsional)</label>
                <input type="file" wire:model="logoUpload" class="mt-1 w-full text-sm">
                @if(!empty($form['logo']))
                    <div class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                        <img class="h-10 w-10 rounded-lg object-cover ring-1 ring-gray-200" src="{{ asset('storage/'.$form['logo']) }}" alt="{{ $form['name'] }}">
                        <span>Logo saat ini</span>
                    </div>
                @endif
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
        <x-slot:title>Hapus Mitra</x-slot:title>
        <p>Yakin ingin menghapus mitra ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
