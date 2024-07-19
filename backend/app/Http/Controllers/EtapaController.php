<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreUpdateEtapa;
use App\Services\EtapaService;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO};
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    protected $service;

    public function __construct(EtapaService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, string $funilId)
    {
        $filter = $request->query('filter');
        $etapas = $this->service->getAll($filter, $funilId);
        return response()->json($etapas);
    }

    public function show(string $funilId, string $id)
    {
        $etapa = $this->service->findOne($id, $funilId);
        return response()->json($etapa);
    }

    public function store(StoreUpdateEtapa $requestEtapa, string $funil_id)
    {

        $validatedData = $requestEtapa->validated();
        $dto = CreateEtapaDTO::makeFromRequest($validatedData);

        $etapa = $this->service->create($dto, $funil_id);
        return response()->json($etapa, 201);
        
    }

    public function update(StoreUpdateEtapa $requestContato,string $funilId,string $etapaId)
    {
      
        $validatedData = $requestContato->validated();
        $dto = UpdateEtapaDTO::makeFromRequest($validatedData);

        $etapa = $this->service->update($dto, $etapaId);

        if (!$etapa) {
            return response()->json(['message' => 'Etapa não encontrada.'], 404);
        }

        return response()->json(['message' => 'Etapa atualizada com sucesso!', 'data' => $etapa], 200);
    }

    public function destroy(string $funilId, string $id)
    {
        $this->service->delete($id, $funilId);  
        return response()->json(['message' => 'Etapa deletada com sucesso!'], 204);
    }

    public function swap(Request $request, string $funilId)
    {
        $newPosition = $request->input('new_position');
        $etapaId = $request->input('etapa_id');

        $this->service->swap($etapaId, $newPosition, $funilId);

        return response()->json(['message' => 'Contato movido com sucesso'], 200);
    }
}
