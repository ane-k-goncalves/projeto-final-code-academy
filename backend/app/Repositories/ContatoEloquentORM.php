<?php

namespace App\Repositories;

use App\Models\Contato;
use App\DTO\{CreateContatoDTO, UpdateContatoDTO};
use App\Repositories\ContatoRepositoryInterface;
use League\Csv\Reader;
use League\Csv\Statement;

class ContatoEloquentORM implements ContatoRepositoryInterface
{
    protected $model;

    public function __construct(Contato $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = null, string $etapaId = null, bool $ignoreEtapa = false): array
    {
        $query = $this->model->query();

        if (!$ignoreEtapa && $etapaId) {
            $query->where('etapa_id', $etapaId)
            ->orderBy('position','asc');
        }   

        if ($filter) {
            $query->where('name', 'like', "%$filter%");
        }

        return $query->get()->toArray();
    }

    public function findOne(string $id, string $etapaId): Contato|null  
    {
    return $this->model->where('id', $id)->where('etapa_id', $etapaId)->first();
    }   


    public function create(CreateContatoDTO $dto, string $etapaId): Contato
    {
        $position = $this->model->where('etapa_id', $etapaId)->max('position') + 1;

        return $this->model->create([
            'name' => $dto->name,
            'telefone' => $dto->telefone,
            'email' => $dto->email,
            'data_de_nascimento' => $dto->data_de_nascimento,
            'valor' => $dto->valor,
            'ddd' => $dto->ddd,
            'cpf' => $dto->cpf,
            'position'=>$position,
            'endereco'=>$dto->endereco,
            'etapa_id' => $etapaId



        ]);
    }

    public function importCsv(string $filePath, string $etapaId): void
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        $stmt = (new Statement())->process($csv);

        foreach ($stmt as $record) {
            $dto = new CreateContatoDTO(
                $record['name'],
                $record['telefone'],
                $record['email'],
                $record['data_de_nascimento'],
                $record['valor'],
                $record['ddd'],
                $record['cpf'],
                $record['endereco'],
            
            );
            $this->create($dto, $etapaId);
        }
    }

    public function update(UpdateContatoDTO $dto, string $contatoId): Contato|null
    {
        $contato = Contato::find($contatoId);

        if (!$contato) {
            return null;
        }

        $contato->update([
            'name' => $dto->name,
            'telefone' => $dto->telefone,
            'email' => $dto->email,
            'data_de_nascimento' => $dto->data_de_nascimento,
            'endereco' => $dto->endereco,
            'valor' => $dto->valor,
            'ddd' => $dto->ddd,
           
        ]);

        return $contato;
    }


    public function delete(string $etapaId, string $id): void
    {
        $contato = $this->model->find($id);
    
        if ($contato) {
            $position = $contato->position;
    
            $getPositions = $this->model->where('etapa_id', $etapaId)
                ->where('position', '>', $position)
                ->where('id', '!=', $id)
                ->orderBy('position', 'asc')
                ->get();
    
            foreach ($getPositions as $contatoAtual) {
                $contatoAtual->update([
                    'position' => $contatoAtual->position - 1
                ]);
            }
    
            $contato->delete(); 
        }
    }

    public function swap(string $contatoId, int $newPosition, string $etapaId): void
    {
     
        $contato = $this->model->find($contatoId);
        $oldPosition = $contato->position;
        $contatoId = $contato->id;
        
        if($newPosition <1){
            return;
        }
        else if($newPosition == $oldPosition){
            return;
        }else if ($newPosition < $oldPosition) {
            $getPositions = $this->model->where('etapa_id', $etapaId)
            ->whereBetween('position', [$newPosition, $oldPosition -1])
                ->where('id','!=',$contatoId)
                ->orderBy('position', 'asc')
                ->get();
    
    
            foreach ($getPositions as $position){
                    $position->update([
                    'position' => $position->position+1
                ]);
                }
            }
            if ($newPosition > $oldPosition) {
                $getSmallerPositions = $this->model->where('etapa_id', $etapaId)
                ->whereBetween('position', [$oldPosition+1, $newPosition])
                ->where('id','!=',$contatoId)
                ->orderBy('position', 'asc')
                ->get();
    
    
    
            foreach ($getSmallerPositions as $position){
            $position->update([
            'position' => $position->position-1
            ]);
        }
    }


    $contato->Update([
        'position' => $newPosition
    ]);
}
        



    public function swapPhase(string $contatoId, int $newPosition, string $etapaId, string $newEtapaId): void
    {
        $contato = $this->model->find($contatoId);
        $oldPosition = $contato->position;
        $oldEtapaId = $contato->etapa_id;


        if($newPosition <1){
            return;
        }
        $getOldPositions = $this->model->where('etapa_id', $oldEtapaId)
            ->where('position','>=', $oldPosition)
            ->where('id','!=',$contatoId)
            ->orderBy('position', 'asc')
            ->get();

        foreach ($getOldPositions as $position){
                $position->update([
                    'position' => $position->position-1
                ]);
            }


        $contato->Update([
            'etapa_id' => $newEtapaId,
            'position' => $newPosition
        ]);

        $getPositions = $this->model->where('etapa_id', $newEtapaId)
            ->where('position','>=', $newPosition)
            ->where('id','!=',$contatoId)
            ->orderBy('position', 'asc')
            ->get();

        foreach ($getPositions as $position){

                $position->update([
                    'position' => $position->position+1
                ]);
            }
        }
}
