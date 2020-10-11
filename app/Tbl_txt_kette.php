<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tbl_txt_kette extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_txt_kette';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','txt_chain'];
    

    
}
 	

          