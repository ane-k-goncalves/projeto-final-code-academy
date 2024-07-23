<?php

namespace App\Repositories;

use App\Models\Etapa;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO};
use App\Repositories\EtapaRepositoryInterface;

class EtapaEloquentORM implements EtapaRepositoryInterface
{
    protected $model;

    public function __construct(Etapa $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = null, string $funilId = null): array
    {
        $query = $this->model->query();

        if ($funilId) {
            $query->where('funil_id', $funilId);
        }

        if ($filter) {
            $query->where('name', 'like', "%$filter%");
        }

        return $query->get()->toArray();
    }

    public function findOne(string $id, string $funilId): Etapa|null
{
    return $this->model->where('id', $id)->where('funil_id', $funilId)->first();
}


    public function create(CreateEtapaDTO $dto, string $funil_id): Etapa
    {
        $position = $this->model->where('funil_id', $funil_id)->max('position') + 1;

        return $this->model->create([
            'name' => $dto->name,
            'position' => $position,
            'funil_id' => $funil_id
        ]);
    }

    public function update(UpdateEtapaDTO $dto,string $etapaId): Etapa|null
    {
        $etapa = $this->model->find($etapaId);  

        if (!$etapa) {
            return null;
        }

        $etapa->update([
            'name' => $dto->name,  
        ]);

        return $etapa;
    }


    public function delete(string $id, string $funilId): void
{
    
    $etapa = $this->model->find($id);

    if ($etapa) {
        $position = $etapa->position;

    
        $getPositions = $this->model->where('funil_id', $funilId)
            ->where('position', '>=', $position)
            ->where('id', '!=', $id)
            ->orderBy('position', 'asc') 
            ->get();

       
        foreach ($getPositions as $etapaAtual) {
            $etapaAtual->update([
                'position' => $etapaAtual->position - 1
            ]);
        }

        $etapa->delete();
    
    }
}


    public function swap(string $etapaId, string $newPosition, string $funilId): void
    {
        $etapa = $this->model->find($etapaId);
        $oldPosition = $etapa->position;
        $etapaId = $etapa->id;

        

        if ($newPosition < $oldPosition) {
        $getPositions = $this->model->where('funil_id', $funilId)
        ->whereBetween('position', [$newPosition, $oldPosition -1])
            ->where('id','!=',$etapaId)->get();


        foreach ($getPositions as $position){
                $position->update([
                'position' => $position->position+1
            ]);
            }
        }
        if ($newPosition > $oldPosition) {
            $getSmallerPositions = $this->model->where('funil_id', $funilId)
            ->whereBetween('position', [$oldPosition+1, $newPosition])
            ->where('id','!=',$etapaId)->get();



        foreach ($getSmallerPositions as $position){
        $position->update([
        'position' => $position->position-1
        ]);
    }

    
    }
    $etapa->Update([
        'position' => $newPosition
    ]);
    }
}
