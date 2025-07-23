<x-layout titulo="Cadastrar novo Projeto">
    <form method="post" action="{{ route('projetos.store') }}" class="max-w-6xl mx-auto">
        @include('projetos._form')
    </form>
</x-layout>


