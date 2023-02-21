<?php

namespace App\Http\Requests\Livro;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LivroStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'isbn' => (!empty($this->request->all()['id']) ? 'bail|required|integer|unique:livros,isbn,'.$this->request->all()['id'] : 'bail|required|integer|unique:livros,isbn'),
            'titulo' => 'bail|required|string',
            'subtitulo' => 'bail|required|string',
            'descricao' => 'bail|required|string',
            'quantidade' => 'bail|required|integer',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório',
            'integer' => 'Este campo deve conter apenas números',
            'isbn.unique' => 'Este ISBN já existe, tente outro',            
            'titulo.unique' => 'Este título já existe, tente outro',            
        ];
    }
}
