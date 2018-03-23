<?php

namespace App\Models;

class Characteristic extends Model
{
    protected $fillable = ['id', 'name'];

    public function products ()
    {
        return $this->morphedByMany(Characteristicable::class, 'characteristicable');
    }
}
