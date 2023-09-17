<?php

namespace App\Category;

class Category
{
    public function __construct(
        private string $name,
        private string $description,
        private ?int $id = null
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Category
    {
        return new Category(
            $name,
            $this->description,
            $this->id
        );
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Category
    {
        return new Category(
            $this->name,
            $description,
            $this->id
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
