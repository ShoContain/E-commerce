<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //laptop
        for ($i = 1; $i<=30; $i++) {
            Product::create([
                'name'=>"Laptop ".$i,
                'slug'=>'laptop-'.$i,
                'details'=>['13','14','15'][array_rand(array('13','14','15'))].'inch,1TB SSD,32GB RAM',
                'price'=>rand(149999,249999),
                'featured'=>rand(0,1),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(1);
        }
        $product = Product::find(1);
        $product->categories()->attach(2);

        //desktop
        for ($i = 1; $i <=9; $i++) {
            Product::create([
                'name'=>"Desktop ".$i,
                'slug'=>'desktop-'.$i,
                'details'=>['24','27','32'][array_rand(array('24','27','32'))].'inch,1TB SSD,32GB RAM',
                'price'=>rand(249999,449999),
                'featured'=>rand(0,1),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(2);
        }

        //tablet
        for ($i = 1; $i <=9; $i++) {
            Product::create([
                'name'=>"Tablet ".$i,
                'slug'=>'tablet-'.$i,
                'featured'=>rand(0,1),
                'details'=>['16','32','64'][array_rand(['16','32','64'])].'GB'.['7','8','9'][array_rand(array('7','8','9'))].'inch,RAM',
                'price'=>rand(50000,80000),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(3);
        }

        //phone
        for ($i = 1; $i <=9; $i++) {
            Product::create([
                'name'=>"Phone ".$i,
                'slug'=>'phone-'.$i,
                'details'=>['16','32','64'][array_rand(['16','32','64'])].'GB'.['7','8','9'][array_rand(array('7','8','9'))].'inch,RAM',
                'price'=>rand(15000,20000),
                'featured'=>rand(0,1),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(4);
        }

        //appliance
        for ($i = 1; $i <=9; $i++) {
            Product::create([
                'name'=>"Appliance ".$i,
                'slug'=>'appliance-'.$i,
                'details'=>'Lorem10 losod dkdkedkf',
                'price'=>rand(1800,10000),
                'featured'=>rand(0,1),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(5);
        }

        //tv
        for ($i = 1; $i <=9; $i++) {
            Product::create([
                'name'=>"Tv ".$i,
                'slug'=>'tv-'.$i,
                'details'=>['32','40','50'][array_rand(array('32','40','50'))].'インチ',
                'price'=>rand(1800,10000),
                'featured'=>rand(0,1),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(6);
        }

        //camera
        for ($i = 1; $i <=9; $i++) {
            Product::create([
                'name'=>"Camera ".$i,
                'slug'=>'camera-'.$i,
                'details'=>['32','40','50'][array_rand(array('32','40','50'))].'インチ',
                'price'=>rand(1800,10000),
                'featured'=>rand(0,1),
                'description'=>'Lorem ipsum'.$i.'dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis eos fugiat, itaque nulla quas. Autem nam non sint?'
            ])->categories()->attach(7);
        }

    }
}

