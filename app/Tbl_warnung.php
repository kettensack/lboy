<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tbl_warnung extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_warnung';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','warnung'];
    

    
}
 	

          