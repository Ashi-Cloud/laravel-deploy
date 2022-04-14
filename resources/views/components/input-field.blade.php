@props(['id', 'name', 'title', 'description', 'type', 'options', 'placeholder', 'value'])

@php
    $name = $name ?? 'field';
    $id = $id ?? $name;
    $title = $title ?? Str::of($name)->replace(['-','_'], ' ')->title();
    $type = $type ?? 'text';

    $options = $options ?? [];
    $option_key = $options['key'] ?? 'id';
    $option_text = $options['text'] ?? 'name';
    $select_options = $options['items'] ?? [];
@endphp

<div class="row align-items-center mb-3">
    <div class="col-md-3 text-md-end">
        <label for="{{ $id }}">{{ $title }}</label>
    </div>

    <div class="col-md-6">
        @if ($type == 'select')
            <select name="{{ $name }}" id="{{ $id }}" class="form-control">
                <option value="">{{ $placeholder ?? $title }}</option>
                
                @foreach ($select_options as $select_options)
                    @php($select_options = is_object($select_options) ? $select_options : (object)$select_options)

                    <option
                        value="{{ $value = $select_options->{$option_key} }}"
                        @selected($value == old($name, $value ?? null))
                    >
                        {{ $select_options->{$option_text} }}
                    </option>
                @endforeach
            </select>
        @else
            <input :type="$type" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value ?? null) }}" class="form-control" aria-describedby="field_info_{{ $name }}">
        @endif
        
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