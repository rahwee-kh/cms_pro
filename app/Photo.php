<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $fillable = ['file'];

    protected $upload = '/images/';

    public function getFileAttribute($photo){

        return $this->upload.$photo;
    }

}
