@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 rounded-xl border border-green-100 text-start text-base font-semibold text-green-800 bg-green-50 shadow-sm'
            : 'block w-full ps-4 pe-4 py-3 rounded-xl border border-transparent text-start text-base font-medium text-gray-700 hover:text-green-800 hover:bg-green-50 hover:border-green-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
