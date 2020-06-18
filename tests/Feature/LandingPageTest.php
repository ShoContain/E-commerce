<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function landing_page_loads_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('ショップサイト');
        $response->assertSee('Ecommerce');
    }

    /** @test */
    public function show_only_featured_product()
    {
        $featuredProduct = factory(Product::class)->create([
            'featured'=>true,
            'price'=>12343,
        ]);

        $response = $this->get('/');
        $response->assertSee($featuredProduct->name);
        $response->assertSee('12,343円');
        $response->assertDontSee('12,342円');
    }

    /** @test */
    public function  dont_show_non_featured_product()
    {
        $featuredProduct = factory(Product::class)->create([
            'featured'=>false,
            'price'=>12343,
        ]);
        $response = $this->get('/');
        $response->assertDontSee($featuredProduct->name);
        $response->assertDontSee('12,343円');
    }


}
