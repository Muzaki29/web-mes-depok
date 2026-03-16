@props(['show' => false, 'maxWidth' => '2xl'])
@php
    $wireModel = $attributes->wire('model')->value();
    $maxWidthClass = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        '6xl' => 'max-w-6xl',
        '7xl' => 'max-w-7xl',
    ][$maxWidth] ?? 'max-w-2xl';
@endphp
<div
    @if ($wireModel)
        x-data="{ open: @entangle($attributes->wire('model')).live }"
    @else
        x-data="{ open: @js($show) }"
    @endif
    x-cloak
    x-show="open"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display:none;"
    class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 overflow-y-auto"
>
    <div class="absolute inset-0 bg-black/40" @click="open=false"></div>
    <div class="relative w-full {{ $maxWidthClass }} mx-auto bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden max-h-[calc(100vh-2rem)] overflow-y-auto">
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
</div>
