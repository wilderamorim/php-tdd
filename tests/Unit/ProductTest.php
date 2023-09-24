<?php

namespace Tests\Unit;

use App\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected Product $product;

    public function setUp(): void
    {
        $this->product = new Product();
    }

    public function test_if_product_has_name(): void
    {
        $this->product->setName('Fallout 4');

        $this->assertEquals('Fallout 4', $this->product->getName());
    }

    public function test_if_product_has_slug(): void
    {
        $this->product->setSlug('fallout-4');

        $this->assertEquals('fallout-4', $this->product->getSlug());
    }

    public function test_if_product_has_price(): void
    {
        $this->product->setPrice(59.99);

        $this->assertEquals(59.99, $this->product->getPrice());
    }
}