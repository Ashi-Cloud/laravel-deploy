<?php

namespace App\Http\Requests\Servers;

use Illuminate\Foundation\Http\FormRequest;

class ServerUpdateRequest extends FormRequest
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
            'host' => 'required|ip',
            'user' => 'required|max:191',
            'authentication_type' => 'required|max:191|in:password,private_key',
            'password' =>  $this->authentication_type == 'password' ? 'required|max:191' : 'nullable',
            'private_key' => $this->authentication_type == 'private_key' ?  'required' : 'nullable',
        ];
    }

    /**
     * Remove Carriage return from Private key
     */
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        if (is_array($data) && isset($data['private_key'])) {
            $data['private_key'] = str_replace("\r", "", $data['private_key']);
        }

        return $data;
    }
}
