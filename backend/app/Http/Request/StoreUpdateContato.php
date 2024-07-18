<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class StoreUpdateContato extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }
 
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
            'formato_cpf' => 'required|formato_cpf',
            'cpf' => 'cpf'
        ];

     
        

       

        return $rules;
    }

   
}
