<?php

namespace Tests\Unit\Category;

use App\Category\{Category, CategoryRepositoryInterface, CreateCategoryUseCase};
use PHPUnit\Framework\TestCase;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testShouldCreateCategory(): void
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
        );

        $repository = $this->createMock(CategoryRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('create')
            ->with($category);

        $useCase = new CreateCategoryUseCase($repository);
        $useCase->create($category);
    }

    public function testShouldCreateCategoryWithId(): void
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            id: 1
        );

        $repository = $this->createMock(CategoryRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('create')
            ->with($category);

        $useCase = new CreateCategoryUseCase($repository);
        $useCase->create($category);
    }
}
