<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ProjetoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;

class ProjetoController extends Controller
{
    /**
     * Mostra a lista de projetos
     */
    public function index(): View|Factory
    {
        $projetos = Project::with('client')->paginate(15);

        return view('projetos.index', compact('projetos'));
    }

    /**
     * Mostra o formulário para criar um novo projeto
     */
    public function create(): View|Factory
    {
        $clientes = Client::all();
        $funcionarios = Employee::ativo()->get();

        return view('projetos.create', compact('clientes', 'funcionarios'));
    }

    /**
     * Cria um novo projeto no banco
     */
    public function store(ProjetoRequest $request): Redirector|RedirectResponse
    {
        $estaCriado = Project::criarComFuncionarios(
            $request->except('funcionarios'),
            $request->funcionarios
        );

        if (!$estaCriado) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Erro ao criar novo projeto');
        }

        return redirect()
                ->route('projetos.index')
                ->with('mensagem', 'Projeto criado com sucesso!');
    }

    /**
     * Mostra os detalhes de um projeto
     */
    public function show(Project $projeto): View|Factory
    {
        return view('projetos.show', compact('projeto'));
    }

    /**
     * Mostra o formulário com os dados para edição
     */
    public function edit(Project $projeto): View|Factory
    {
        $clientes = Client::all();
        $funcionarios = Employee::ativo()->get();

        return view('projetos.edit', compact('projeto', 'clientes', 'funcionarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjetoRequest $request, Project $projeto): Redirector|RedirectResponse
    {
        $estaAtualizado = $projeto->atualizarComFuncionarios(
            $request->except('funcionarios'),
            $request->funcionarios
        );

        if (!$estaAtualizado) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Erro ao atualizar projeto');
        }

        return redirect()
                ->route('projetos.index')
                ->with('mensagem', 'Projeto atualizado com sucesso!');
    }

    /**
     * Deleta um projeto especifico
     */
    public function destroy(Project $projeto): Redirector|RedirectResponse
    {
        $projeto->delete();

        return redirect()
                ->route('projetos.index')
                ->with('mensagem', 'Projeto apagado com sucesso!');
    }
}
