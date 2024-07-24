<?php


namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class StoreCreateContato extends FormRequest
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
            'telefone' => 'required|string',
            'email' => 'required|string|max:255',
            'data_de_nascimento' => 'required|date',
            'endereco' => 'required|string|max:255',
            'valor' => 'required|integer',
            'ddd' => 'required|ddd',
            'formato_cpf' => 'formato_cpf',
            'cpf' => 'required|cpf'
        ];



        return $rules;
    }

    protected function prepareForValidation()
    {
        if ($this->route('idEtapa')) {

            $this->merge(['etapa_id' => $this->route('idEtapa')]);

        }
    }
}
