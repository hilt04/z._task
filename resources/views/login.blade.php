@extends('components.master')

@section('content')
    <div class="login-container">
        <img src="{{ asset('ztask.png') }}" alt="Logo do Projeto" class="logo" />
        <h2>Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary mb-3">Entrar</button><br>
            <a href="{{ route('user.create') }}" class="btn btn-link">Criar conta</a> |
            <a href="{{ route('password.forgot') }}" class="btn btn-link">Esqueci minha senha</a>
        </form>
    </div>
@endsection