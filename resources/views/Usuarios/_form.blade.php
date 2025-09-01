<form 
    method="POST" 
    action="{{ isset($usuario) ? route('user.create.now') : '' }}";
    class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">

    <x-label for="nome" titulo="Nome do Usuário" />
    <input 
        type="text" 
        id="nome" 
        name="nome" 
        value="{{ old('nome', $usuario->nome ?? '') }}" 
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
        name="senha" 
        {{ isset($usuario) ? '' : 'required' }}
        class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 mb-5 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
        placeholder="Digite a senha"
    >

    <x-label for="tipo_usuario" titulo="Tipo de Usuário" />
    <select 
        id="tipo_usuario" 
        name="tipo_usuario" 
        required
        class="shadow-sm bg-black border border-black text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-black-500 block w-full p-2.5 mb-8 dark:bg-white dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-white-500 dark:focus:border-black-500 dark:shadow-sm-light"
    >
        <option value="administrador" {{ (old('tipo_usuario', $usuario->user_type ?? '') == 'administrador') ? 'selected' : '' }}>Administrador</option>
        <option value="funcionario" {{ (old('tipo_usuario', $usuario->user_type ?? '') == 'funcionario') ? 'selected' : '' }}>Funcionário</option>
    </select>

    <button 
        type="submit" 
        class="w-full bg-black text-white font-bold py-2 px-4 rounded hover:bg-gray-800 transition"
    >
        Salvar Usuário
    </button>
</form>