<?php


namespace App\Http\Request;

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
            'name' => 'string|max:255',
            'telefone' => 'string',
            'email' => 'string|max:255',
            'data_de_nascimento' => 'date',
            'endereco' => 'string|max:255',
            'valor' => 'integer',
            'ddd' => 'ddd'
            
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
