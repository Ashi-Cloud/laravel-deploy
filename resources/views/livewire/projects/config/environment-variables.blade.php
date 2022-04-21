@extends('livewire.projects.config.base', ['heading' => 'Environment Variables'])

@section('form_fields')
    <x-input-field name="env_variables" title="" type="textarea" rows="10" wire:model.defer="env_variables"/>
@endsection