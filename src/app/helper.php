<?php

function presentPrice($price){
    return number_format($price).'円';
}

function getTax($price){
    return number_format($price*0.1).'円';
}

function setActiveCategory($category){
    return $category == request()->category ? 'active':'';
}

//imageが見つからない時はデフォルトイメージを返す
function productImage($image_path){
    return $image_path && asset('storage/'.$image_path)
        ?asset('storage/'.$image_path)
        :asset('img/not-found.png');
}
