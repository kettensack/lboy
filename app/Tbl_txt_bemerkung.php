<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tbl_txt_bemerkung extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_txt_bemerkung';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','txt'];
    

    
}
 	

          