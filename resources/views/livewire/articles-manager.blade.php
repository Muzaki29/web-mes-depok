<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Search articles..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="perPage" class="px-2 py-2 rounded-md border border-gray-300"><option>5</option><option>10</option><option>20</option></select>
        </div>
        <x-button wire:click="create">New Article</x-button>
    </div>
    <x-table>
        <x-slot:head>
            <tr>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Title</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Published At</th>
                <th class="px-4 py-3"></th>
            </tr>
        </x-slot:head>
        @foreach($paginator as $a)
        <tr>
            <td class="px-4 py-3">{{ $a->title }}</td>
            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs {{ $a->status=='published'?'bg-emerald-50 text-emerald-700':'bg-gray-100 text-gray-700' }}">{{ ucfirst($a->status) }}</span></td>
            <td class="px-4 py-3">{{ optional($a->published_at)->format('Y-m-d H:i') ?: '—' }}</td>
            <td class="px-4 py-3 text-right">
                <x-button size="sm" variant="secondary" wire:click="edit({{ $a->id }})">Edit</x-button>
                <x-button size="sm" variant="danger" wire:click="confirmDelete({{ $a->id }})">Delete</x-button>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-4">{{ $paginator->links() }}</div>

    <x-modal :show="$showCreate">
        <x-slot:title>Create Article</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Title</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Excerpt</label>
                <textarea rows="3" wire:model="form.excerpt" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Thumbnail</label>
                <input type="file" wire:model="thumbnailUpload" class="mt-1 w-full text-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Body</label>
                <textarea rows="6" wire:model="form.body" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Published At</label>
                <input type="datetime-local" wire:model="form.published_at" class="mt-1 w-full rounded-md border-gray-300">
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
        <x-slot:title>Edit Article</x-slot:title>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Title</label>
                <input type="text" wire:model="form.title" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Excerpt</label>
                <textarea rows="3" wire:model="form.excerpt" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Thumbnail</label>
                <input type="file" wire:model="thumbnailUpload" class="mt-1 w-full text-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm text-gray-600">Body</label>
                <textarea rows="6" wire:model="form.body" class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>
            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select wire:model="form.status" class="mt-1 w-full rounded-md border-gray-300">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-600">Published At</label>
                <input type="datetime-local" wire:model="form.published_at" class="mt-1 w-full rounded-md border-gray-300">
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
        <x-slot:title>Delete Article</x-slot:title>
        <p>Are you sure you want to delete this article?</p>
        <x-slot:footer>
            <div class="flex justify-end gap-2">
                <x-button variant="secondary" x-on:click="$el.closest('[x-data]').__x.$data.open=false">Cancel</x-button>
                <x-button variant="danger" wire:click="destroy">Delete</x-button>
            </div>
        </x-slot:footer>
    </x-modal>
</div>
