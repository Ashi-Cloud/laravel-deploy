@extends('livewire.projects.config.base', ['heading' => 'Repository Info'])

@section('form_fields')
    <x-input-field name="git_repository" title="Repository" wire:model.defer="git_repository"/>
    <x-input-field name="git_branch" title="branch" wire:model.defer="git_branch"/>

    @if (!empty($git_public_key = $project->git_public_key ?? null))
        @if (!($git_remove_key || $git_generate_key))
            <x-input-field name="git_public_key" type="textarea" rows="14" title="Public Key" :value="$git_public_key" readonly />
        @endif

        <x-input-field name="git_remove_key" type="checkbox" title="Remove key pair" description="Remove key if repository is public." value="1" wire:model="git_remove_key"/>
    @endif

    <x-input-field name="git_generate_key" type="checkbox" title="Generate new key pair" value="1" wire:model="git_generate_key"/>
@endsection