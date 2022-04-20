<?php

namespace App\Http\Livewire\Projects\Config;

use Livewire\Component;

class ServerInfo extends Component
{
    use Traits\HasProject;

    protected $success_message = 'Server info updated succesfully.';

    public $servers = [];

    protected $validationAttributes = [
        'server_id' => 'server'
    ];

    protected $rules = [
        'server_id' => 'bail|required|exists:servers,id',
        'server_path' => 'bail|required|max:191',
    ];
    
    public function render()
    {
        return view('livewire.projects.config.server-info');
    }
}
