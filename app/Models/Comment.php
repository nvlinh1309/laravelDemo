<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table= 'Comment';
    public function tintuc()
    {
        return $this->belongsTo('App\Models\TinTuc','idTinTuc','id');
    }
    public function user(){
        //Một comment thuộc một user
        return $this->belongsTo('App\Models\User','idUser','id');
    }
     
}
