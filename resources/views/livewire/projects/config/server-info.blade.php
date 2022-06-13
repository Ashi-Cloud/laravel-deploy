@extends('livewire.projects.config.base', ['heading' => 'Server Info'])

@section('form_fields')
    <x-input-field name="server_id" title="Server" type="select" :options="['items' => $servers]" wire:model.defer="server_id"/>
    <x-input-field name="server_path" wire:model.defer="server_path"/>
@endsection