<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    protected $helloWorld;

    protected function setUp(): void
    {
        $this->helloWorld = new \App\HelloWorld();
    }

    public function test_if_class_exists(): void
    {
        $this->assertTrue(class_exists('App\HelloWorld'));
    }

    public function test_if_class_has_method(): void
    {
        $this->assertTrue(method_exists('App\HelloWorld', 'sayHello'));
    }

    public function test_if_say_hello_returns_string(): void
    {
        $this->assertIsString($this->helloWorld->sayHello());
    }

    public function test_if_say_hello_returns_correct_string(): void
    {
        $this->assertEquals('Hello, World!', $this->helloWorld->sayHello());
    }
}
