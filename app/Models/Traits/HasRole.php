<?php namespace App\Models\Traits;

use App\Models\Role;

trait HasRole {

    protected $fillable = [];

    public function __construct()
    {
        if (!in_array('role_id', $this->fillable)) {
            $this->fillable[] = 'is_admin';
        }

    }

    public function isRole($role)
    {
        $role = $this->role;
        return $role->name === $role;
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

}
