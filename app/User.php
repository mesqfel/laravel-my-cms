<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{

    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function role(){

        return $this->belongsTo('App\Role');

    }

    public function photo(){

        return $this->belongsTo('App\Photo');

    }

    public function isAdmin(){

        if($this->role->name === 'Admin'){
            return true;
        }

        return false;
    }

    public function posts(){

        return $this->hasMany('App\Post');

    }

}
