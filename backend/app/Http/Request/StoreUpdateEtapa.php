<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'position' => [
                'required',
                'integer',
                Rule::unique('etapas')->where(function ($query) {
                    return $query->where('funil_id', $this->funil_id);
                })
            ],
            'funil_id' => 'required|integer|exists:funils,id',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['id'] = 'required|integer|exists:etapas,id';
            $rules['position'] = [
                'required',
                'integer',
                Rule::unique('etapas')->where(function ($query) {
                    return $query->where('funil_id', $this->funil_id)->where('id', '!=', $this->id);
                })
            ];
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
