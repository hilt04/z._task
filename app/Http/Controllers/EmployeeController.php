<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\FuncionarioRequest;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Mostra a lista de funcionários
     */
    public function index(): View|Factory
    {
        $employees = Employee::paginate(15);

        return view('employees.index', compact('employees'));
    }

    /**
     * Mostra o formulário para criar um novo funcionário
     */
    public function create(): View|Factory
    {
        return view('employees.create');
    }

    /**
     * Cria um novo funcionário no banco
     */
    public function store(FuncionarioRequest $request): Redirector|RedirectResponse
    {
        $created = Employee::criar(
            $request->only(['nome', 'cpf', 'data_contratacao']),
            $request->only(['logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'cep', 'estado'])
        );

        if (!$created) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Erro ao criar novo funcionário');
        }

        return redirect()
            ->route('employees.index')
            ->with('mensagem', 'Funcionário criado com sucesso!');
    }

    /**
     * Mostra o formulário com os dados para edição
     */
    public function edit(Employee $employee): View|Factory
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Atualiza um funcionário especifico
     */
    public function update(FuncionarioRequest $request, Employee $employee): Redirector|RedirectResponse
    {
        $updated = $employee->atualizar(
            $request->only(['nome', 'cpf', 'data_contratacao']),
            $request->only(['logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'cep', 'estado'])
        );

        if (!$updated) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Erro ao atualizar o funcionário');
        }

        return redirect()
            ->route('employees.index')
            ->with('mensagem', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Deleta um funcionário especifico
     */
    public function destroy(Employee $employee): Redirector|RedirectResponse
    {
        $deleted = $employee->apagar();

        if (!$deleted) {
            return redirect()
                ->back()
                ->withErrors('Erro ao deletar o funcionário');
        }

        return redirect()
            ->route('employees.index')
            ->with('mensagem', 'Funcionário deletado com sucesso!');
    }

    /**
     * Demite um funcionário por ID
     */
    public function dismiss(Employee $employee): Redirector|RedirectResponse
    {
        if ($employee->data_demissao !== NULL) {
            return redirect()
                ->back()
                ->withErrors('Esse funcionário já estava demitido');
        }

        $employee->update([
            'data_demissao' => Carbon::now()
        ]);

        return redirect()
            ->route('employees.index')
            ->with('mensagem', 'Funcionário demitido com sucesso!');
    }
}
