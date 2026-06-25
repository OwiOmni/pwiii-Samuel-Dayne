@extends('auth.layout')
@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h2>Bem-vindo, {{ Auth::user()->name }}! 👋</h2>
    <p class="subtitle">Você está logado com o e-mail: <strong>{{ Auth::user()->email }}</strong></p>

    <div class="btn-group">
        <a href="{{ route('edit') }}" class="btn btn-secondary">✏️ Editar Perfil</a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-outline">Sair</button>
        </form>

        <form method="POST" action="{{ route('destroy') }}"
              onsubmit="return confirm('Tem certeza que quer excluir sua conta? Esta ação não pode ser desfeita.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑️ Excluir Conta</button>
        </form>
    </div>
</div>
@endsection