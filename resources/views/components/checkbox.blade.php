@props([
    'label', 'name', 'value', 'id', 'required'
])
<div>
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="checkbox"
           name="{{ $name }}"
           value="{{ $value }}"
           id="{{ $value }}"
        {{ $required ?: '' }}>
</div>
