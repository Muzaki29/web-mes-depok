@props(['show' => false, 'maxWidth' => '2xl', 'tone' => 'emerald'])
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
    $toneClass = [
        'emerald' => ['bar' => 'bg-emerald-500', 'soft' => 'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'blue' => ['bar' => 'bg-blue-500', 'soft' => 'bg-blue-50 text-blue-700 ring-blue-200'],
        'amber' => ['bar' => 'bg-amber-500', 'soft' => 'bg-amber-50 text-amber-700 ring-amber-200'],
        'purple' => ['bar' => 'bg-purple-500', 'soft' => 'bg-purple-50 text-purple-700 ring-purple-200'],
        'red' => ['bar' => 'bg-red-500', 'soft' => 'bg-red-50 text-red-700 ring-red-200'],
        'gray' => ['bar' => 'bg-gray-500', 'soft' => 'bg-gray-100 text-gray-700 ring-gray-200'],
    ][$tone] ?? ['bar' => 'bg-emerald-500', 'soft' => 'bg-emerald-50 text-emerald-700 ring-emerald-200'];
@endphp
<div
    @if ($wireModel)
        x-data="{ open: @entangle($attributes->wire('model')).live }"
    @else
        x-data="{ open: @js($show) }"
    @endif
    x-cloak
    x-show="open"
    @keydown.escape.window="open=false"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display:none;"
    class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4 overflow-y-auto"
>
    <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]" @click="open=false"></div>
    <div
        role="dialog"
        aria-modal="true"
        tabindex="-1"
        class="relative w-full {{ $maxWidthClass }} mx-auto bg-white rounded-t-3xl sm:rounded-2xl shadow-2xl ring-1 ring-black/5 overflow-hidden max-h-[100dvh] sm:max-h-[calc(100vh-2rem)] overflow-y-auto pb-[env(safe-area-inset-bottom)]"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2 scale-[0.98]"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-[0.98]"
    >
        <div class="sticky top-0 z-10 border-b bg-white/90 backdrop-blur">
            <div class="h-1 w-full {{ $toneClass['bar'] }}"></div>
            <div class="flex items-start justify-between px-4 sm:px-5 py-4">
                <div class="flex items-start gap-3 min-w-0">
                    @isset($icon)
                        <div class="mt-0.5 inline-flex h-10 w-10 items-center justify-center rounded-xl ring-1 {{ $toneClass['soft'] }}">
                            {{ $icon }}
                        </div>
                    @endisset
                    <div class="min-w-0">
                        <h3 class="text-base font-semibold tracking-tight text-gray-900 truncate">{{ $title ?? 'Modal' }}</h3>
                        @isset($subtitle)
                            <p class="mt-0.5 text-sm text-gray-500">{{ $subtitle }}</p>
                        @endisset
                    </div>
                </div>
                <button type="button" class="shrink-0 p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/50" @click="open=false">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>
        <div class="px-4 sm:px-5 py-4">
            {{ $slot }}
        </div>
        @isset($footer)
            <div class="sticky bottom-0 z-10 px-4 sm:px-5 py-4 border-t bg-gray-50/80 backdrop-blur">{{ $footer }}</div>
        @endisset
    </div>
</div>
