@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold text-green-800 bg-green-50 shadow-sm border border-green-100'
            : 'inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-green-800 hover:bg-green-50 hover:border hover:border-green-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
