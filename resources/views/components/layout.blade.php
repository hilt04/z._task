<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="flex">
        <x-menu />

        <div class="flex-1 p-4">
            <h1 class="text-4xl font-bold text-center my-4">
                {{ $titulo }}
            </h1>

            @if ($errors->any())
                <div class="flex justify-between items-center p-2 bg-red-500 text-white border-2 border-red-500 rounded-sm mb-4">
                    <span class="text-xs">Erros de validação</span>
                    <ul class="flex flex-col mt-1">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-center">{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            @if (session('mensagem'))
                <div class="text-xl p-2 bg-green-500 text-white border-2 border-green-500 rounded-sm text-center mb-4">
                    {{ session('mensagem') }}
                </div>
            @endif

            {{ $slot }}
        </div>

        @stack('scripts')
    </body>
</html>
