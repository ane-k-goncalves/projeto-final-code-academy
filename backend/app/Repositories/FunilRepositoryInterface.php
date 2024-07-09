<?php

namespace App\Repositories;

use App\DTO\{CreateFunilDTO, UpdateFunilDTO};
use App\Http\Requests\StoreUpdateFunil;
use App\Models\Funil;
use stdClass;

interface FunilRepositoryInterface
{
    public function getAll(string $filter = null): array;
    public function findOne(string $id): Funil|null;
    public function delete(string $id): void;
    public function create(CreateFunilDTO $dto): Funil;
    public function update(UpdateFunilDTO $dto): Funil|null;
}
