<?php

namespace App\Http\Livewire\Projects\Config;

use Livewire\Component;

class SharedDirectories extends Component
{
    use Traits\HasProject;

    protected $success_message = 'Shared files and directories updated Succesfully';

    protected $rules = [
        'shared_directories' => 'bail|nullable',
        'shared_files' => 'bail|nullable',
    ];

    public function render()
    {
        return view('livewire.projects.config.shared-directories');
    }
}
