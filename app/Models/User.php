<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $with = [
        'bag'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments ()
    {
        return $this->hasMany(Comment::class);
    }

    public function bag ()
    {
        return $this->hasMany(Bag::class);
    }
}
