<?php

namespace App\Services;


use App\Repositories\PaginationInterface;
use Illuminate\Support\Facades\Log;

use App\DTO\CreateFunilDTO;
use App\DTO\UpdateFunilDTO;
use App\Models\Funil;
use App\Repositories\FunilRepositoryInterface;


class FunilService{
    

    protected $repository;
    public function __construct(FunilRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function paginate(
        int $page = 1,
        int $totalPerPage = 8,
        string $filter = null
    ): PaginationInterface {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
        );
    }
    public function getAll(string $filter = null):array{
        return $this->repository->getAll($filter);
    }

    public function new(CreateFunilDTO $dto): Funil
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateFunilDTO $dto): Funil|null
    {
    return $this->repository->update($dto);
    }


    public function findOne(string $id):Funil|null{
        return $this->repository->findOne($id);
    }

    public function delete(string $id){
         $this->repository->delete($id);
    }
}