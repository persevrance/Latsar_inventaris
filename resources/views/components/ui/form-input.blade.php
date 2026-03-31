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

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'w-full border p-2 rounded']) }}>

    @error($name)
    <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>