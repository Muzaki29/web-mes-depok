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

    <div class="sm:hidden space-y-3">
        @forelse($paginator as $doc)
            @php
                $visLabel = match ($doc->visibility) {
                    'public' => 'Publik',
                    'member' => 'Anggota',
                    'role' => 'Role',
                    'private' => 'Privat',
                    default => $doc->visibility,
                };
                $visText = $visLabel.($doc->visibility === 'role' && $doc->role ? ' ('.$doc->role.')' : '');
            @endphp
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="font-semibold text-gray-900 truncate">{{ $doc->title }}</div>
                        <div class="mt-0.5 text-xs text-gray-500 truncate">{{ $doc->category->name ?? 'Tanpa Kategori' }}</div>
                    </div>
                    <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs bg-amber-50 text-amber-800">{{ $visText }}</span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <div class="text-gray-500">Ukuran</div>
                        <div class="font-medium text-gray-900">{{ $doc->size ? number_format($doc->size / 1024 / 1024, 2).' MB' : '—' }}</div>
                    </div>
                    <div class="text-right">
                        <a href="{{ url('/documents/'.$doc->slug.'/download') }}" class="inline-flex items-center text-sm font-medium text-emerald-700 hover:underline">Unduh</a>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <x-button class="w-full" variant="secondary" wire:click="edit({{ $doc->id }})">Ubah</x-button>
                    <x-button class="w-full" variant="danger" wire:click="confirmDelete({{ $doc->id }})">Hapus</x-button>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-8 text-center text-sm text-gray-500 shadow-sm">Tidak ada dokumen.</div>
        @endforelse
    </div>

    <x-table class="hidden sm:block">
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

    <x-modal wire:model="showCreate" tone="amber">
        <x-slot:title>Tambah Dokumen</x-slot:title>
        <x-slot:subtitle>Unggah file dan atur visibilitasnya.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9a2 2 0 00-.586-1.414l-4-4A2 2 0 0013 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3v6h6" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <x-label>Judul</x-label>
                <x-input wire:model="form.title" placeholder="Contoh: Laporan Tahunan 2026" />
                @error('form.title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-label>Kategori (opsional)</x-label>
                <x-input list="docCategories" wire:model="form.category" placeholder="Contoh: Laporan" />
                @error('form.category')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-label>Visibilitas</x-label>
                <x-select wire:model="form.visibility">
                    <option value="public">Publik</option>
                    <option value="member">Anggota</option>
                    <option value="role">Role</option>
                    <option value="private">Privat</option>
                </x-select>
                @error('form.visibility')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Role (wajib jika visibilitas = Role)</x-label>
                <x-input wire:model="form.role" placeholder="Contoh: super_admin" />
                @error('form.role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>File</x-label>
                <input type="file" wire:model="fileUpload" class="mt-1 w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                @error('fileUpload')
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

    <x-modal wire:model="showEdit" tone="amber">
        <x-slot:title>Ubah Dokumen</x-slot:title>
        <x-slot:subtitle>Perbarui metadata dan/atau ganti file.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v2m-4-4L8 12m8-8l-8 8m0 0H6a2 2 0 00-2 2v2m4-6l8 8m0 0v2a2 2 0 01-2 2h-2m4-4l-8-8" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <x-label>Judul</x-label>
                <x-input wire:model="form.title" />
                @error('form.title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-label>Kategori (opsional)</x-label>
                <x-input list="docCategories" wire:model="form.category" />
                @error('form.category')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-label>Visibilitas</x-label>
                <x-select wire:model="form.visibility">
                    <option value="public">Publik</option>
                    <option value="member">Anggota</option>
                    <option value="role">Role</option>
                    <option value="private">Privat</option>
                </x-select>
                @error('form.visibility')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Role (wajib jika visibilitas = Role)</x-label>
                <x-input wire:model="form.role" />
                @error('form.role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <x-label>Ganti File (opsional)</x-label>
                <input type="file" wire:model="fileUpload" class="mt-1 w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                @error('fileUpload')
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
        <x-slot:title>Hapus Dokumen</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan dokumen.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus dokumen ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
