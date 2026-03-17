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

    <div class="sm:hidden space-y-3">
        @forelse($paginator as $e)
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="font-semibold text-gray-900 truncate">{{ $e->title }}</div>
                        <div class="mt-0.5 text-xs text-gray-500">{{ optional($e->start_at)->format('Y-m-d H:i') ?: '—' }}</div>
                    </div>
                    <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs {{ $e->is_public ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">{{ $e->is_public ? 'Publik' : 'Internal' }}</span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <div class="text-gray-500">Lokasi</div>
                        <div class="font-medium text-gray-900 truncate">{{ $e->location ?: '—' }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500">Kuota</div>
                        <div class="font-medium text-gray-900">{{ $e->capacity ?: '—' }}</div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <x-button class="w-full" variant="secondary" wire:click="openParticipants({{ $e->id }})">Peserta</x-button>
                    <x-button class="w-full" variant="secondary" wire:click="edit({{ $e->id }})">Ubah</x-button>
                    <x-button class="w-full col-span-2" variant="danger" wire:click="confirmDelete({{ $e->id }})">Hapus</x-button>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-8 text-center text-sm text-gray-500 shadow-sm">Belum ada agenda.</div>
        @endforelse
    </div>

    <x-table class="hidden sm:block">
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

    <x-modal wire:model="showCreate" tone="emerald">
        <x-slot:title>Buat Agenda</x-slot:title>
        <x-slot:subtitle>Tambahkan agenda baru dan atur visibilitasnya.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </x-slot:icon>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <x-label>Judul</x-label>
                <x-input wire:model="form.title" placeholder="Contoh: Seminar Ekonomi Syariah" />
            </div>
            <div>
                <x-label>Mulai</x-label>
                <x-input type="datetime-local" wire:model="form.start_at" />
            </div>
            <div>
                <x-label>Selesai (opsional)</x-label>
                <x-input type="datetime-local" wire:model="form.end_at" />
            </div>
            <div class="sm:col-span-2">
                <x-label>Kategori (opsional)</x-label>
                <x-input wire:model="form.category" placeholder="Contoh: Workshop" />
            </div>
            <div class="sm:col-span-2">
                <x-label>Deskripsi (opsional)</x-label>
                <x-textarea rows="4" wire:model="form.description" placeholder="Tulis ringkasan agenda, narasumber, dan informasi penting lainnya."></x-textarea>
            </div>
            <div class="sm:col-span-2">
                <x-label>Lokasi (opsional)</x-label>
                <x-input wire:model="form.location" placeholder="Contoh: Aula Balai Kota Depok" />
            </div>
            <div>
                <x-label>Kuota</x-label>
                <x-input type="number" wire:model="form.capacity" min="1" />
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 w-full">
                    <input type="checkbox" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500/30" wire:model="form.is_public">
                    <span class="text-sm font-medium text-gray-800">Publik</span>
                    <span class="ml-auto text-xs text-gray-500">Ditampilkan di halaman publik</span>
                </label>
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
        <x-slot:title>Ubah Agenda</x-slot:title>
        <x-slot:subtitle>Perbarui detail agenda, jadwal, dan pengaturan publik.</x-slot:subtitle>
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
            <div>
                <x-label>Mulai</x-label>
                <x-input type="datetime-local" wire:model="form.start_at" />
            </div>
            <div>
                <x-label>Selesai (opsional)</x-label>
                <x-input type="datetime-local" wire:model="form.end_at" />
            </div>
            <div class="sm:col-span-2">
                <x-label>Kategori (opsional)</x-label>
                <x-input wire:model="form.category" />
            </div>
            <div class="sm:col-span-2">
                <x-label>Deskripsi (opsional)</x-label>
                <x-textarea rows="4" wire:model="form.description"></x-textarea>
            </div>
            <div class="sm:col-span-2">
                <x-label>Lokasi (opsional)</x-label>
                <x-input wire:model="form.location" />
            </div>
            <div>
                <x-label>Kuota</x-label>
                <x-input type="number" wire:model="form.capacity" min="1" />
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 w-full">
                    <input type="checkbox" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500/30" wire:model="form.is_public">
                    <span class="text-sm font-medium text-gray-800">Publik</span>
                    <span class="ml-auto text-xs text-gray-500">Ditampilkan di halaman publik</span>
                </label>
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
        <x-slot:title>Hapus Agenda</x-slot:title>
        <x-slot:subtitle>Konfirmasi penghapusan agenda.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0l1-2h6l1 2m-9 0h10" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Batal</x-button>
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="destroy">Hapus</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal wire:model="showParticipants" maxWidth="lg" tone="blue">
        <x-slot:title>Peserta</x-slot:title>
        <x-slot:subtitle>Daftar peserta dan status kehadiran.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </x-slot:icon>
        <div class="rounded-xl border border-gray-200 divide-y bg-white">
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
                <x-button class="w-full sm:w-auto" variant="secondary" x-on:click="open=false">Tutup</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
