<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class EditPage extends Component
{
    public Project $project;
    public $tab;
    public $availableTabs = [
        'basic-info' => 'Basic Info',
        'server-info' => 'Server Info',
        'repo-info' => 'Repository Info',
        'shared-directories' => 'Shared Directories',
        'environment-variables' => 'Environment Variables',
    ];

    protected $queryString = ['tab'];

    public function render()
    {
        return view('livewire.projects.edit-page')->with('configComponentName', $this->getComponentName());
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function getComponentName()
    {
        if(!in_array($this->tab, $availableTabs = array_keys($this->availableTabs))){
            $this->tab = $availableTabs[0];
        }

        return "projects.config.{$this->tab}";
    }
}
