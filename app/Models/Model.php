<?php namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model {
    protected $globalFillable = [
        'id',
        'created_at',
        'updated_at'
    ];

    private $globalHidden = [];

    public function __construct(array $attributes = [])
    {
        $this->hidden = array_except(array_merge($this->hidden, $this->globalHidden), $this->visible);
        $this->fillable = array_merge($this->fillable, $this->globalFillable);
        parent::__construct($attributes);
    }

    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        return collect($attributes)->filter(function ($value, $key) {
            return !is_null($value);
        })->toArray();
    }
}