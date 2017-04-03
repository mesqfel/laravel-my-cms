<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	private $_imgPath = '/images/';

    protected $fillable = [
        'path'
    ];

    public function getPathAttribute($value){
        
        if($value){
        	return $this->_imgPath.$value;
        }
        else{
        	return '';
        }

    }

}
