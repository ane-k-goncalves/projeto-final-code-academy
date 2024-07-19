<?php

namespace App\Repositories;

use App\Models\Etapa;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};

interface EtapaRepositoryInterface
{
    public function getAll(string $filter = null, string $funilId = null): array;

    public function findOne(string $id, string $funilId): Etapa|null;

    public function create(CreateEtapaDTO $dto, string $funil_id): Etapa;

    public function update(UpdateEtapaDTO $dto, string $etapaId): Etapa|null;

    public function delete(string $id, string $funilId): void; 

    public function swap(string $etapaId, string $newPosition, string $funilId): void;
}
