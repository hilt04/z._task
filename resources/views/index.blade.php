<x-layout titulo="z.task">
    <div class="flex flex-col items-center justify-center min-h-[60vh]">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 w-full max-w-6xl">
            @auth
                @if(auth()->user()->userType->tipo === 'Administrador')
                    <a href="{{ route('clients.index') }}" class="group block p-6 bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 mb-2 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 00-3-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="text-lg font-semibold">Clientes</h3>
                            <p class="text-3xl font-extrabold mt-1">{{ $counts['clients'] ?? 0 }}</p>
                        </div>
                    </a>
                    <a href="{{ route('employees.index') }}" class="group block p-6 bg-gradient-to-br from-green-500 to-green-700 text-white rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 mb-2 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 017 16h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h3 class="text-lg font-semibold">Funcionários</h3>
                            <p class="text-3xl font-extrabold mt-1">{{ $counts['employees'] ?? 0 }}</p>
                        </div>
                    </a>
                    <a href="{{ route('projetos.index') }}" class="group block p-6 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 mb-2 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
                            </svg>
                            <h3 class="text-lg font-semibold">Projetos</h3>
                            <p class="text-3xl font-extrabold mt-1">{{ $counts['projects'] ?? 0 }}</p>
                        </div>
                    </a>
                    <a href="{{ route('users.index') }}" class="group block p-6 bg-gradient-to-br from-red-500 to-red-700 text-white rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 mb-2 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14v7m-6-7v7m12-7v7" />
                            </svg>
                            <h3 class="text-lg font-semibold">Usuários</h3>
                            <p class="text-3xl font-extrabold mt-1">{{ $counts['users'] ?? 0 }}</p>
                        </div>
                    </a>
                    <div class="flex justify-center w-full mt-10">
                        <div class="w-full bg-white rounded-xl shadow p-8 flex flex-col items-center">
                            <h2 class="text-xl font-bold mb-4 text-center">Resumo de Quantidades</h2>
                            <canvas id="dashboardChart" width="1000" height="1000" class="mx-auto"></canvas>
                        </div>
                    </div>
                @endif
            @endauth
            @auth
                @if(auth()->user()->userType->tipo === 'employee' || auth()->user()->userType->tipo === 'Funcionário')
                    <a href="{{ route('projetos.index') }}" class="group block p-6 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 col-span-full">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 mb-2 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
                            </svg>
                            <h3 class="text-lg font-semibold">Projetos</h3>
                            <p class="text-3xl font-extrabold mt-1">{{ $counts['projects'] ?? 0 }}</p>
                        </div>
                    </a>
                @endif
            @endauth
        </div>
    </div>

    @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Clientes', 'Funcionários', 'Projetos', 'Usuários'],
            datasets: [{
                label: 'Quantidade',
                data: [
                    {{ $counts['clients'] ?? 0 }},
                    {{ $counts['employees'] ?? 0 }},
                    {{ $counts['projects'] ?? 0 }},
                    {{ $counts['users'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(139, 92, 246, 0.7)', // purple
                    'rgba(34, 197, 94, 0.7)',  // green
                    'rgba(59, 130, 246, 0.7)', // blue
                    'rgba(239, 68, 68, 0.7)'   // red
                ],
                borderColor: [
                    'rgba(139, 92, 246, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
</x-layout>