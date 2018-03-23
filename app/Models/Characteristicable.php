<?php

namespace App\Models;

class Characteristicable extends Model
{
    protected $table = 'characteristicables';

    protected $fillable = [
        'id',
        'characteristicable_id',
        'characteristicable_type',
        'characteristic_id',
        'value'
    ];

    protected $hidden = ['characteristicable_id', 'characteristicable_type', 'characteristic_id'];

    public function characteristic ()
    {
        return $this->belongsTo(Characteristic::class, 'characteristic_id');
    }

    public function characteristicable ()
    {
        return $this->morphTo();
    }
}
