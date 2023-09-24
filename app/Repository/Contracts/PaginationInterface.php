<?php

namespace App\Repository\Contracts;

interface PaginationInterface
{
    public function items(): array;

    public function currentPage(): int;

    public function lastPage(): int;

    public function perPage(): int;

    public function firstItem(): int;

    public function lastItem(): int;

    public function total(): int;
}
