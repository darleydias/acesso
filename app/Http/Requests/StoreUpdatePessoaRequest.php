<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nomeCompleto'=>['required'],
            'sexo'=>['string','max:1']
            // 'dtNasc'=>['date_format:Y-m-d'],
            // 'CPF'=>['numeric'],
            // 'email'=>['email'],
            // 'id_setor'=>['numeric'],
            // 'visitante'=>['numeric']
        ];
    }
}
