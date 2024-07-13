<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationPresenter implements PaginationInterface
{
    protected LengthAwarePaginator $paginator;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function items(): array
    {
        return $this->paginator->items();
    }

    public function toArray(): array
    {
        return [
            'data' => $this->paginator->items(),
            'current_page' => $this->paginator->currentPage(),
            'last_page' => $this->paginator->lastPage(),
            'per_page' => $this->paginator->perPage(),
            'total' => $this->paginator->total(),
        ];
    }

    public function total(): int
    {
        return $this->paginator->total() ?? 0;
    }

    public function isFirstPage(): bool
    {
        return $this->paginator->onFirstPage();
    }

    public function isLastPage(): bool
    {
        return $this->paginator->currentPage() === $this->paginator->lastPage();
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage() ?? 1;
    }

    public function getNumberNextPage(): int
    {
        return $this->paginator->currentPage() + 1;
    }


    
    public function getNumberPreviousPage(): int
    {
        return $this->paginator->currentPage() - 1;
    }
}