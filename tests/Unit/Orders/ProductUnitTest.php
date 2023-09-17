<?php

namespace Tests\Unit\Orders;

use App\Orders\Product;
use PHPUnit\Framework\TestCase;

class ProductUnitTest extends TestCase
{
    public function testProductHasName()
    {
        $product = new Product(
            name: 'Fallout 4',
            price: 59
        );
        $this->assertEquals('Fallout 4', $product->name());
    }

    public function testProductHasPrice()
    {
        $product = new Product(
            name: 'Fallout 4',
            price: 59
        );
        $this->assertEquals(59, $product->price());
    }
}
