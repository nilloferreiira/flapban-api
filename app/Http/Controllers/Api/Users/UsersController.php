<?php

namespace App\Http\Controllers\Api\Users;

use App\Constants\Permissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authenticatedUser = $request->user();

        if (!$authenticatedUser->hasPermission(Permissions::VIEW_USER)) {
            return response()->json(['message' => 'Você não tem permissão para visualizar usuários'], 403);
        }

        $users = User::paginate(10);
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $authenticatedUser = $request->user();

        if (!$authenticatedUser->hasPermission(Permissions::VIEW_USER)) {
            return response()->json(['message' => 'Você não tem permissão para visualizar usuários'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Users\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $authenticatedUser = $request->user();

        if (!$authenticatedUser->hasPermission(Permissions::EDIT_USER)) {
            return response()->json(['message' => 'Você não tem permissão para atualizar usuários'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $email = $request->input('email');

        if ($email !== $user->email) {
            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                return response()->json(['message' => 'Este e-mail já está em uso por outro usuário.'], 422);
            }
        }

        $data = $request->only(['name', 'email', 'password', 'role_id']);
        // Remove campos vazios para não sobrescrever com null
        $data = array_filter($data, fn($v) => $v !== null && $v !== '');

        $user->update($data);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $authenticatedUser = $request->user();

        if (!$authenticatedUser->hasPermission(Permissions::DELETE_USER)) {
            return response()->json(['message' => 'Você não tem permissão para excluir usuários'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete(); // Soft delete
        return response()->json(['message' => 'User deleted (soft) successfully', 204]);
    }
}
