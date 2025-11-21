<?php

namespace App\Http\Controllers\Api\Lists;

use App\Http\Controllers\Controller;
use App\Services\Lists\ListsService;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    protected $listsService;

    public function __construct(ListsService $listsService)
    {
        $this->listsService = $listsService;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        return $this->listsService->getAll($user);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->all();

        if (!$data['name']) {
            return response()->json(['message' => 'O campo nome é obrigatório'], 400);
        }

        return $this->listsService->create($user, $data);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        return $this->listsService->getById($user, $id);
    }

    public function update(Request $request, $id)
    {
        return $this->listsService->update($request->user(), $id, $request->all());
    }

    public function destroy(Request $request, $id)
    {
        return $this->listsService->delete($request->user(), $id);
    }
}
