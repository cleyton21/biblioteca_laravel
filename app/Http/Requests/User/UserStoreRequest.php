<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => (!empty($this->request->all()['id']) ? 'bail|required|string|unique:users,name,'.$this->request->all()['id'] : 'bail|required|string|unique:users,name'),
            'email' => (!empty($this->request->all()['id']) ? 'bail|required|email|unique:users,email,'.$this->request->all()['id'] : 'bail|required|string|unique:users,email'),
        ];
    }

    public function messages()
    {
        return [
            'string' => 'O nome precisa ser uma string',
            'required' => 'Este campo é obrigatório',
            'email' => 'Digite um formato de e-mail válido',
            'name.unique' => 'Este nome já está cadastrado em nosso sistema. Tente outro...',
            'email.unique' => 'Este e-mail já está cadastrado em nosso sistema. Tente outro...'
        ];
    }
}
