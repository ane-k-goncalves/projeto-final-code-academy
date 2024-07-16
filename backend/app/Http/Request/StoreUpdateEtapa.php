<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEtapa extends FormRequest
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
            'funil_id' => 'required|integer|exists:funils,id',  // Apenas para criação
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['id'] = 'required|integer|exists:etapas,id';  // ID da etapa é obrigatório para atualização
            // Removido `position` e `funil_id` da validação
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        if ($this->route('idFunil')) {
            $this->merge(['funil_id' => $this->route('idFunil')]);
        }
    }
}
