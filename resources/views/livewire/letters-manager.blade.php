<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Search letters..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">New Letter</x-button>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Number</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Subject</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Direction</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $l)
        <tr>
            <td class="px-4 py-3">{{ $l['number'] }}</td>
            <td class="px-4 py-3">{{ $l['subject'] }}</td>
            <td class="px-4 py-3 capitalize">{{ $l['direction'] }}</td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $l['id'] }})">Delete</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal :show="$showCreate">
        <x-slot:title>Create Letter</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Template</label>
                <select wire:model="form.template_id" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="">—</option>
                    @foreach($templates as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Subject</label>
                <input type="text" wire:model="form.subject" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Direction</label>
                <select wire:model="form.direction" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="outgoing">Outgoing</option>
                    <option value="incoming">Incoming</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Number</label>
                <input type="text" wire:model="form.number" class="mt-1 w-full rounded-md border-gray-300" placeholder="Auto or manual">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button wire:click="store">Save</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal :show="$showDelete" maxWidth="sm">
        <x-slot:title>Delete Letter</x-slot:title>
        <p>Are you sure you want to delete this letter?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button variant="danger" wire:click="destroy">Delete</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
