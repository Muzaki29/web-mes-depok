<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari dokumen..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="category" class="px-2 py-2 rounded-md border border-gray-300">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300">
                <option value="6">6</option>
                <option value="12">12</option>
                <option value="24">24</option>
            </select>
        </div>
        <x-button wire:click="create">Tambah Dokumen</x-button>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Judul</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Kategori</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Visibilitas</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Ukuran</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @forelse($paginator as $doc)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $doc->title }}</td>
                <td class="px-4 py-3">{{ $doc->category->name ?? 'Tanpa Kategori' }}</td>
                <td class="px-4 py-3">
                    @php
                        $visLabel = match ($doc->visibility) {
                            'public' => 'Publik',
                            'member' => 'Anggota',
                            'role' => 'Role',
                            'private' => 'Privat',
                            default => $doc->visibility,
                        };
                    @endphp
                    <span>{{ $visLabel }}{{ $doc->visibility === 'role' && $doc->role ? ' ('.$doc->role.')' : '' }}</span>
                </td>
                <td class="px-4 py-3">{{ $doc->size ? number_format($doc->size / 1024 / 1024, 2).' MB' : '—' }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ url('/documents/'.$doc->slug.'/download') }}" class="inline-flex items-center text-sm text-emerald-700 hover:underline">Unduh</a>
                        <x-button size="sm" variant="secondary" wire:click="edit({{ $doc->id }})">Ubah</x-button>
                        <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $doc->id }})">Hapus</x-button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">Tidak ada dokumen.</td>
            </tr>
        @endforelse
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <datalist id="docCategories">
        @foreach(array_filter($categories, fn ($c) => $c !== 'Semua') as $cat)
            <option value="{{ $cat }}"></option>
        @endforeach
    </datalist>

    <x-modal wire:model="showCreate">
        <x-slot:title>Tambah Dokumen</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-600">Kategori (opsional)</label>
                <input type="text" list="docCategories" wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300" placeholder="Contoh: Laporan">
                @error('form.category')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-600">Visibilitas</label>
                <select wire:model="form.visibility" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="public">Publik</option>
                    <option value="member">Anggota</option>
                    <option value="role">Role</option>
                    <option value="private">Privat</option>
                </select>
                @error('form.visibility')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Role (wajib jika visibilitas = Role)</label>
                <input type="text" wire:model="form.role" class="mt-1 w-full rounded-md border-gray-300" placeholder="Contoh: super_admin">
                @error('form.role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">File</label>
                <input type="file" wire:model="fileUpload" class="mt-1 w-full text-sm">
                @error('fileUpload')
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
        <x-slot:title>Ubah Dokumen</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-600">Kategori (opsional)</label>
                <input type="text" list="docCategories" wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.category')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm text-gray-600">Visibilitas</label>
                <select wire:model="form.visibility" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="public">Publik</option>
                    <option value="member">Anggota</option>
                    <option value="role">Role</option>
                    <option value="private">Privat</option>
                </select>
                @error('form.visibility')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Role (wajib jika visibilitas = Role)</label>
                <input type="text" wire:model="form.role" class="mt-1 w-full rounded-md border-gray-300">
                @error('form.role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Ganti File (opsional)</label>
                <input type="file" wire:model="fileUpload" class="mt-1 w-full text-sm">
                @error('fileUpload')
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
        <x-slot:title>Hapus Dokumen</x-slot:title>
        <p>Yakin ingin menghapus dokumen ini?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
