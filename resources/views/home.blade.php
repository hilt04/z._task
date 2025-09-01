@extends('components.master')


@section('content')
    <div class="page-container">
        <img src="{{ asset('ztask.png') }}" alt="Logo do Projeto" class="logo" />
        <h1>Seja bem vindo ao z.task!</h1>
        <p>A ferramenta de tarefas da ZLIN.</p>
        <a href="{{ route('login.show') }}" class="login-button">Log in</a>
    </div>
@endsection