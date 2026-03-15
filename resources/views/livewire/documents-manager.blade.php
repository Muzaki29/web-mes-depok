<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live="search" placeholder="Cari dokumen..." class="px-3 py-2 rounded-md border border-gray-300">
            <select wire:model.live="category" class="px-2 py-2 rounded-md border border-gray-300">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center gap-2">
            <input type="file" wire:model="upload" class="block w-full text-sm">
            <x-button wire:click="upload">Unggah</x-button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($items as $doc)
            <x-card>
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-medium">{{ $doc['title'] }}</p>
                        <p class="text-sm text-gray-500">{{ $doc['category'] }} • {{ $doc['size'] }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($doc['path'])
                            <a href="{{ url('/documents/'.$doc['slug'].'/download') }}" class="inline-flex items-center text-sm text-emerald-700 hover:underline">Unduh</a>
                        @else
                            <span class="text-xs text-gray-400">Contoh</span>
                        @endif
                        <x-button size="sm" variant="danger" wire:click="remove({{ $doc['id'] }})">Hapus</x-button>
                    </div>
                </div>
                <div class="mt-3 rounded-lg border border-dashed p-3 text-sm text-gray-500 bg-gray-50">
                    Pratinjau file belum tersedia.
                </div>
            </x-card>
        @endforeach
        @if(empty($items))
            <x-card>Tidak ada dokumen.</x-card>
        @endif
    </div>
</div>
