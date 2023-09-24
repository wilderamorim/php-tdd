<?php

namespace App\Repository\Presenters;

use App\Repository\Contracts\PaginationInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationEloquentPresenter implements PaginationInterface
{
    public function __construct(protected LengthAwarePaginator $paginator)
    {
        //
    }
    public function items(): array
    {
        return $this->paginator->items();
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage();
    }

    public function lastPage(): int
    {
        return $this->paginator->lastPage();
    }

    public function perPage(): int
    {
        return $this->paginator->perPage();
    }

    public function firstItem(): int
    {
        return $this->paginator->firstItem() ?? 1;
    }

    public function lastItem(): int
    {
        return $this->paginator->lastItem() ?? 1;
    }

    public function total(): int
    {
        return $this->paginator->total();
    }
}
