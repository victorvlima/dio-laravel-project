<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

    /**
     * Exibir o usuário por ID
     */
    public function getUserById(int $id)
    {
        try {
            // Verificar se o ID é válido
            if (!is_numeric($id) || $id <= 0) {
                return redirect()->route('users.index')
                    ->with('error', 'ID de usuário inválido!');
            }

            $user = User::find($id);
            
            if (!$user) {
                return redirect()->route('users.index')
                    ->with('error', 'Usuário com ID ' . $id . ' não encontrado!');
            }
            
            return view('show-user', compact('user'));
            
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Erro ao buscar usuário: ' . $e->getMessage());
        }
    }

    /**
     * Exibir o formulário de registro de um novo usuário
     */
    public function userForm()
    {
        return view('new-user');
    }

    /**
     * Registrar um novo usuário
     */
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

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Exibir formulaŕio para edição de usuário
     */
    public function editUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
            return view('edit-user', compact('user'));
            
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Usuário não encontrado!');
        }
    }

    /**
     * Atualizar um usuário
     */
    public function updateUser(Request $request, int $id)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            // Buscar o usuário
            $user = User::findOrFail($id);

            // Preparar dados para atualização
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            // Adicionar senha se fornecida
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Atualizar o usuário
            $user->update($updateData);

            // Redirecionar com mensagem de sucesso
            return redirect()->route('users.show', $id)
                ->with('success', 'Usuário atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }
    /**
     * Registrar a exclusão de um usuário ou deletar de fato
     */
    public function deleteUser()
    {
        return 'Implementar deleteUser();';
    }
}
