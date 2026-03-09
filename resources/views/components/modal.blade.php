@props(['show' => false, 'maxWidth' => '2xl'])
<div x-data="{open:@js($show)}" x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/40" @click="open=false"></div>
    <div class="relative w-full max-w-{{ $maxWidth }} mx-auto bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b">
            <h3 class="font-semibold">{{ $title ?? 'Modal' }}</h3>
            <button class="p-2 rounded-md hover:bg-gray-100" @click="open=false">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
        <div class="p-4">
            {{ $slot }}
        </div>
        @isset($footer)
            <div class="px-4 py-3 border-t bg-gray-50">{{ $footer }}</div>
        @endisset
    </div>
    <template x-teleport="body">
        <style>[x-cloak]{display:none!important}</style>
    </template>
    <script></script>
</div>

