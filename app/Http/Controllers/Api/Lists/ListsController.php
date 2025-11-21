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
        return response()->json($this->listsService->getAll($request->user()));
    }

    public function store(Request $request)
    {
        return $this->listsService->create($request->user(), $request->all());
    }

    public function show(Request $request, $id)
    {
        return $this->listsService->getById($request->user(), $id);
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
