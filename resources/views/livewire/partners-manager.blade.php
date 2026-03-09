<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Search partners..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">Add Partner</x-button>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Name</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Type</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Website</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $p)
        <tr>
            <td class="px-4 py-3">{{ $p['name'] }}</td>
            <td class="px-4 py-3 capitalize">{{ $p['type'] }}</td>
            <td class="px-4 py-3"><a href="#" class="text-emerald-700 hover:underline">{{ $p['website'] }}</a></td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="secondary" wire:click="edit({{ $p['id'] }})">Edit</x-button>
                <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $p['id'] }})">Delete</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal :show="$showCreate">
        <x-slot:title>Create Partner</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Type</label>
                <select wire:model="form.type" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="company">Company</option><option value="ngo">NGO</option><option value="gov">Gov</option><option value="edu">Edu</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Website</label>
                <input type="text" wire:model="form.website" class="mt-1 w-full rounded-md border-gray-300">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button wire:click="store">Save</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal :show="$showEdit">
        <x-slot:title>Edit Partner</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Type</label>
                <select wire:model="form.type" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="company">Company</option><option value="ngo">NGO</option><option value="gov">Gov</option><option value="edu">Edu</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Website</label>
                <input type="text" wire:model="form.website" class="mt-1 w-full rounded-md border-gray-300">
            </div>
        </div>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button wire:click="update">Update</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal :show="$showDelete" maxWidth="sm">
        <x-slot:title>Delete Partner</x-slot:title>
        <p>Are you sure you want to delete this partner?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button variant="danger" wire:click="destroy">Delete</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>

