<select {{ $attributes->merge(['class' => 'mt-1 w-full rounded-xl border-gray-300 bg-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500/30 transition']) }}>
    {{ $slot }}
</select>
