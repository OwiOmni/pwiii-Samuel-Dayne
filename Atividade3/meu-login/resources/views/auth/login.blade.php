@extends('auth.layout')
@section('title', 'Login')

@section('content')
<div class="card">
    <h2>Entrar</h2>

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" placeholder="Sua senha">
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="link-text">Não tem conta? <a href="{{ route('register') }}">Cadastre-se</a></p>
</div>
@endsection