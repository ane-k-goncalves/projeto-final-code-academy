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

    public function create(CreateEtapaDTO $dto, string $funil_id): Etapa
    {
        return $this->repository->create($dto, $funil_id);
    }

    public function update(UpdateEtapaDTO $dto, string $etapaId): Etapa|null
    {
        return $this->repository->update($dto, $etapaId);
    }

    
    public function delete(string $id, string $funilId): void
    {
        $this->repository->delete($id, $funilId);  
    }

    public function swap(string $etapaId, string $newPosition, string $funilId): void
    {
        $this->repository->swap($etapaId, $newPosition, $funilId);
    }
}
