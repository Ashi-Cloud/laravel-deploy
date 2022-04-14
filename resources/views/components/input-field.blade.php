@props(['id', 'name', 'title', 'description', 'value'])

@php
    $name = $name ?? 'field';
    $id = $id ?? $name;
    $title = $title ?? Str::title($name);
@endphp

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="{{ $id }}">{{ $title }}</label>
    </div>

    <div class="col-md-6">
        <input type="text" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value ?? null) }}" class="form-control" aria-describedby="field_info_{{ $name }}">
        
        @isset($description)
            <div id="field_info_{{ $name }}" class="form-text">{{ $description }}</div>
        @endisset
        
        @error($name)
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>