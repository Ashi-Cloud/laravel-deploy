@extends('livewire.projects.config.base', ['heading' => 'Environment Variables'])

@section('form_fields')
    @if (is_null($env_variables))
        <div class="row align-items-center mb-3">
            <div class="col-12 text-center">
                @if ($project->deployments()->count())
                    This project does not have a .env file.
                @else
                    Please deploy first to edit env setting.
                @endif
            </div>
        </div>
    @else
        <x-input-field name="env_variables" title="" type="textarea" :rows='substr_count( $env_variables, "\n" ) ?: 10' cols="9" wire:model.defer="env_variables"/>
    @endif
@endsection