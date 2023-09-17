<?php

namespace App\Orders;

class Cart
{
    /**
     * @var Product[]
     */
    protected array $items = [];

    public function add(Product $product): void
    {
        $this->items[] = $product;
    }

    public function remove(int $key): void
    {
        unset($this->items[$key]);
    }

    public function all(): array
    {
        return $this->items;
    }

    public function total(): int
    {
        return array_reduce($this->items, fn (mixed $carry, Product $item): int => $carry + $item->price());
    }
}
