<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Search members..." class="px-3 py-2 rounded-md border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300">
                <option>5</option>
                <option>10</option>
                <option>20</option>
            </select>
        </div>
        <div class="flex items-center gap-2">
            @if(count($selected) > 0)
                <div class="hidden sm:flex items-center gap-2 mr-4 bg-emerald-50 px-3 py-1 rounded-md border border-emerald-200 animate-fade-in-up">
                    <span class="text-sm text-emerald-700 font-medium">{{ count($selected) }} selected</span>
                    <button wire:click="confirmBulkDelete" class="text-xs bg-red-100 text-red-700 hover:bg-red-200 px-2 py-1 rounded transition-colors">
                        Delete Selected
                    </button>
                </div>
            @endif
            <x-button wire:click="create">Add Member</x-button>
        </div>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 w-4">
                    <input type="checkbox" wire:model.live="selectAll" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                </th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Membership No</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valid Until</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $row)
            <tr wire:key="row-{{ $row->id }}" class="{{ in_array($row->id, $selected) ? 'bg-emerald-50' : '' }}">
                <td class="px-4 py-3">
                    <input type="checkbox" value="{{ $row->id }}" wire:model.live="selected" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                </td>
                <td class="px-4 py-3 text-gray-500">#{{ $row->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $row->name }}</td>
                <td class="px-4 py-3">{{ $row->membership_no }}</td>
                <td class="px-4 py-3">{{ optional($row->category)->name ?? '—' }}</td>
                <td class="px-4 py-3">
                    @php
                        $status = ucfirst($row->status);
                        $isActive = $status === 'Active';
                    @endphp
                    <span class="inline-flex items-center gap-1 text-sm {{ $isActive ? 'text-emerald-700' : 'text-amber-700' }}">
                        <span class="h-2 w-2 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $status }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ optional($row->valid_until)->format('Y-m-d') }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="inline-flex gap-2">
                        <x-button size="sm" variant="secondary">View</x-button>
                        <x-button size="sm" wire:click="edit({{ $row->id }})">Edit</x-button>
                        <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $row->id }})">Delete</x-button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-table>
    <div class="mt-4">
        {{ $paginator->links() }}
    </div>

    <x-modal :show="$showCreate">
        <x-slot:title>Create Member</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
                <label class="text-sm text-gray-600">Membership No</label>
                <input type="text" wire:model="form.membership_no" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Category</label>
                <select wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
                    <option>Standard</option><option>Premium</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option>Active</option><option>Pending</option><option>Expired</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Valid Until</label>
                <input type="date" wire:model="form.valid_until" class="mt-1 w-full rounded-md border-gray-300">
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
        <x-slot:title>Edit Member</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Name</label>
                <input type="text" wire:model="form.name" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Membership No</label>
                <input type="text" wire:model="form.membership_no" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label class="text-sm text-gray-600">Category</label>
                <select wire:model="form.category" class="mt-1 w-full rounded-md border-gray-300">
                    <option>Standard</option><option>Premium</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option>Active</option><option>Pending</option><option>Expired</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Valid Until</label>
                <input type="date" wire:model="form.valid_until" class="mt-1 w-full rounded-md border-gray-300">
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
        <x-slot:title>Delete Member</x-slot:title>
        <p>Are you sure you want to delete this member?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button variant="danger" wire:click="destroy">Delete</x-button>
            </div>
        </x-slot:footer>
    </x-modal>

    <x-modal :show="$showBulkDelete" maxWidth="sm">
        <x-slot:title>Delete Selected Members</x-slot:title>
        <p>Are you sure you want to delete {{ count($selected) }} selected members?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button variant="danger" wire:click="destroySelected">Delete All</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>