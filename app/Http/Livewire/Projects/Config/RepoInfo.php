<?php

namespace App\Http\Livewire\Projects\Config;

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
        ];
    }

    public function render()
    {
        return view('livewire.projects.config.repo-info');
    }
}
