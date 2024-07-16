<?php

namespace App\Repositories;

use App\Models\Etapa;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};
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


    public function create(CreateEtapaDTO $dto): Etapa
    {
        $position = $this->model->where('funil_id', $dto->funil_id)->max('position') + 1;

        return $this->model->create([
            'name' => $dto->name,
            'funil_id' => $dto->funil_id,
            'position' => $position
        ]);
    }

    public function update(UpdateEtapaDTO $dto): Etapa|null
    {
        $etapa = $this->model->find($dto->id);  

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

    public function swap(string $etapa1Id, string $etapa2Id, string $funilId): void
    {
        $etapa1 = $this->findOne($etapa1Id, $funilId);
        $etapa2 = $this->findOne($etapa2Id, $funilId);
    
        if ($etapa1 && $etapa2 && $etapa1->position !== $etapa2->position) {
            $etapa1Position = $etapa1->position;
            $etapa2Position = $etapa2->position;
    
            // Atualiza a posição das etapas sem criar conflitos
            $this->model->where('funil_id', $funilId)
                ->where('position', $etapa2Position)
                ->update(['position' => $etapa1Position]);
    
            $etapa1->position = $etapa2Position;
            $etapa2->position = $etapa1Position;
    
            $etapa1->save();
            $etapa2->save();
        }
    }
    

}
