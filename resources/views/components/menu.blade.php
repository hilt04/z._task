<nav class="bg-gray-300">
    <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between p-4">
        <a href="/" class="text-2xl font-semibold">z.task</a>
    
        <ul class="font-medium flex">
            <li class="px-4">
                <a href="{{ route('clientes.index') }}">Cliente</a>
            </li>
            <li class="px-4">
                <a href="{{ route('funcionarios.index') }}">Funcionários</a>
            </li>
            <li class="px-4">
                <a href="{{ route('projetos.index') }}">Projetos</a>
            </li>
        </ul>
        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sair</button>
                </form>
            @else
                <a href="{{ route('index') }}" class="btn btn-primary">Login</a>
            @endauth
    </div>
</nav>