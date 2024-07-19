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

    public function getAll(string $filter = null, string $etapaId = null): array
    {
        return $this->repository->getAll($filter, $etapaId);
    }

    public function findOne(string $id, string $etapaId): Contato|null
    {
        return $this->repository->findOne($id,$etapaId);
    }

    public function create(CreateContatoDTO $dto, string $etapaId): Contato
    {
        return $this->repository->create($dto, $etapaId);
    }

    public function update(UpdateContatoDTO $dto,string $contatoId): Contato|null
    {
        return $this->repository->update($dto, $contatoId);
    }


    public function delete(string $id): void
    {
        $this->repository->delete($id);
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
