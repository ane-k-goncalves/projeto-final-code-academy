<?php

namespace App\Services;

use App\Repositories\ContatoRepositoryInterface;
use App\DTO\{CreateContatoDTO, UpdateContatoDTO};
use App\Models\Contato;

class ContatoService
{
    protected $repository;

    public function __construct(ContatoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = null, string $etapaId = null, bool $ignoreEtapa = false): array
    {
        
        return $this->repository->getAll($filter, $etapaId, $ignoreEtapa);
    }

    public function findOne(string $id, string $etapaId): Contato|null
    {
        return $this->repository->findOne($id,$etapaId);
    }

    public function create(CreateContatoDTO $dto, string $etapaId): Contato
    {
        return $this->repository->create($dto, $etapaId);
    }

    public function importCsv(string $filePath, string $etapaId): void
    {
        $this->repository->importCsv($filePath, $etapaId);
    }

    public function update(UpdateContatoDTO $dto,string $contatoId): Contato|null
    {
        return $this->repository->update($dto, $contatoId);
    }


    public function delete(string $id, string $etapaId): void
    {
        $this->repository->delete($etapaId, $id);
    }

    public function swap(string $contatoId, int $newPosition, string $etapaId): void
    {
        $this->repository->swap($contatoId, $newPosition, $etapaId);
    }

    public function swapPhase(string $contatoId, string $newPosition, string $etapaId, string $newEtapaId): void
    {
        $this->repository->swapPhase($contatoId, $newPosition, $etapaId, $newEtapaId);
    }



}
