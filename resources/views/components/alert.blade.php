@php
    $types = [
        'info' => 'bg-blue-50 text-blue-800 border-blue-200',
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'warning' => 'bg-amber-50 text-amber-800 border-amber-200',
        'danger' => 'bg-rose-50 text-rose-800 border-rose-200',
    ];
    $type = $types[$attributes->get('type','info')];
@endphp
<div {{ $attributes->merge(['class'=>"rounded-md border p-3 $type"]) }}>
    {{ $slot }}
    @isset($actions)
        <div class="mt-2">{{ $actions }}</div>
    @endisset
</div>

