@props(['action', 'method'])

@php
    $action = $action ?? '';
    $form_method = $method = strtoupper($method ?? 'GET');

    if($method != 'GET'){
        $form_method = 'POST';
    }
@endphp

<form action="{{ $action }}" method="{{ $form_method }}">
    @if ($form_method == 'POST')
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>