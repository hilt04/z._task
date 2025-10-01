<x-layout titulo="Cadastrar novo Cliente">
    <form method="post" action="{{ route('clients.store') }}" class="max-w-6xl mx-auto">
        @include('clients._form')
    </form>
</x-layout>


