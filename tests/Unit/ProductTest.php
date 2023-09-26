<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_calculate_product_has_no_pack_price(){

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 10,
            'three_pack_price' => 0,
            'five_pack_price' => 0,
        ]);

        $price = $product->calculate(1);
        $this->assertEquals(10, $price);

        $price = $product->calculate(2);
        $this->assertEquals(20, $price);

        $price = $product->calculate(6);
        $this->assertEquals(60, $price);

        $price = $product->calculate(20);
        $this->assertEquals(200, $price);
    }

    public function test_calculate_product_has_pack_price(){

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 10,
            'three_pack_price' => 25,
            'five_pack_price' => 40,
        ]);

        $price = $product->calculate(1);
        $this->assertEquals(10, $price);

        $price = $product->calculate(3);
        $this->assertEquals(25, $price);

        $price = $product->calculate(5);
        $this->assertEquals(40, $price);

        $price = $product->calculate(9);
        $this->assertEquals(75, $price);

        $price = $product->calculate(10);
        $this->assertEquals(80, $price);

        $price = $product->calculate(14);
        $this->assertEquals(115, $price);
    }
}
