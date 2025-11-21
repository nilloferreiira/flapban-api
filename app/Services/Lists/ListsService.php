<?php

namespace App\Services\Lists;

use App\Constants\Permissions;
use App\Models\List\ListModel;
use App\Models\User;
use App\Traits\CheckPermission;
use Illuminate\Support\Str;

class ListsService
{
    use CheckPermission;

    /**
     * Lista todas as listas.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(User $user)
    {
        if ($permission = $this->checkPermission($user, Permissions::VIEW_JOB)) return $permission;

        $lists = ListModel::paginate(20);
        return response()->json($lists);
    }

    /**
     * Retorna uma lista pelo ID.
     *
     * @param User $user
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(User $user, $id)
    {
        if ($permission = $this->checkPermission($user, Permissions::VIEW_JOB)) return $permission;

        $list = ListModel::find($id);

        if (!$list) {
            return response()->json(['message' => 'Lista não encontrada'], 404);
        }

        return response()->json($list);
    }

    /**
     * Cria uma nova lista.
     *
     * @param User $user
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(User $user, $data)
    {
        if ($permission = $this->checkPermission($user, Permissions::CREATE_JOB)) return $permission;

        $list = ListModel::create([
            'name' => $data['name']
        ]);

        return response()->json(['message' => 'Lista criada com sucesso', 'lista' => $list], 201);
    }

    /**
     * Atualiza uma lista existente.
     *
     * @param User $user
     * @param int $id
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(User $user, $id, $data)
    {
        if ($permission = $this->checkPermission($user, Permissions::EDIT_JOB)) return $permission;

        $list = ListModel::find($id);
        if (!$list) {
            return response()->json(['message' => 'Lista não encontrada'], 404);
        }

        $list->update([
            'name' => $data['name'],
        ]);

        return response()->json(['message' => 'Lista atualizada com sucesso', 'lista' => $list], 200);
    }

    /**
     * Exclui uma lista.
     *
     * @param User $user
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user, $id)
    {
        if ($permission = $this->checkPermission($user, Permissions::DELETE_JOB)) return $permission;

        $list = ListModel::find($id);
        if (!$list) {
            return response()->json(['message' => 'Lista não encontrada'], 404);
        }
        $list->delete();

        return response()->json(['message' => 'Lista excluída com sucesso'], 204);
    }
}
