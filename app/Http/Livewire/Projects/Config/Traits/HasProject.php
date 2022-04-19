<?php

namespace App\Http\Livewire\Projects\Config\Traits;

use App\Models\Server;
use App\Models\Project;

trait HasProject
{
    public Project $project;

    public function mount(Project $project = null)
    {
        $this->project = $project;

        foreach(array_keys($this->getRules()) as $key){
            $this->{$key} = $project->{$key};
        }

        if(property_exists($this, 'servers')){
            $this->servers = Server::query()->get(['id', 'name']);
        }
    }

    public function save()
    {
        $data = $this->validate();

        if($data['git_generate_key'] ?? false){
            $this->project->generateSshKey();
            $this->git_generate_key = false;
        }
        
        if($data['git_remove_key'] ?? false){
            $this->project->removeSshKey();
            $this->git_remove_key = false;
        }
    
        $this->project->fill($data);
        $this->project->save();

        if($this->project->wasRecentlyCreated){
            return to_route('projects.edit', $this->project->id)->with('alert-success', 'Project Created Succesfully');
        }

        $this->emitTo('flash-message', 'message', ['type' => 'success', 'message' => $this->success_message ?? 'Project info Updated Succesfully']);
    }
}
