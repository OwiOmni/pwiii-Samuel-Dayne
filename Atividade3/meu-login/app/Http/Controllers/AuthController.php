<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // Tela de cadastro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Processar cadastro
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'O nome é obrigatório.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.unique'       => 'Este e-mail já está cadastrado.',
            'password.required'  => 'A senha é obrigatória.',
            'password.min'       => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Cadastro realizado! Faça login.');
    }

    // Tela de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Processar login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'E-mail ou senha incorretos.']);
    }

    // Dashboard (área logada)
    public function dashboard()
    {
        return view('auth.dashboard');
    }

    // Tela de editar perfil
    public function showEdit()
    {
        return view('auth.edit');
    }

    // Salvar edição
public function update(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'min:6|confirmed',
        ]);
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return back()->with('success', 'Dados atualizados com sucesso!');
}

    // Excluir conta
  public function destroy(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    $user->delete();

    return redirect()->route('login')->with('success', 'Conta excluída com sucesso.');
}

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}