<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepara os dados da request do funcionário para validação
     */
    protected function prepareForValidation()
    {
        $dados = $this->all();
        
        if (isset($dados['cpf'])) {
            $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf'] );
        }

        if (isset($dados['cep'])) {
            $dados['cep'] = str_replace(['.', '-'], '', $dados['cep'] );
        }
        
        $this->replace($dados);
    }

    /**
     * Valida os dados do funcionário
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:2', 'max:100', 'string'],
            'cpf' => ['required', 'size:11', 'string'],
            'data_contratacao' => ['required', 'date_format:d/m/Y'],
            'logradouro' => ['required', 'min:2', 'max:255', 'string'],
            'numero' => ['required', 'max:20', 'string'],
            'bairro' => ['required', 'max:50', 'string'],
            'cidade' => ['required', 'max:50', 'string'],
            'complemento' => ['nullable', 'max:50', 'string'],
            'cep' => ['required', 'size:8', 'string'],
            'estado' => ['required', 'size:2', 'string']
        ];
    }
}
