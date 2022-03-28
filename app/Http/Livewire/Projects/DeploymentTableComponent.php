<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class DeploymentTableComponent extends Component
{

    public Project $project;

    protected $listeners = [
        'deployment-updated' => 'render'
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projects.deployment-table-component',[
            'deployments' => $this->getDeployments()
        ]);
    }

    public function getDeployments()
    {
        return $this->project->deployments()->latest()->paginate(10);
    }
}
