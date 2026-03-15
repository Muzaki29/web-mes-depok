<div x-data="{tab:'events'}">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari agenda..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300">
                <option>5</option><option>10</option><option>20</option>
            </select>
        </div>
        <x-button wire:click="create">Buat Agenda</x-button>
    </div>

    <div class="mb-4">
        <nav class="inline-flex rounded-lg bg-white shadow-sm border border-gray-200 overflow-hidden">
            <button class="px-4 py-2 text-sm" :class="tab==='events'?'bg-emerald-50 text-emerald-700':''" @click="tab='events'">Agenda</button>
            <button class="px-4 py-2 text-sm border-l" :class="tab==='participants'?'bg-emerald-50 text-emerald-700':''" @click="tab='participants'">Peserta</button>
        </nav>
    </div>

    <div x-show="tab==='events'">
        <x-table>
            <x-slot:head>
                <tr>
                    <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Judul</th>
                    <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Lokasi</th>
                    <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Kapasitas</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </x-slot:head>
            @foreach($paginator as $e)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $e['title'] }}</td>
                <td class="px-4 py-3">{{ $e['date'] }}</td>
                <td class="px-4 py-3">{{ $e['location'] }}</td>
                <td class="px-4 py-3">{{ $e['capacity'] }}</td>
                <td class="px-4 py-3 text-right">
                    <x-button size="sm" variant="secondary" @click="tab='participants'">Peserta</x-button>
                </td>
            </tr>
            @endforeach
        </x-table>
        <div class="mt-4">{{ $paginator->links() }}</div>
    </div>

    <div x-show="tab==='participants'">
        <x-card>
            <x-slot:title>Peserta</x-slot:title>
            @foreach($events as $e)
                <div class="mb-4">
                    <p class="font-medium">{{ $e['title'] }}</p>
                    <div class="mt-2 rounded-lg border">
                        <div class="divide-y">
                            @foreach(($participants[$e['id']] ?? []) as $p)
                                <div class="flex items-center justify-between px-4 py-2">
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full {{ $p['checked_in']?'bg-emerald-500':'bg-gray-300' }}"></span>
                                        <span>{{ $p['name'] }}</span>
                                    </div>
                                    <x-button size="sm" wire:click="toggleCheckIn({{ $e['id'] }}, {{ $p['id'] }})">{{ $p['checked_in']?'Batalkan':'Absen' }}</x-button>
                                </div>
                            @endforeach
                            @if(empty($participants[$e['id']] ?? []))
                                <div class="px-4 py-6 text-gray-500 text-sm">Belum ada peserta.</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </x-card>
    </div>

    <x-modal :show="$showCreate">
        <x-slot:title>Buat Agenda</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Judul</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Tanggal</label>
                <input type="date" wire:model="form.date" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Lokasi</label>
                <input type="text" wire:model="form.location" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Kapasitas</label>
                <input type="number" wire:model="form.capacity" class="mt-1 w-full rounded-md border-gray-300">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Batal</x-button>
                <x-button wire:click="store">Simpan</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
