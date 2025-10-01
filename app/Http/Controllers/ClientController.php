<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;

class ClientController extends Controller
{
    /**
     * Lista os clientes do banco de dados
     *
     * @return View|Factory
     */
    public function index()
    {
        $clients = Client::paginate(15);
        $clients->load('projects');

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Mostra o formulário de cadastro de clientes
     *
     * @return View|Factory
     */
    public function create()
    {
        return view('clients.create');
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
            ->route('clients.index')
            ->with('mensagem', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Mostra o formulário preenchido para edição
     *
     * @return View|Factory
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Atualiza um cliente no banco de dados
     *
     * @return Redirector|RedirectResponse
     */
    public function update(ClienteRequest $request, Client $client)
    {
        $client->update($request->all());

        return redirect()
            ->route('clients.index')
            ->with('mensagem', 'Cliente atualizado com sucesso!');
    }

    /**
     * Apaga um cliente do banco de dados
     *
     * @return Redirector|RedirectResponse
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('mensagem', 'Cliente deletado com sucesso!');
    }
}
