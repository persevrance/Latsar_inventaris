@props([
'label' => null,
'name',
'type' => 'text',
'value' => '',
])

<div class="mb-4">
    @if($label)
    <label class="block text-sm mb-1">{{ $label }}</label>
    @endif

    @if($type === 'textarea')
    <textarea
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full border p-2 rounded']) }}>{{ old($name, $value) }}</textarea>
    @else
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'w-full border p-2 rounded']) }}>
    @endif

    @error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>