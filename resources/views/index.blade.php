<x-layout titulo="z.task">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-1 items-stretch gap-2 md:grid-cols-3 md:flex-row">
            @auth
                @if(auth()->user()->userType->tipo === 'Administrador')
                    <a href="{{ route('clientes.index') }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 flex-1 h-24 bg-purple-500 text-white">
                        Clientes
                    </a>
                    <a href="{{ route('funcionarios.index') }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 flex-1 mx-2 md:mx-0 h-24 bg-green-500 text-white">
                        Funcionários
                    </a>
                    <a href="{{ route('projetos.index') }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 flex-1 h-24 bg-blue-500 text-white">
                        Projetos
                    </a>
                @elseif(auth()->user()->userType->tipo === 'Funcionario')
                    <a href="{{ route('projetos.index') }}" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 flex-1 h-24 bg-blue-500 text-white">
                        Projetos
                    </a>
                @endif
            @endauth
        </div>
    </div>
</x-layout>