<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;

class UserController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function dashboard()
    {
        $counts = [
            'users' => User::count(),
            'clients' => Client::count(),
            'projects' => Project::count(),
            'employees' => Employee::count(),
        ];

        return view('index', compact('counts'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega todos os usuários da tabela 'users'
        $users = User::paginate(15);

        // Passa os usuários para uma view chamada 'users.index'
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type_id' => $validated['user_type_id']
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'user_type_id' => $validated['user_type_id']
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
