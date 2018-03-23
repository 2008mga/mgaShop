<?php

namespace App\Models;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'product_id',
        'user_id'
    ];

    protected $visible = [
        'created_at',
        'updated_at',
        'comment',
        'user',
        'product'
    ];

    protected $with = [
        'user',
        'product'
    ];

    protected $casts = [
        'created_at' => 'datetime'
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
