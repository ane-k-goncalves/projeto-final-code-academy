<?php

namespace App\Repositories;

use App\Models\Funil;
use App\DTO\{CreateFunilDTO, UpdateFunilDTO};
use App\Repositories\FunilRepositoryInterface;

class FunilEloquentORM implements FunilRepositoryInterface
{
   
    public function __construct(protected Funil $model){

    }

    public function getAll(string $filter = null): array
    {
        $query = $this->model->query();  

        if ($filter) {
        $query->where('name', 'like', "%$filter%");
    }
        return $query->get()->toArray();
    }

    
    public function findOne(string $id): Funil|null
    {
        $funil =$this->model->find($id);
        if(!$funil){
            return null;
        }
        return $funil;
    }

    
    public function create(CreateFunilDTO $dto): Funil
    {
        return $this->model->create([
            'name' => $dto->name
        ]);
    }

    public function update(UpdateFunilDTO $dto): Funil|null
    {
        $funil = $this->model->find($dto->id);

        if (!$funil) {
            return null;
        }

        $funil->update([
            'name' => $dto->name
        ]);

        return $funil;
    }

    
    public function delete(string $id): void
    {
         $this->model->findOrFail($id)->delete();
    }
}
