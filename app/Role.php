<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    
    public function getNameAttribute($value){
        return ucfirst($value);
    }
}
