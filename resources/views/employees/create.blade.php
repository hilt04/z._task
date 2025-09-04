<x-layout titulo="Cadastrar novo Funcionário">
    <form method="post" action="{{ route('funcionarios.store') }}" class="max-w-6xl mx-auto">
        @include('funcionarios._form')
    </form>
</x-layout>


