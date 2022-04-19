<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected $guarded = [];

    public function presentPrice(){
        return number_format($this->price).'円';
    }

    public function scopeMightAlsoLike($query){
        return $query->inRandomOrder()->take(4);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
