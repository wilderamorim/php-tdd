<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function test_if_cart_is_array_of_products(): void
    {
        $product = new \App\Product();
        $product->setName('Fallout 4');
        $product->setSlug('fallout-4');
        $product->setPrice(59.99);

        $cart = new \App\Cart();
        $cart->addProduct($product);

        $this->assertInstanceOf('App\Product', $cart->getProducts()[0]);
    }

    public function test_if_cart_has_products(): void
    {
        $product = new \App\Product();
        $product->setName('Fallout 4');
        $product->setSlug('fallout-4');
        $product->setPrice(59.99);

        $cart = new \App\Cart();
        $cart->addProduct($product);

        $this->assertCount(1, $cart->getProducts());
    }

    public function test_if_cart_has_products2(): void
    {
        $product = new \App\Product();
        $product->setName('Fallout 4');
        $product->setSlug('fallout-4');
        $product->setPrice(59.99);

        $product2 = new \App\Product();
        $product2->setName('Fallout 76');
        $product2->setSlug('fallout-76');
        $product2->setPrice(19.99);

        $cart = new \App\Cart();
        $cart->addProduct($product);
        $cart->addProduct($product2);

        $this->assertCount(2, $cart->getProducts());
    }

    public function test_total_price_of_cart(): void
    {
        $product = $this->createMock(\App\Product::class);
        $product->method('getPrice')->willReturn(59.99);

        $product2 = $this->createMock(\App\Product::class);
        $product2->method('getPrice')->willReturn(19.99);

        /*
        $product = new \App\Product();
        $product->setPrice(59.99);

        $product2 = new \App\Product();
        $product2->setPrice(19.99);
        */

        $cart = new \App\Cart();
        $cart->addProduct($product);
        $cart->addProduct($product2);

        $this->assertEquals(79.98, $cart->getTotalPrice());
    }
}
