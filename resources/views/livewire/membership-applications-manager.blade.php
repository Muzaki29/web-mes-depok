<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="status" class="px-2 py-2 rounded-md border border-gray-300">
                <option value="all">Semua</option>
                <option value="submitted">Submitted</option>
                <option value="reviewed">Reviewed</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>10</option><option>20</option><option>50</option></select>
        </div>
    </div>
    <x-table>
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
            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ ucfirst($m->status) }}</span></td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="secondary" wire:click="review({{ $m->id }})">Tinjau</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal :show="$showReview" maxWidth="md">
        <x-slot:title>Tinjau Aplikasi</x-slot:title>
        <p>Setujui atau tolak aplikasi keanggotaan ini. Persetujuan akan otomatis membuat data Member.</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="danger" wire:click="reject">Tolak</x-button>
                <x-button wire:click="approve">Setujui</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>

