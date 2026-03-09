<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-200 transition duration-200 will-change-transform hover:-translate-y-0.5 hover:shadow-md']) }}>
    @isset($title)
        <div class="px-4 py-3 border-b border-gray-200 font-semibold">{{ $title }}</div>
    @endisset
    <div class="p-4">
        {{ $slot }}
    </div>
</div>
