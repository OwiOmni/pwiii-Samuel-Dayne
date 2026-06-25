@extends('auth.layout')
@section('title', 'Cadastro')

@section('content')
<div class="card">
    <h2>Criar Conta</h2>

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Seu nome completo">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" placeholder="Mínimo 6 caracteres">
        </div>
        <div class="form-group">
            <label>Confirmar Senha</label>
            <input type="password" name="password_confirmation" placeholder="Repita a senha">
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    <p class="link-text">Já tem conta? <a href="{{ route('login') }}">Entrar</a></p>
</div>
@endsection