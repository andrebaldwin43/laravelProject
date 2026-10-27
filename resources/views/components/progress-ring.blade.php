@props([
    'id',
    'title',
    'subtitle' => null,
    'value' => 0,      // current number shown in the center
    'max' => 1,        // used to compute ring fill
    'label' => '',
    'color' => '#0B72FF',
])

@php
    $radius = 62;
    $circumference = 2 * pi() * $radius;
    $v = (float) $value;
    $m = (float) $max;
    $percent = $m > 0 ? min(max($v / $m, 0), 1) : 0;
    $offset = $circumference * (1 - $percent);
@endphp

<div id="{{ $id }}"
     class="bg-white rounded-xl p-2 shadow-sm"
     data-circumference="{{ $circumference }}"
     data-max="{{ $max }}">
    <h2 class="text-lg font-bold leading-none">{{ $title }}</h2>
    @if ($subtitle)
        <p class="text-gray-500 text-sm mt-1 mb-4">{{ $subtitle }}</p>
    @endif

    <div class="relative w-45 h-25 mx-auto">
        <svg class="w-full h-full -rotate-90" viewBox="0 0 160 160">
            <circle cx="80" cy="80" r="{{ $radius }}" fill="none" stroke="#EEF1F6" stroke-width="12" />
            <circle data-ring
                    cx="80" cy="80" r="{{ $radius }}"
                    fill="none" stroke="{{ $color }}" stroke-width="12" stroke-linecap="round"
                    stroke-dasharray="{{ $circumference }}"
                    stroke-dashoffset="{{ $offset }}"
                    data-target-offset="{{ $offset }}"
                    style="transition: stroke-dashoffset 0.8s ease-out;" />
        </svg>

        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <div data-value class="text-lg font-bold leading-none">{{ number_format($value) }}</div>
            <div class="text-xs">{{ $label }}</div>
        </div>
    </div>
</div>