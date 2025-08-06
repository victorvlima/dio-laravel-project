<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    
    /**
     * Listar todos os usuários.
     */
    public function getUsers()
    {
        //return 'Implementar getUsers();';
        $users = User::paginate(10);

        return view('users', compact('users'));
    }

    public function getUserById()
    {
        return 'Implementar getUserById();';
    }

    public function userForm()
    {
        return view('new-user');
    }

    public function newUser(Request $request)
    {
        //return 'Implementar newUser();';
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.saved')->with('success', 'User created successfully!');
    }

    public function updateUser()
    {
        return 'Implementar updateUser();';
    }

    public function deleteUser()
    {
        return 'Implementar deleteUser();';
    }
}
