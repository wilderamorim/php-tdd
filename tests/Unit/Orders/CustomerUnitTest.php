<?php

namespace Tests\Unit\Orders;

use PHPUnit\Framework\TestCase;

class CustomerUnitTest extends TestCase
{
    public function testCustomerHasFirstName()
    {
        $customer = new \App\Orders\Customer(
            fullName: 'John Doe',
        );
        $this->assertEquals('John', $customer->firstName());
    }

    public function testCustomerHasLastName()
    {
        $customer = new \App\Orders\Customer(
            fullName: 'John Doe',
        );
        $this->assertEquals('Doe', $customer->lastName());
    }
}
