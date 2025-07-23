<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\FuncionarioRequest;

class FuncionarioController extends Controller
{
    /**
     * Mostra a lista de funcionários
     */
    public function index(): View|Factory
    {
        $funcionarios = Employee::paginate(15);

        return view('funcionarios.index', compact('funcionarios'));
    }

    /**
     * Mostra o formulário para criar um novo funcionário
     */
    public function create(): View|Factory
    {
        return view('funcionarios.create');
    }

    /**
     * Cria um novo funcionário no banco
     */
    public function store(FuncionarioRequest $request): Redirector|RedirectResponse
    {
        $estaCriado = Employee::criar(
            $request->only(['nome', 'cpf', 'data_contratacao']),
            $request->only(['logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'cep', 'estado'])
        );

        if (!$estaCriado) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Erro ao criar novo funcionário');
        }

        return redirect()
                ->route('funcionarios.index')
                ->with('mensagem', 'Funcionário criado com sucesso!');
    }

    /**
     * Mostra o formulário com os dados para edição
     */
    public function edit(Employee $funcionario): View|Factory
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    /**
     * Atualiza um funcionário especifico
     */
    public function update(FuncionarioRequest $request, Employee $funcionario): Redirector|RedirectResponse
    {
        $estaAtualizado = $funcionario->atualizar(
            $request->only(['nome', 'cpf', 'data_contratacao']),
            $request->only(['logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'cep', 'estado'])
        );

        if (!$estaAtualizado) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Erro ao atualizar o funcionário');
        }

        return redirect()
            ->route('funcionarios.index')
            ->with('mensagem', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Deleta um funcionário especifico
     */
    public function destroy(Employee $funcionario): Redirector|RedirectResponse
    {
        $estaApagado = $funcionario->apagar();

        if (!$estaApagado) {
            return redirect()
                    ->back()
                    ->withErrors('Erro ao deletar o funcionário');
        }

        return redirect()
            ->route('funcionarios.index')
            ->with('mensagem', 'Funcionário deletado com sucesso!');
    }
}
