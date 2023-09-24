<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase
{
    protected function assertPreConditions(): void
    {
        $this->assertTrue(
            class_exists('App\Select'),
            "Class App\Select does not exist"
        );
    }

    protected function setUp(): void
    {
        $this->select = new \App\Select('products');
    }

    public function test_select_query(): void
    {
        $expected = "SELECT * FROM products";

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_select_query_with_where(): void
    {
        $expected = "SELECT * FROM products WHERE id = :id";
        $this->select->where('id', '=', ':id');

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_select_query_with_multiple_where(): void
    {
        $expected = "SELECT * FROM products WHERE id = :id AND name = :name";
        $this->select
            ->where('id', '=', ':id')
            ->where('name', '=', ':name');

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_if_has_order_by(): void
    {
        $expected = "SELECT * FROM products ORDER BY name ASC";
        $this->select->orderBy('name');

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_if_has_limit(): void
    {
        $expected = "SELECT * FROM products LIMIT 10, 0";
        $this->select->limit(10);

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_if_has_limit_and_offset(): void
    {
        $expected = "SELECT * FROM products LIMIT 10, 5";
        $this->select->limit(10, 5);

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_if_has_join(): void
    {
        $expected = "SELECT * FROM products INNER JOIN categories ON products.category_id = categories.id";
        $this->select->join('INNER JOIN', 'categories', 'products.category_id', '=', 'categories.id');

        $this->assertEquals($expected, $this->select->getQuery());
    }

    public function test_if_has_multiple_join(): void
    {
        $expected = "SELECT * FROM products INNER JOIN categories ON products.category_id = categories.id INNER JOIN users ON products.user_id = users.id";
        $this->select
            ->join('INNER JOIN', 'categories', 'products.category_id', '=', 'categories.id')
            ->join('INNER JOIN', 'users', 'products.user_id', '=', 'users.id');

        $this->assertEquals($expected, $this->select->getQuery());
    }
}
