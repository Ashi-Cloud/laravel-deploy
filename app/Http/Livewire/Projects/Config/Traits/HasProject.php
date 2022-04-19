<?php

namespace App\Http\Livewire\Projects\Config\Traits;

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

        if(method_exists($this, 'initData')){
            $this->initData();
        }
    }

    public function save()
    {
        $data = $this->validate();

        if(method_exists($this, 'beforeFill')){
            $this->beforeFill($data);
        }

        $this->project->fill($data);
        $this->project->save();

        if($this->project->wasRecentlyCreated){
            return to_route('projects.edit', $this->project->id)->with('alert-success', 'Project Created Succesfully');
        }

        $this->emitTo('flash-message', 'message', ['type' => 'success', 'message' => $this->success_message ?? 'Project info Updated Succesfully']);
    }
}
