<x-layout titulo="Editar Cliente">
    <form method="post" action="{{ route('clientes.update', $cliente->id) }}" class="max-w-6xl mx-auto">
        @method('put')
        @include('clientes._form')
    </form>
</x-layout>


