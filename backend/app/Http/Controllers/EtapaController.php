<?php

namespace App\Http\Controllers;

use App\Services\EtapaService;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    protected $etapaService;

    public function __construct(EtapaService $etapaService)
    {
        $this->etapaService = $etapaService;
    }

    public function index(Request $request, string $funilId)
    {
        $filter = $request->query('filter');
        $etapas = $this->etapaService->getAll($filter, $funilId);
        return response()->json($etapas);
    }

    public function show(string $funilId, string $id)
    {
        $etapa = $this->etapaService->findOne($id, $funilId);
        return response()->json($etapa);
    }

    public function store(Request $request, string $funilId)
    {
        $dto = CreateEtapaDTO::makeFromRequest($request, $funilId);
        $etapa = $this->etapaService->create($dto);
        return response()->json($etapa, 201);
    }

    public function update(Request $request, string $etapaId)
    {
      

        $dto = UpdateEtapaDTO::makeFromRequest($request);

        $etapa = $this->etapaService->update($dto);

        if (!$etapa) {
            return response()->json(['message' => 'Etapa não encontrada.'], 404);
        }

        return response()->json(['message' => 'Etapa atualizada com sucesso!', 'data' => $etapa], 200);
    }

    public function destroy(string $funilId, string $id)
    {
        $this->etapaService->delete($id, $funilId);  
        return response()->json(['message' => 'Etapa deletada com sucesso!'], 204);
    }

    public function swap(Request $request, string $funilId)
    {
        $request->validate([
            'etapa1_id' => 'required|string|exists:etapas,id',
            'etapa2_id' => 'required|string|exists:etapas,id',
        ]);
    
        $etapa1Id = $request->input('etapa1_id');
        $etapa2Id = $request->input('etapa2_id');
    
        $etapa1 = $this->etapaService->findOne($etapa1Id, $funilId);
        $etapa2 = $this->etapaService->findOne($etapa2Id, $funilId);
    
        if ($etapa1 && $etapa2 && $etapa1->position === $etapa2->position) {
            return response()->json(['message' => 'As etapas já estão na mesma posição.'], 400);
        }
    
        $this->etapaService->swap($etapa1Id, $etapa2Id, $funilId);
    
        return response()->json(['message' => 'Posições das etapas trocadas com sucesso!'], 200);
    }
}
