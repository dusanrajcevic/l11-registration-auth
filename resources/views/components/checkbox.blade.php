@props([
    'label', 'name', 'value', 'id', 'required'
])
<div class="text-left mt-3">
    <label for="{{ $id }}" class="inline-block align-middle">{{ $label }}</label>
    <input type="checkbox" name="{{ $name }}" {{ $required ? 'required' : '' }} value="{{ $value }}" id="{{ $id }}"

            class="inline-block align-middle w-[1em] h-[1em]"
    >
</div>
