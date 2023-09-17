<?php

namespace App\Orders;

class Customer
{
    public function __construct(
        protected string $fullName,
    ) {
    }

    public function firstName(): string
    {
        return explode(' ', $this->fullName)[0];
    }

    public function lastName(): string
    {
        return explode(' ', $this->fullName)[1];
    }
}
