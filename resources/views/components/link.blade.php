@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'hover:text-slate-500 transition-colors duration-300']) }}>
    {{ $slot }}
</a>