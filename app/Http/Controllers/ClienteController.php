<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;

class ClienteController extends Controller
{
    /**
     * Lista os clientes do banco de dados
     * 
     * @return View|Factory 
     */
    public function index()
    {
        $clientes = Client::paginate(15);
        $clientes->load('projects');

        return view('clientes.index', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Mostra o formulário de cadastro de clientes
     * 
     * @return View|Factory 
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Grava o cliente no banco de dados
     * 
     * @return Redirector|RedirectResponse
     */
    public function store(ClienteRequest $request)
    {
        Client::create($request->all());

        return redirect()
            ->route('clientes.index')
            ->with('mensagem', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Mostra o formulário preenchido para edição
     * 
     * @return View|Factory 
     */
    public function edit(Client $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza um cliente no banco de dados
     * 
     * @return Redirector|RedirectResponse
     */
    public function update(ClienteRequest $request, Client $cliente)
    {
        $cliente->update($request->all());

        return redirect()
            ->route('clientes.index')
            ->with('mensagem', 'Cliente atualizado com sucesso!');
    }

    /**
     * Apaga um cliente do banco de dados
     * 
     * @return Redirector|RedirectResponse
     */
    public function destroy(Client $cliente)
    {
        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('mensagem', 'Cliente deletado com sucesso!');
    }
}
