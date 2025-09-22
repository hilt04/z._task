<x-layout titulo="Lista de Projetos">
    <div class="flex justify-end my-3">
        <a
            class="bg-green-500 border rounded-md p-1 px-3 text-white hover:bg-green-600"
            href="{{ route('projetos.create') }}"
        >Criar Projeto</a>
    </div>

    <!-- Mensagem de sucesso -->
    @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('sucesso') }}</span>
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Orçamento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data Início
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data Final
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cliente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($projetos as $projeto)
                    {{-- Adiciona classes de estilo se o projeto estiver concluído --}}
                    <tr class="@if($projeto->concluido) bg-gray-200 dark:bg-gray-900 opacity-60 @else bg-white dark:bg-gray-800 @endif border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('projetos.show', $projeto) }}" class="hover:underline">
                                {{ $projeto->nome }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $projeto->orcamento }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $projeto->data_inicio }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $projeto->data_final }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $projeto->client->nome }}
                        </td>
                        <td class="px-6 py-4 flex items-center space-x-2">
                            {{-- Mostra os botões apenas se o projeto NÃO estiver concluído --}}
                            @if(!$projeto->concluido)
                                <a  href="{{ route('projetos.edit', $projeto->id) }}"
                                    class="bg-blue-500 border rounded-md p-1 px-3 text-white hover:bg-blue-600"
                                >Editar</a>

                                <!-- Botão Concluir -->
                                <form method="POST" action="{{ route('projetos.concluir', $projeto->id) }}" class="inline-block">
                                    @method('PATCH')
                                    @csrf
                                    <button
                                        type="submit"
                                        class="bg-green-400 border rounded-md p-1 px-3 text-white hover:bg-green-600"
                                    >Concluir</button>
                                </form>

                                <form method="POST" action="{{ route('projetos.destroy', $projeto->id) }}" class="inline-block">
                                    @method('delete')
                                    @csrf
                                    <button
                                        class="bg-red-500 border rounded-md p-1 px-3 text-white hover:bg-red-600"
                                        onclick="return confirm('Deseja realmente apagar esse projeto?')"
                                    >Excluir</button>
                                </form>
                            @else
                                <span class="text-gray-500 italic">Concluído</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="6" class="px-6 py-4 text-center">Nenhum Projeto Cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="my-4 p-4">
            {{ $projetos->links() }}
        </div>
    </div>
</x-layout>