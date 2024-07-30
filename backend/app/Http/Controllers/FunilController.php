<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\DTO\CreateFunilDTO;
use App\DTO\UpdateFunilDTO;
use App\Http\Request\StoreUpdateFunil;
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
        $filter = data_get($request->filter, null);
        $user = JWTAuth::parseToken()->authenticate(); // Autentica o usuário

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $funis = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('perPage', 8),
            filter: $filter
        );

        return response()->json($funis->toArray());
    }


    public function store(StoreUpdateFunil $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
    
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $dto = new CreateFunilDTO(
            name: $request->name,
            userId: $user->id
        );

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
