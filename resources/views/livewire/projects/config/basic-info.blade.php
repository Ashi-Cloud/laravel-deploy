@extends('livewire.projects.config.base', ['heading' => 'Basic Info'])

@section('form_fields')
    <x-input-field name="name" description="The project directory name." wire:model.defer="name"/>
    <x-input-field name="description" wire:model.defer="description"/>
@endsection