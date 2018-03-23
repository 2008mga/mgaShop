<?php

namespace App\Models;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'num_of_products'
    ];

    protected $casts = [
        'num_of_products'
    ];

    protected $appends = [ 'products_paginate' ];

    public function products ()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getProductsPaginateAttribute ()
    {
        return $this->products()->simplePaginate(15);
    }
}
