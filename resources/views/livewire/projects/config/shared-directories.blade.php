@extends('livewire.projects.config.base', ['heading' => 'Shared files and directories'])

@section('form_fields')
    <x-input-field name="shared_files" type="textarea" rows="10" wire:model.defer="shared_files"/>
    <x-input-field name="shared_directories" type="textarea" rows="10" wire:model.defer="shared_directories"/>
@endsection