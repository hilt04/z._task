@php
    $valorPadrao = old($nome, $valorPadrao ?? '');
@endphp

<div class="mb-5">
    <x-label for="{{ $nome }}" titulo="{{ $labelTitulo }}" />
    <select
        multiple
        id="{{ $nome }}"
        name="{{ $nome }}[]"
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-white-500 block w-full p-2.5 dark:bg-white-700 dark:border-black-600 dark:placeholder-white-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
    >
        @foreach ($lista as $item)
            <option
                value="{{ $item->$itemID }}"
                {{ in_array($item->$itemID, $valorPadrao) ? 'selected' : ''  }}
            >
                {{ $item->$itemDescricao }}
            </option>
        @endforeach
    </select>
</div>