<nav class="bg-gray-300">
    <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between p-4">
        <a href="/" class="text-2xl font-semibold">z.task</a>
    
        <ul class="font-medium flex">
            @auth
                @if(auth()->user()->userType->tipo === 'Administrador')
                    <li class="px-4">
                        <a href="{{ route('clientes.index') }}">Cliente</a>
                    </li>
                    <li class="px-4">
                        <a href="{{ route('funcionarios.index') }}">Funcionários</a>
                    </li>
                @endif
                <li class="px-4">
                    <a href="{{ route('projetos.index') }}">Projetos</a>
                </li>
            @endauth
        </ul>
        @auth
            @if(auth()->user()->userType->tipo === 'Funcionário')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const links = document.querySelectorAll('a[href*="clientes"], a[href*="Funcionarios"]');
                        links.forEach(link => {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();
                                alert('Acesso negado: Tipo de usuário não autorizado.');
                            });
                        });
                    });
                </script>
            @endif
        @endauth
        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Sair</button>
                </form>
            @else
                <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Login</a>
            @endauth
    </div>
</nav>