<x-card>
    <x-slot:title>
        <div class="flex items-center justify-between">
            <span>Notifikasi Masuk</span>
            <x-button variant="ghost" size="sm" wire:click="markAllRead">Tandai semua dibaca</x-button>
        </div>
    </x-slot:title>

    @php
        $isPaginator = is_object($rows) && method_exists($rows, 'links');
        $items = $isPaginator ? $rows->items() : (is_iterable($rows) ? $rows : []);
    @endphp

    <div class="divide-y rounded-xl border border-gray-200 bg-white overflow-hidden">
        @forelse($items as $n)
            @php
                $title = $n->data['title'] ?? 'Notifikasi';
                $body = $n->data['body'] ?? null;
                $url = $n->data['url'] ?? null;
            @endphp
            <div class="p-4 flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="font-medium truncate {{ $n->read_at ? 'text-gray-900' : 'text-emerald-800' }}">{{ $title }}</p>
                        @if(! $n->read_at)
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-100">Baru</span>
                        @endif
                    </div>
                    @if($body)
                        <p class="mt-1 text-sm text-gray-600">{{ $body }}</p>
                    @endif
                    <p class="mt-2 text-xs text-gray-500">{{ optional($n->created_at)->format('Y-m-d H:i') }}</p>
                    @if($url)
                        <a href="{{ $url }}" class="mt-2 inline-block text-sm text-emerald-700 hover:underline">Buka</a>
                    @endif
                </div>
                <div class="shrink-0">
                    @if(! $n->read_at)
                        <x-button size="sm" variant="secondary" wire:click="markRead('{{ $n->id }}')">Tandai dibaca</x-button>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-4 text-sm text-gray-500">Belum ada notifikasi.</div>
        @endforelse
    </div>

    @if($isPaginator)
        <div class="mt-4">
            {{ $rows->links() }}
        </div>
    @endif
</x-card>

