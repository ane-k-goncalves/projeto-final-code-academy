<?php

namespace App\Services;

use App\Repositories\EtapaRepositoryInterface;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};
use App\Models\Etapa;

class EtapaService
{
    protected $repository;

    public function __construct(EtapaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = null, string $funilId = null): array
    {
        return $this->repository->getAll($filter, $funilId);
    }

    public function findOne(string $id, string $funilId): Etapa|null
    {
        return $this->repository->findOne($id,$funilId);
    }

    public function create(CreateEtapaDTO $dto): Etapa
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateEtapaDTO $dto): Etapa|null
    {
        return $this->repository->update($dto);
    }

    
    public function delete(string $id, string $funilId): void
    {
        $this->repository->delete($id, $funilId);  
    }

    public function swap(string $etapa1Id, string $etapa2Id, string $funilId): void
    {
        $this->repository->swap($etapa1Id, $etapa2Id, $funilId);
    }
}
