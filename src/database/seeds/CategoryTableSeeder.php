<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Category::insert([
           ['name'=>'ノートパソコン','slug'=>'laptops','created_at'=>$now,'updated_at'=>$now],
           ['name'=>'デスクトップパソコン','slug'=>'desktops','created_at'=>$now,'updated_at'=>$now],
           ['name'=>'タブレット','slug'=>'tablets','created_at'=>$now,'updated_at'=>$now],
           ['name'=>'スマホ','slug'=>'mobile-phones','created_at'=>$now,'updated_at'=>$now],
           ['name'=>'電化製品','slug'=>'appliances','created_at'=>$now,'updated_at'=>$now],
           ['name'=>'テレビ','slug'=>'tv','created_at'=>$now,'updated_at'=>$now],
           ['name'=>'カメラ','slug'=>'camera','created_at'=>$now,'updated_at'=>$now],
        ]);
    }
}
