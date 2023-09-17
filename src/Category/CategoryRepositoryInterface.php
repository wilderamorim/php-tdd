<?php

namespace App\Category;

Interface CategoryRepositoryInterface
{
    public function create(Category $category): void;

    public function update(Category $category): void;

    public function delete(int $id): void;

    public function get(int $id): Category;

    public function getAll(): array;
}