<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShopPageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function shop_page_loads_correctly()
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
        $response->assertSee('オススメ');
    }

    /** @test */
    public function show_only_featured_product()
    {
        $featuredProduct = factory(Product::class)->create([
            'featured'=>true,
            'price'=>12343,
        ]);

        $response = $this->get('/shop');
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
        $response = $this->get('/show');
        $response->assertDontSee($featuredProduct->name);
        $response->assertDontSee('12,343円');
    }

    /** @test */
    public function shop_pagination_correctly()
    {
        //1ページ目
        for ($i = 1; $i <=9; $i++) {
           factory(Product::class)->create([
                'featured'=>true,
                'name'=>'Laptop'.$i,
           ]);
        }

        //2ページ目
        for ($i = 10; $i <= 18; $i++) {
            factory(Product::class)->create([
                'featured'=>true,
                'name'=>'Laptop'.$i,
            ]);
        }
        $response = $this->get('/shop?page=2');
        $response->assertSee('Laptop10');
        $response->assertSee('Laptop18');
        $response->assertDontSee('Laptop9');

    }

    /** @test */
    public function sort_products_correctly()
    {
        for ($i = 1; $i <= 20; $i++) {
            factory(Product::class)->create([
                'featured'=>true,
                'price'=>$i,
                'name'=>'Laptop'.$i
            ]);
        }
        //値段低い順
        $response = $this->get('/shop?sort=low_high');
        $response->assertSee('Laptop3');
        $response->assertDontSee('Laptop20');
        $response->assertSeeInOrder(['Laptop3','Laptop5','Laptop8']);

        //値段高い順
        $response = $this->get('/shop?sort=high_low');
        $response->assertDontSee('Laptop3');
        $response->assertSee('Laptop20');
        $response->assertSeeInOrder(['Laptop20','Laptop15','Laptop12']);
    }

    /** @test */
    public function show_category_page_correctly()
    {
        $laptop1=factory(Product::class)->create(['name'=>'Laptop 1']);
        $laptop2=factory(Product::class)->create(['name'=>'Laptop 2']);

        $categoryForLaptop = Category::create([
            'name'=>'laptops',
            'slug'=>'laptops',
        ]);

        $laptop1->categories()->attach($categoryForLaptop->id);
        $laptop2->categories()->attach($categoryForLaptop->id);

        $camera1=factory(Product::class)->create(['name'=>'Camera 1']);
        $camera2=factory(Product::class)->create(['name'=>'Camera 2']);

        $categoryForCamera = Category::create([
            'name'=>'camera',
            'slug'=>'camera',
        ]);

        $camera1->categories()->attach($categoryForCamera->id);
        $camera2->categories()->attach($categoryForCamera->id);

        $response = $this->get('/shop?category=camera');
        $response->assertSee('Camera 1');
        $response->assertSee('Camera 2');
        //LaptopはCameraカテゴリーでは見れない
        $response->assertDontSee('Laptop 1');
        $response->assertDontSee('Laptop 2');
    }
}
