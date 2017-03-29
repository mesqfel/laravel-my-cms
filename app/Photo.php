<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path'
    ];

    private $_imgPath = '/images/users/';


    public function getPathAttribute($value){

    	if($value){
    		return $this->_imgPath.$value;	
    	}
    	else
    		return '';

    }




}
