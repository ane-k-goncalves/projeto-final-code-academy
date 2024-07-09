<?php

namespace App\Http\Controllers;

use App\DTO\CreateFunilDTO;
use App\DTO\UpdateFunilDTO;
use App\Services\FunilService;
use Illuminate\Http\Request;

class FunilController extends Controller
{
    protected $service;

    public function __construct(FunilService $service)
    {
        $this->service = $service;
    }

   
    public function index(Request $request)
    {
        $filter = $request->query('filter', null);
        $funis = $this->service->getAll($filter);
        return response()->json($funis);
    }

    
    public function store(Request $request)
    {
        $dto = new CreateFunilDTO($request->name);
        $funil = $this->service->new($dto);
        return response()->json($funil, 201);
    }

    
    public function show(string $id)
    {
        $funil = $this->service->findOne($id);
        if (!$funil) {
            return response()->json(['message' => 'Funil not found'], 404);
        }

        return response()->json($funil);
    }

    
    public function update(Request $request, string $id)
    {
        $dto = new UpdateFunilDTO($id, $request->name);
        $funil = $this->service->update($dto);

        if (!$funil) {
            return response()->json(['message' => 'Funil not found'], 404);
        }

        return response()->json($funil);
    }

    
    public function destroy(string $id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Funil deleted successfully']);
    }
}
