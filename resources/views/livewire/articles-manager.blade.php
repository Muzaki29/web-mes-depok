<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari artikel..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">Buat Artikel</x-button>
    </div>
    <div class="sm:hidden space-y-3">
        @forelse($paginator as $a)
            @php
                $statusLabel = $a->status === 'published' ? 'Terbit' : 'Draf';
            @endphp
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="font-semibold text-gray-900 truncate">{{ $a->title }}</div>
                        <div class="mt-0.5 text-xs text-gray-500">{{ optional($a->published_at)->format('Y-m-d H:i') ?: '—' }}</div>
                    </div>
                    <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs {{ $a->status=='published'?'bg-emerald-50 text-emerald-700':'bg-gray-100 text-gray-700' }}">{{ $statusLabel }}</span>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <x-button class="w-full" variant="secondary" wire:click="edit({{ $a->id }})">Ubah</x-button>
                    <x-button class="w-full" variant="danger" wire:click="confirmDelete({{ $a->id }})">Hapus</x-button>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-8 text-center text-sm text-gray-500 shadow-sm">Belum ada artikel.</div>
        @endforelse
    </div>

    <x-table class="hidden sm:block">
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Judul</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Terbit</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @forelse($paginator as $a)
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
        @empty
            <tr>
                <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">Belum ada artikel.</td>
            </tr>
        @endforelse
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal wire:model="showCreate" tone="gray">
        <x-slot:title>Buat Artikel</x-slot:title>
        <x-slot:subtitle>Tulis judul, ringkasan, dan konten artikel.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M8 8h5m-8 14h10a2 2 0 002-2V8l-6-5H5a2 2 0 00-2 2v15a2 2 0 002 2z" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <x-label>Judul</x-label>
                <x-input wire:model="form.title" placeholder="Judul artikel" />
            </div>
            <div class="sm:col-span-2">
                <x-label>Ringkasan</x-label>
                <x-textarea rows="3" wire:model="form.excerpt" placeholder="Ringkasan singkat untuk halaman berita."></x-textarea>
            </div>
            <div class="sm:col-span-2">
                <x-label>Thumbnail</x-label>
                <input type="file" wire:model="thumbnailUpload" class="mt-1 w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
            </div>
            <div class="sm:col-span-2">
                <x-label>Isi</x-label>
                <x-textarea rows="6" wire:model="form.body" placeholder="Tulis konten artikel di sini."></x-textarea>
            </div>
            <div>
                <x-label>Status</x-label>
                <x-select wire:model="form.status">
                    <option value="draft">Draf</option>
                    <option value="published">Terbit</option>
                </x-select>
            </div>
            <div>
                <x-label>Tanggal Terbit</x-label>
                <x-input type="datetime-local" wire:model="form.published_at" />
            </div>
        </div>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showEdit" tone="gray">
        <x-slot:title>Ubah Artikel</x-slot:title>
        <x-slot:subtitle>Perbarui konten dan pengaturan publikasi.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v2m-4-4L8 12m8-8l-8 8m0 0H6a2 2 0 00-2 2v2m4-6l8 8m0 0v2a2 2 0 01-2 2h-2m4-4l-8-8" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <x-label>Judul</x-label>
                <x-input wire:model="form.title" />
            </div>
            <div class="sm:col-span-2">
                <x-label>Ringkasan</x-label>
                <x-textarea rows="3" wire:model="form.excerpt"></x-textarea>
            </div>
            <div class="sm:col-span-2">
                <x-label>Thumbnail</x-label>
                <input type="file" wire:model="thumbnailUpload" class="mt-1 w-full text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
            </div>
            <div class="sm:col-span-2">
                <x-label>Isi</x-label>
                <x-textarea rows="6" wire:model="form.body"></x-textarea>
            </div>
            <div>
                <x-label>Status</x-label>
                <x-select wire:model="form.status">
                    <option value="draft">Draf</option>
                    <option value="published">Terbit</option>
                </x-select>
            </div>
            <div>
                <x-label>Tanggal Terbit</x-label>
                <x-input type="datetime-local" wire:model="form.published_at" />
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
        <x-slot:title>Hapus Artikel</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan artikel.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
