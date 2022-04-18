<?php

namespace App\Http\Livewire\Projects\Config;

use Livewire\Component;

class BasicInfo extends Component
{
    use Traits\HasProject;

    protected $success_message = 'Basic info Updated Succesfully';

    protected $rules = [
        'name' => 'bail|required|max:191',
        'description' => 'bail|nullable|max:191',
    ];

    public function render()
    {
        return view('livewire.projects.config.basic-info');
    }
}
