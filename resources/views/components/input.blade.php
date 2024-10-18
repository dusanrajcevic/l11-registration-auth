@props([
    'label', 'type', 'name', 'value' => '', 'id', 'required'
])
<div>
    <label for="{{ $id }}" class="text-[0.7em] text-bold mt-3 block">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" {{ $required ? 'required' : '' }} value="{{ $value }}" id="{{ $id }}"
           class="block w-full border-[1px] border-[#ff530e] border-solid rounded-lg px-1 py-1">
</div>
