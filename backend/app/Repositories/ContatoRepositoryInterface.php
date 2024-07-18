<?php

namespace App\Repositories;

use App\Models\Contato;
use App\DTO\{CreateContatoDTO, UpdateContatoDTO};

interface ContatoRepositoryInterface
{
    public function getAll(string $filter = null, string $etapaId = null): array;

    public function findOne(string $id, string $etapaId): Contato|null;

    public function create(CreateContatoDTO $dto): Contato;

    public function update(UpdateContatoDTO $dto): Contato|null;

    public function delete(string $id): void;

    public function swap(string $contatoId, string $newPosition, string $etapaId): void;

    public function swapPhase(string $contatoId, string $newPosition, string $etapaId, string $newEtapaId):void;
}
