@props(['action', 'method', 'confirm'])

@php
    $action = $action ?? '';
    $form_method = $method = strtoupper($method ?? 'GET');

    if($method != 'GET'){
        $form_method = 'POST';
    }
@endphp

<form 
    action="{{ $action }}"
    method="{{ $form_method }}"
    @isset($confirm) data-confirm="{{ $confirm }}" @endisset
    {{ $attributes }}
>
    @if ($form_method == 'POST')
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>