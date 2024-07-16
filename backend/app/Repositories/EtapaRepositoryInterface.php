<?php

namespace App\Repositories;

use App\Models\Etapa;
use App\DTO\{CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO};

interface EtapaRepositoryInterface
{
    public function getAll(string $filter = null, string $funilId = null): array;

    public function findOne(string $id, string $funilId): Etapa|null;

    public function create(CreateEtapaDTO $dto): Etapa;

    public function update(UpdateEtapaDTO $dto): Etapa|null;

    public function delete(string $id, string $funilId): void; 

    public function swap(string $etapa1Id, string $etapa2Id, string $funilId): void;
}
