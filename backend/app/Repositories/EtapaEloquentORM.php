<?php

namespace App\Repositories;


use App\Models\Etapa;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};
use App\Repositories\EtapaRepositoryInterface;
use Illuminate\Http\Client\Request;

class EtapaEloquentORM implements EtapaRepositoryInterface
{
    protected $model;

    public function __construct(Etapa $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = null): array
    {
        $query = $this->model->query();  

        if ($filter) {
            $query->where('name', 'like', "%$filter%");
        }

        return $query->get()->toArray();
    }

    public function findOne(string $id): Etapa|null
    {
        return $this->model->find($id);
    }

    public function create(CreateEtapaDTO $dto): Etapa
    {
        return $this->model->create([
            'name' => $dto->name
        ]);
    }

    public function update(UpdateEtapaDTO $dto): Etapa|null
    {
        $etapa = $this->model->find($dto->id);

        if (!$etapa) {
            return null;
        }

        $etapa->update([
            'name' => $dto->name
        ]);

        return $etapa;
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function updateOrder(UpdateOrderEtapaDTO $dto): void  
    {
        foreach ($dto->etapas as $etapa) {
            $this->model->where('id', $etapa['id'])->update(['position' => $etapa['position']]);
        }
    }

}

