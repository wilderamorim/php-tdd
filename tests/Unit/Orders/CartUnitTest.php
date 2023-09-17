<?php

namespace Tests\Unit\Orders;

use App\Orders\{Cart, Product};
use PHPUnit\Framework\TestCase;

class CartUnitTest extends TestCase
{
    public function testAnItemCanBeAddedToTheCart()
    {
        $cart = new Cart();

        $cart->add(new Product(
            name: 'Fallout 4',
            price: 59
        ));

        $this->assertCount(1, $cart->all());
    }

    public function testAnItemCanBeRemovedFromTheCart()
    {
        $cart = new Cart();

        $cart->add(new Product(
            name: 'Fallout 4',
            price: 59
        ));

        $cart->add(new Product(
            name: 'Pillowcase',
            price: 25
        ));

        $this->assertCount(2, $cart->all());

        $cart->remove(1);

        $this->assertCount(1, $cart->all());
    }

    public function testItemsInTheCartCanBeViewed()
    {
        $cart = new Cart();

        $cart->add(new Product(
            name: 'Fallout 4',
            price: 59
        ));

        $this->assertCount(1, $cart->all());
        $this->assertEquals('Fallout 4', $cart->all()[0]->name());
    }

    public function testItCanGetTheTotalPriceOfAllItemsInTheCart()
    {
        $cart = new Cart();

        $cart->add(new Product(
            name: 'Fallout 4',
            price: 59
        ));

        $cart->add(new Product(
            name: 'Pillowcase',
            price: 25
        ));

        $this->assertEquals(84, $cart->total());
    }
}
