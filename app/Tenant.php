<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function staff()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function route($name, $parameters = [], $absolute = false) 
    {
               
        return app('url')->route($name, array_merge([$this->id], $parameters), $absolute);
    }
}
