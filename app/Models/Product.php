<?php

namespace App\Models;

use App\Models\Traits\HasCharacteristic;

class Product extends Model
{
    use HasCharacteristic;

    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'images',
        'category_id',
        'price'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    protected $appends = [
        'characteristics'
    ];

    protected static function boot()
    {
        self::created(function (Product $product) {
           $category = $product->category;
           $category->num_of_products += 1;
           $category->save();

           return $product;
        });

        self::deleting(function (Product $product) {
            $category = $product->category;
            $category->num_of_products -= 1;
            $category->save();

            return $product;
        });

        parent::boot();
    }


    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');
    }
}
