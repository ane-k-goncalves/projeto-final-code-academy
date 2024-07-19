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
        $this->model->where('id', $id)->where('funil_id', $funilId)->delete();
    }

    public function swap(string $etapaId, string $newPosition, string $funilId): void
    {
        $etapa = $this->model->find($etapaId);

        $etapa->Update([
            'position' => $newPosition
        ]);

        $getPositions = $this->model->where('etapa_id', $funilId)
            ->where('position','>=', $newPosition)
            ->where('id','!=',$etapaId)->get();


        foreach ($getPositions as $position){
                $position->update([
                'position' => $position->position+1
            ]);
            }
    }
    

}
