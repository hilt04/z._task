<x-layout titulo="Cadastrar novo Funcionário">
    <form method="post" action="{{ route('employees.store') }}" class="max-w-6xl mx-auto">
        @include('employees._form')
    </form>
</x-layout>


