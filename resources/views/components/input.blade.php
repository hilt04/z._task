<div class="mb-5">
    <x-label for="{{ $nome }}" titulo="{{ $labelTitulo }}" />
    <input type="text" value="{{ old($nome, $valorPadrao ?? '') }}" id="{{ $nome }}" name="{{ $nome }}" class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light">
</div>