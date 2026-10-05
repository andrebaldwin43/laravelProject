@props([
    'name',
    'options' => [],
    'selected' => null,
    'label' => null,
    'placeholder' => 'Select an option'
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-base font-medium">
            {{ $label }}
        </label>
    @endif

    <select 
        id="{{ $name }}" 
        name="{{ $name }}" 
        {{ $attributes->merge(['class' => 'bg-amber-50 border border-gray-300 p-2 mb-5 rounded']) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ $value == old($name, $selected) ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
