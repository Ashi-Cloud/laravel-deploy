<?php

namespace App\Http\Livewire\Projects;

use App\Jobs\Deployment\DeployProjectJob;
use App\Models\Project;
use Livewire\Component;

class DeployProjectComponent extends Component
{
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.projects.deploy-project-component',[
            'activeDeployment' => $this->getActiveDeploymentAndUpdateDeploymentsTable()
        ]);
    }

    public function deploy()
    {
        if ( $this->project->getActiveDeployment() ){
            $this->emit('alert-warning', 'Already Deploying...');
            return;
        }

        if ( !$this->project->isDeployable() ){
            $this->emit('alert-warning', 'All project information is not provided...');
            return;
        }
        
        $this->project->createNewDeployment();
        
        dispatch( new DeployProjectJob($this->project) );
    }


    private function getActiveDeploymentAndUpdateDeploymentsTable()
    {
        $activeDeployment = $this->project->getActiveDeployment();

        if ( !$activeDeployment ){
            return null;
        }
        
        return $activeDeployment;
    }
}
