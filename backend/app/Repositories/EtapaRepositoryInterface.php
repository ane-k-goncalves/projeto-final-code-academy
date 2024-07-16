<?php

namespace App\Repositories;

use App\DTO\CreateEtapaDTO, UpdateEtapaDTO, UpdateOrderEtapaDTO;

use App\Models\Etapa;


interface EtapaRepositoryInterface
{
  
    public function getAll(string $filter = null): array;
    public function findOne(string $id): ?Etapa;
    public function delete(string $id): void;
    public function create(CreateEtapaDTO $dto): Etapa;
    public function update(UpdateEtapaDTO $dto): ?Etapa;
    public function updateOrder(UpdateOrderEtapaDTO $dto): void;
}
