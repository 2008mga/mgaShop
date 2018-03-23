<?php

namespace App\Models\Traits;

use App\Models\Characteristicable;

trait HasCharacteristic
{
    public function characteristicable ()
    {
        return $this->morphToMany(Characteristicable::class, 'characteristicable', 'characteristicables', 'characteristicable_id', 'characteristicable_id');
    }

    public function getCharacteristicsAttribute ()
    {
        return Characteristicable::query()
            ->where('characteristicable_id', $this->id)
            ->where('characteristicable_type', self::class)
            ->with('characteristic')
            ->get();
    }
}