<x-layout titulo="Lista de Clientes">
    <div class="flex justify-end my-3">
        <a
            class="bg-green-500 border rounded-md p-1 px-3 text-white"
            href="{{ route('clients.create') }}"
        >Criar cliente</a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Endereço
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Projetos
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-white-900 whitespace-nowrap dark:text-white">
                            {{ $client->nome }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $client->endereco }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $client->descricao }}
                        </td>
                        <td class="px-6 py-4">
                            @forelse ($client->projects as $projeto)
                                @if ($loop->last) 
                                    {{ $projeto->nome }}
                                @else
                                    {{ $projeto->nome }}{{ ', ' }}
                                @endif    
                            @empty
                                Nenhum projeto
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                            <a
                                href="{{ route('clients.edit', $cliente->id) }}"
                                class="bg-blue-500 border rounded-md p-1 px-3 text-white"
                            >Editar</a>

                            <form method="POST" action="{{ route('clients.destroy', $client->id) }}" class="inline-block">
                                @method('delete')
                                @csrf

                                <button
                                    class="bg-red-500 border rounded-md p-1 px-3 text-white"
                                    onclick="return confirm('Deseja realmente apagar esse cliente?')"
                                >Excluir</button>

                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Nenhum Cliente Cadastrado</th>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="my-4">
            {{ $clients->links() }}
        </div>
    </div>
</x-layout>
