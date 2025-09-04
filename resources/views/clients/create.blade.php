<x-layout titulo="Cadastrar novo Cliente">
    <form method="post" action="{{ route('clientes.store') }}" class="max-w-6xl mx-auto">
        @include('clientes._form')
    </form>
</x-layout>


