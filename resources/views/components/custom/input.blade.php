@props([
    'label' => $label,
    'name' => $name,
    'value',
    'type' => 'text'
])  
<div class="mb-3">
    <label class="label-text" for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" placeholder="Masukkan {{ $label }}" class="input text-[13px] focus:border-0 focus:outline-0" id="{{ $name }}" name="{{ $name }}" value="{{ $value ?? old($name) }}" />
    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
