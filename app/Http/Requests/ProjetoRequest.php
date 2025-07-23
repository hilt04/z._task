<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepara os dados da request do projeto para validação
     */
    protected function prepareForValidation()
    {
        $dados = $this->all();
        
        if (isset($dados['orcamento'])) {
            $dados['orcamento'] = str_replace(['.', ','], ['', '.'], $dados['orcamento']);
        }
        
        $this->replace($dados);
    }

    /**
     * Valida os dados do projeto
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:2', 'max:100'],
            'orcamento' => ['required', 'numeric', 'min:1'],
            'data_inicio' => ['required', 'date'],
            'data_final' => ['required', 'date'],
            'client_id' => ['required', 'exists:clients,id']
        ];
    }
}
