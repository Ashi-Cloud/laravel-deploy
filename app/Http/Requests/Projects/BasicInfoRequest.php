<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class BasicInfoRequest extends FormRequest
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

        $rules = [
            'name' => 'bail|required|max:191',
        ];

        if(!empty($this->project)){
            $rules = array_merge($rules, [
                'server_id' => 'bail|required|exists:servers,id',
                'git_repository' => 'bail|required|max:191',
                'git_branch' => 'bail|required|max:191',
                'server_path' => 'bail|required|max:191',
            ]);
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {   
        $data = [
            'server_id' => $this->get('server'),
        ];
        
        $this->merge($data);
        request()->merge($this->all());
    }
}
