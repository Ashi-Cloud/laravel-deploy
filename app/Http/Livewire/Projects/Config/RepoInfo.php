<?php

namespace App\Http\Livewire\Projects\Config;

use App\Models\Server;
use Livewire\Component;

class RepoInfo extends Component
{
    use Traits\HasProject;

    protected $success_message = 'Repository info Updated Succesfully';

    protected function rules()
    {
        return [
            'git_repository' => 'bail|required|max:191',
            'git_branch' => 'bail|required|max:191',
            'git_generate_key' => [
                'bail',
                'nullable',
                function($attribute, $value, $fail){
                    if(empty($this->project->server_id)){
                        $fail('Please choose a server first to generate a key.');
                    }
                }
            ],
            'git_remove_key' => 'bail|nullable',
        ];
    }

    public function render()
    {
        return view('livewire.projects.config.repo-info');
    }

    protected function updatedGitRemoveKey($value)
    {
        if($value){
            $this->git_generate_key = false;
        }
    }

    protected function updatedGitGenerateKey($value)
    {
        if($value){
            $this->git_remove_key = false;
        }
    }

    protected function initData()
    {
        $this->servers = Server::query()->get(['id', 'name']);
    }

    protected function beforeFill($data)
    {
        if($data['git_generate_key'] ?? false){
            $this->project->generateSshKeys();
            $this->git_generate_key = false;
        }
        
        if($data['git_remove_key'] ?? false){
            $this->project->removeSshKeys();
            $this->git_remove_key = false;
        }
    }
}
