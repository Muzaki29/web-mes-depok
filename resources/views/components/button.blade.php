@php
    $variants = [
        'primary' => 'bg-emerald-600 hover:bg-emerald-700 text-white',
        'secondary' => 'bg-gray-100 hover:bg-gray-200 text-gray-900',
        'danger' => 'bg-rose-600 hover:bg-rose-700 text-white',
        'ghost' => 'bg-transparent hover:bg-gray-100 text-gray-700',
    ];
    $size = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5',
    ][$attributes->get('size','md')];
    $variant = $variants[$attributes->get('variant','primary')] ?? $variants['primary'];
    $href = $attributes->get('href');
@endphp
@if($href)
    <a {{ $attributes->merge(['class'=>"inline-flex items-center gap-2 rounded-md font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/50 $variant $size"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class'=>"inline-flex items-center gap-2 rounded-md font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/50 $variant $size"]) }}>
        {{ $slot }}
    </button>
@endif
