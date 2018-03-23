<?php

namespace App\Models;

class Bag extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'num'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function product ()
    {
        return $this->belongsTo(Product::class);
    }
}
