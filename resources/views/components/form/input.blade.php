@props(['name', 'label', 'type' => 'text', 'value' => ''])

<label for="{{ $name }}" class="block text-base font-medium">{{ $label }}</label>
<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $name }}" 
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'bg-amber-50 border border-gray-300 p-2 mb-5 rounded']) }}
>
