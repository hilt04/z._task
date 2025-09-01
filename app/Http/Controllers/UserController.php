<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega todos os usuários da tabela 'users'
        $users = User::all();

        // Passa os usuários para uma view chamada 'users.index'
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('usercreate');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'user_type_id' => 'required|in:Administrador,Funcionário',
        ]);

        // Get the user type ID from the tipo
        $userType = \App\Models\UserType::where('tipo', $validated['user_type_id'])->first();

        if (!$userType) {
            return back()->withErrors(['user_type_id' => 'Tipo de usuário inválido.'])->withInput();
        }

        User::create([
            'name' => $validated['nome'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'user_type_id' => $userType->id
        ]);

        return redirect()->route('index')->with('success', 'Usuário criado com sucesso!');
    }



    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
