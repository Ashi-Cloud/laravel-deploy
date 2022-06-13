<?php

namespace App\Http\Livewire\Projects\Config;

use Livewire\Component;

class EnvironmentVariables extends Component
{
    use Traits\HasProject;

    protected $success_message = 'Environment variables updated succesfully.';

    protected $rules = [
        'env_variables' => 'bail|nullable',
    ];

    public function render()
    {
        return view('livewire.projects.config.environment-variables');
    }
}
