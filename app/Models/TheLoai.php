<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table= 'TheLoai';
    public function loaitin()
    {
        return $this->hasMany('App\Models\LoaiTin','idTheLoai','id');
    }

    public function tintuc()
    {
        return $this->hasManyThrough('App\Models\TinTuc','App\Models\LoaiTin','idTheLoai','IdLoaiTin','id');
    }
}
