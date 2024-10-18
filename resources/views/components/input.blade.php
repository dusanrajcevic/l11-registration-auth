@props([
    'label', 'type', 'name', 'value' => '', 'id', 'required'
])
<div>
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ $value }}"
           id="{{ $id }}"
        {{ $required ?: '' }}>
</div>
