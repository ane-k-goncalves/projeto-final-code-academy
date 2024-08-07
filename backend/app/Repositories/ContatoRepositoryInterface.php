<?php

namespace App\Repositories;

use App\Models\Contato;
use App\DTO\{CreateContatoDTO, UpdateContatoDTO};

interface ContatoRepositoryInterface
{
    public function getAll(string $filter = null, string $etapaId = null, bool $ignoreEtapa = false): array;

    public function findOne(string $id, string $etapaId): Contato|null;

    public function create(CreateContatoDTO $dto, string $etapaId): Contato;

    public function importCsv(string $filePath, string $etapaId): void;

    public function update(UpdateContatoDTO $dto, string $contatoId): Contato|null;

    public function delete(string $id, string $etapaId): void;

    public function swap(string $contatoId, int $newPosition, string $etapaId): void;

    public function swapPhase(string $contatoId, int $newPosition, string $etapaId, string $newEtapaId):void;
}
