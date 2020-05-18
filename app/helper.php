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
