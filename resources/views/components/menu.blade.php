<!-- Botão para abrir a sidebar -->
<button id="openSidebar" class="fixed top-4 left-4 z-50 bg-gray-800 text-white p-2 rounded-lg shadow-lg focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<!-- Sidebar -->
<nav id="sidebarMenu" class="fixed top-0 left-0 h-full w-64 bg-gray-300 p-4 transform -translate-x-full transition-transform duration-300 z-40 flex flex-col justify-between">
    <div class="text-center">
        <a href="/" class="text-2xl font-semibold block mb-6">z.task</a>
        <ul class="font-medium space-y-2">
            @auth
                <li>
                    <a href="{{ route('index') }}" class="block px-4 py-2 rounded hover:bg-gray-400">Página Inicial</a>
                </li>
                @if(auth()->user()->userType->tipo === 'Administrador')
                    <li>
                        <a href="{{ route('clients.index') }}" class="block px-4 py-2 rounded hover:bg-gray-400">Clientes</a>
                    </li>
                    <li>
                        <a href="{{ route('employees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-400">Funcionários</a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('projetos.index') }}" class="block px-4 py-2 rounded hover:bg-gray-400">Projetos</a>
                </li>
                @if(auth()->user()->userType->tipo === 'Administrador')
                    <li>
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-400">Usuários</a>
                    </li>
                @endif
            @endauth
        </ul>
    </div>
    <div class="mb-4">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full">Sair</button>
            </form>
        @else
            <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded block text-center">Login</a>
        @endauth
    </div>
</nav>

<!-- Overlay para fechar a sidebar -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-40 z-30 hidden"></div>

<script>
    const sidebar = document.getElementById('sidebarMenu');
    const openBtn = document.getElementById('openSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    openBtn.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    // Bloqueio de links para Funcionário
    @auth
        @if(auth()->user()->userType->tipo === 'Funcionario')
            document.addEventListener('DOMContentLoaded', function() {
                const links = document.querySelectorAll('a[href*="clients"], a[href*="employees"]');
                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        alert('Acesso negado: Tipo de usuário não autorizado.');
                    });
                });
            });
        @endif
    @endauth
</script>