<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
        return [
            'name' => 'required|max:191',
            'server' => 'required|exists:servers,id',
            'git_repository' => 'required|max:191',
            'git_branch' => 'required|max:191',
            'server_path' => 'required|max:191',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if (is_array($data) && isset($data['server'])) {
            $data['server_id'] = $data['server'];
            unset($data['server']);
        }

        return $data;
    }
}
