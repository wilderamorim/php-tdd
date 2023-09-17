<?php

namespace App\Orders;

class Product
{
    public function __construct(
        protected string $name,
        protected int $price
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): int
    {
        return $this->price;
    }
}
