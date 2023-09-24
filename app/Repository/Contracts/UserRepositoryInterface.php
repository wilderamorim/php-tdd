<?php

namespace App\Repository\Contracts;

interface UserRepositoryInterface
{
    public function findAll(): array;

    public function findAllPaginated(int $currentPage = 1): PaginationInterface;

    public function findOneById(string $id): object;

    public function save(array $data, ?string $id = null): object;

    public function create(array $data): object;

    public function update(string $id, array $data): object;

    public function delete(string $id): bool;
}
