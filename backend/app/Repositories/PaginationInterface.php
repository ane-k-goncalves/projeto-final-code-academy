<?php

namespace App\Repositories;

interface PaginationInterface
{
    public function items(): array;
    public function toArray(): array;
    public function total(): int;
    public function currentPage(): int;
    public function isFirstPage(): bool;
    public function isLastPage(): bool;
    public function getNumberNextPage(): int;
    public function getNumberPreviousPage(): int;
}
