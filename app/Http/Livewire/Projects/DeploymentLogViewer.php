<?php

namespace App\Http\Livewire\Projects;

use App\Models\Deployment;
use App\Models\Project;
use Livewire\Component;

class DeploymentLogViewer extends Component
{
    public Deployment $deployment;

    public $listeners = [
        'showDeploymentLog' => 'showDialog'
    ];

    public function render()
    {
        return view('livewire.projects.deployment-log-viewer');
    }


    public function showDialog(Deployment $deployment = null)
    {
        $this->deployment = $deployment;
    }
}
