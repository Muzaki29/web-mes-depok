<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari pengajuan..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="status" class="px-2 py-2 rounded-md border border-gray-300">
                <option value="all">Semua</option>
                <option value="submitted">Diajukan</option>
                <option value="reviewed">Ditinjau</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </select>
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>10</option><option>20</option><option>50</option></select>
        </div>
    </div>
    <div class="sm:hidden space-y-3">
        @forelse($paginator as $m)
            @php
                $statusLabel = match ($m->status) {
                    'submitted' => 'Diajukan',
                    'reviewed' => 'Ditinjau',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                    default => ucfirst($m->status),
                };
            @endphp
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="font-semibold text-gray-900 truncate">{{ $m->name }}</div>
                        <div class="mt-0.5 text-xs text-gray-500 truncate">{{ $m->email }}</div>
                    </div>
                    <span class="shrink-0 inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ $statusLabel }}</span>
                </div>
                <div class="mt-3 text-xs">
                    <div class="text-gray-500">Organisasi</div>
                    <div class="font-medium text-gray-900 truncate">{{ $m->organization ?: '—' }}</div>
                </div>
                <div class="mt-4">
                    <x-button class="w-full" variant="secondary" wire:click="review({{ $m->id }})">Tinjau</x-button>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-gray-200 bg-white px-4 py-8 text-center text-sm text-gray-500 shadow-sm">Tidak ada pengajuan.</div>
        @endforelse
    </div>

    <x-table class="hidden sm:block">
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Nama</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Email</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Organisasi</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $m)
            <tr>
                <td class="px-4 py-3">{{ $m->name }}</td>
                <td class="px-4 py-3">{{ $m->email }}</td>
                <td class="px-4 py-3">{{ $m->organization ?: '—' }}</td>
                <td class="px-4 py-3">
                    @php
                        $statusLabel = match ($m->status) {
                            'submitted' => 'Diajukan',
                            'reviewed' => 'Ditinjau',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            default => ucfirst($m->status),
                        };
                    @endphp
                    <span class="inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ $statusLabel }}</span>
                </td>
                <td class="px-4 py-3 text-right">
                    <x-button size="sm" variant="secondary" wire:click="review({{ $m->id }})">Tinjau</x-button>
                </td>
            </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal wire:model="showReview" maxWidth="md" tone="blue">
        <x-slot:title>Tinjau Aplikasi</x-slot:title>
        <x-slot:subtitle>Setujui atau tolak permohonan keanggotaan.</x-slot:subtitle>
        <x-slot:icon>
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5s1.343 3.5 3 3.5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 20v-1a4 4 0 00-4-4H8a4 4 0 00-4 4v1" />
            </svg>
        </x-slot:icon>
        <p class="text-sm text-gray-600">Setujui atau tolak aplikasi keanggotaan ini. Jika disetujui, sistem akan otomatis membuat data Member.</p>
        <x-slot:footer>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                <x-button class="w-full sm:w-auto" variant="danger" wire:click="reject">Tolak</x-button>
                <x-button class="w-full sm:w-auto" wire:click="approve">Setujui</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
