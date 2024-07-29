<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreCreateContato;
use App\Http\Request\StoreUpdateContato;
use App\Services\ContatoService;
use App\DTO\{CreateContatoDTO, UpdateContatoDTO};
use Illuminate\Http\Request;
use League\Csv\Reader;
use Illuminate\Support\Facades\Validator;
use League\Csv\Statement;

class ContatoController extends Controller
{
    protected $service;

    public function __construct(ContatoService $service)
    {
        $this->service = $service;
    }

   


    public function index(Request $request, string $etapaId)
    {
      
    $filter = $request->input('filter', null);
    $ignoreEtapa = filter_var($request->input('ignoreEtapa', false), FILTER_VALIDATE_BOOLEAN);
    

    $etapaIdParam = $ignoreEtapa ? null : $etapaId;
    
    
    $contatos = $this->service->getAll($filter, $etapaIdParam, $ignoreEtapa);
    
    return response()->json($contatos);
    }

    public function show(string $etapaId, string $id)
    {
        $contato = $this->service->findOne($id, $etapaId);
        return response()->json($contato);
    }

    public function store(StoreCreateContato $requestEtapa, string $etapaId)
    {
        $validatedData = $requestEtapa->validated();
        $dto = CreateContatoDTO::makeFromRequest($validatedData);

        $contato = $this->service->create($dto, $etapaId);
        return response()->json($contato, 201);
    }

    public function importCsv(Request $request, string $etapaId)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|file|mimes:csv,txt'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $file = $request->file('file')->getPathname();
    $csv = Reader::createFromPath($file, 'r');
    $csv->setHeaderOffset(0);
    $stmt = (new Statement())->process($csv);

    foreach ($stmt as $record) {
        $recordValidator = Validator::make($record, (new StoreCreateContato())->rules());

        if ($recordValidator->fails()) {
            return response()->json($recordValidator->errors(), 400);
        }

        $dto = CreateContatoDTO::makeFromRequest($record);
        $this->service->create($dto, $etapaId);
    }

    return response()->json(['message' => 'Importação e criação realizada com sucesso'], 200);
}

    public function update(StoreUpdateContato $requestContato, string $etapaId,string $contatoId)
    {
        $validatedData = $requestContato->validated();
        $dto = UpdateContatoDTO::makeFromRequest($validatedData);
        
        $contato = $this->service->update($dto, $contatoId);

        if (!$contato) {
            return response()->json(['message' => 'Contato não encontrado.'], 404);
        }

        return response()->json(['message' => 'Contato atualizado com sucesso!', 'data' => $contato], 200);
    }
  
    public function destroy(string $etapaId, string $id)
    {
        try {
            $this->service->delete($id, $etapaId);
            return response()->json(['message' => 'Contato deletado com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function swap(Request $request,string $etapaId, string $contatoId)
    {
        $newPosition = $request->newPosition;
        $contatoId = $request->contatoId;

        
        $this->service->swap($contatoId, $newPosition, $etapaId);
    
    
        return response()->json(['message' => 'Contato movido com sucesso'], 200);
    }

    public function swapPhase(Request $request, string $etapaId, string $contatoId)
    {
        $newPosition = $request->newPosition;
        $etapaId = $request->etapaId;
        $newEtapaId = $request->newEtapaId;

        $this->service->swapPhase($contatoId, $newPosition, $etapaId, $newEtapaId);

        return response()->json(['message' => 'Contato movido para uma nova etapa com sucesso'], 200);
    }
}
