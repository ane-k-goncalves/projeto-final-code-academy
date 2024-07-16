<?php

namespace App\Services;

use App\Repositories\EtapaRepositoryInterface;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};
use App\Models\Etapa;

class EtapaService
{
    protected $etapaRepository;

    public function __construct(EtapaRepositoryInterface $etapaRepository)
    {
        $this->etapaRepository = $etapaRepository;
    }

    public function getAll(string $filter = null, string $funilId = null): array
    {
        return $this->etapaRepository->getAll($filter, $funilId);
    }

    public function findOne(string $id, string $funilId): Etapa|null
    {
        return $this->etapaRepository->findOne($id,$funilId);
    }

    public function create(CreateEtapaDTO $dto): Etapa
    {
        return $this->etapaRepository->create($dto);
    }

    public function update(UpdateEtapaDTO $dto): Etapa|null
    {
        return $this->etapaRepository->update($dto);
    }

    
    public function delete(string $id, string $funilId): void
    {
        $this->etapaRepository->delete($id, $funilId);  
    }

    public function swap(string $etapa1Id, string $etapa2Id, string $funilId): void
    {
        $this->etapaRepository->swap($etapa1Id, $etapa2Id, $funilId);
    }
}
