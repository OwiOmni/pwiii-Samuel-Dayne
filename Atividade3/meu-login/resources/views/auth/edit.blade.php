@extends('auth.layout')
@section('title', 'Editar Perfil')

@section('content')
<div class="card">
    <h2>Editar Perfil</h2>

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('update') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}">
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}">
        </div>
        <div class="form-group">
            <label>Nova Senha <span class="optional">(deixe em branco para não alterar)</span></label>
            <input type="password" name="password" placeholder="Nova senha">
        </div>
        <div class="form-group">
            <label>Confirmar Nova Senha</label>
            <input type="password" name="password_confirmation" placeholder="Confirme a nova senha">
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">💾 Salvar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-outline">Voltar</a>
        </div>
    </form>
</div>
@endsection