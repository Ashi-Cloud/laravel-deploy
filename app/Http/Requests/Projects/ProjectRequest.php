<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->server_form){
            return [
                'server_id' => 'bail|required|exists:servers,id',
                'server_path' => 'bail|required|max:191',
            ];
        }else if($this->repo_form){
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
        
        return [
            'name' => 'bail|required|max:191',
            'description' => 'bail|nullable|max:191',
        ];
    }

    public function attributes()
    {
        return [
            'server_id' => 'server'
        ];
    }
}
