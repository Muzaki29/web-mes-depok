<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto overscroll-x-contain">
        <table {{ $attributes->merge(['class'=>'min-w-[640px] sm:min-w-full divide-y divide-gray-200 text-sm']) }}>
            <thead class="sticky top-0 z-10 bg-gray-50">
                {{ $head }}
            </thead>
            <tbody class="divide-y divide-gray-200">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
