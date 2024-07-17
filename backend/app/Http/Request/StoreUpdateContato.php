<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class StoreUpdateContato extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to this request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'etapa_id' => 'required|integer|exists:etapa,id',
            'telefone' => 'required|string',
            'email' => 'required|string|max:255',
            'data_de_nascimento' => 'required|date',
            'endereco' => 'required|string|max:255',
            'valor' => 'required|integer'
        ];

        $this->validate(Requestuest $request, [
            'ddd' => 'required|ddd',
        ]);
        $this->validate($request, [
            'formato_cpf' => 'required|formato_cpf',
        ]); 
        $this->validate($request, [
            'cpf' => 'required|cpf',
        ]);

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['id'] = 'required|integer|exists:contato,id';  
           
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        if ($this->route('idEtapa')) {
            $this->merge(['Etapa_id' => $this->route('idEtapa')]);
        }
    }
}
