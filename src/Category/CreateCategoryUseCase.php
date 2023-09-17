<?php

namespace App\Category;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {
    }

    public function create(Category $category): void
    {
        $this->repository->create($category);
    }
}
