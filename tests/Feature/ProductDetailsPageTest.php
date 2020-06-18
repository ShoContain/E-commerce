<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductDetailsPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_product_details()
    {
        factory(Product::class)->create([
            'name'=>'Laptop 1',
            'slug'=>'laptop-1',
            'details'=>'17inch 1TB',
            'description'=>'details zone',
            'price'=>2333
        ]);

        $response = $this->get('/shop/laptop-1');
        $response->assertSee('Laptop 1');
        $response->assertSee('17inch 1TB');
        $response->assertSee('details zone');
        $response->assertSee('2,333円');

        $response->assertDontSee('Laptop 3');
        $response->assertDontSee('2,339円');
    }
}
