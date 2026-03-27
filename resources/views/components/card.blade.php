<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-100']) }}>
    @if(isset($header))
        <div class="px-4 py-4 sm:px-6 border-b border-gray-100">
            {{ $header }}
        </div>
    @endif
    <div class="{{ $attributes->get('no-padding') ? '' : 'p-4 sm:p-6' }}">
        {{ $slot }}
    </div>
</div>
