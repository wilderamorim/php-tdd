<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleUnitTest extends TestCase
{
    public function testHello()
    {
        $example = new \App\Example();
        $this->assertEquals('Hello, World!', $example->hello());
    }
}
