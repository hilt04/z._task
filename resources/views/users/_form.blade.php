<form
    method="POST"
    action="{{ isset($usuario) ? route('users.update', $usuario) : route('users.store') }}"
    class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    @csrf
    @if(isset($usuario))
        @method('PUT')
    @endif

    <x-label for="nome" titulo="Nome do Usuário" />
    <input
        type="text"
        id="nome"
        name="name"
        value="{{ old('name', $usuario->name ?? '') }}"
        required
        class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 mb-5 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
        placeholder="Digite o nome"
    >

    <x-label for="email" titulo="E-mail" />
    <input
        type="email"
        id="email"
        name="email"
        value="{{ old('email', $usuario->email ?? '') }}"
        required
        class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 mb-5 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
        placeholder="Digite o e-mail"
    >

    <x-label for="senha" titulo="Senha" />
    <input
        type="password"
        id="senha"
        name="password"
        value="{{ old('password') }}"
        @if(!isset($usuario)) required @endif
        class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 mb-5 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
        placeholder="Digite a senha"
    >

    <x-label for="tipo_usuario" titulo="Tipo de Usuário" />
    <select
        id="tipo_usuario"
        name="user_type_id"
        required
        class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 mb-8 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
    >
        <option value="1" @selected((old('user_type_id', $usuario->user_type_id ?? '')) == 1)>Administrador</option>
        <option value="2" @selected((old('user_type_id', $usuario->user_type_id ?? '')) == 2)>Funcionário</option>
    </select>

    <button 
        type="submit" 
        class="w-full bg-black text-white font-bold py-2 px-4 rounded hover:bg-gray-800 transition"
    >
        Salvar Usuário
    </button>
</form>