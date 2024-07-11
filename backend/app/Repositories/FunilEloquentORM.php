<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Funil;
use App\DTO\{CreateFunilDTO, UpdateFunilDTO};
use App\Repositories\FunilRepositoryInterface;

class FunilEloquentORM implements FunilRepositoryInterface
{
    protected $model;

    public function __construct(Funil $model)
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

    public function findOne(string $id): Funil|null
    {
        return $this->model->find($id);
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

    public function paginate(int $page = 1, string $filter = null,int $totalPerPage = 15): PaginationInterface
    {
        $query = $this->model->query();

        if ($filter) {
            $query->where(function ($query) use ($filter) {
                $query->where('subject', 'like', "%{$filter}%")
                      ->orWhere('body', 'like', "%{$filter}%");
            });
        }

        $paginator = $query->paginate($totalPerPage, ['*'], 'page', $page);
        return new PaginationPresenter($paginator);
    }
}
