<x-layout titulo="Editar Funcionário">
    <form method="post" action="{{ route('funcionarios.update', $funcionario) }}" class="max-w-6xl mx-auto">
        @method('put')
        @include('funcionarios._form')
    </form>
</x-layout>


