<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tbl_mkz_luftspalt extends Model
{
    public $timestamps = false;
    protected $table = 'Tbl_mkz_luftspalt';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','B1_SO','B1_SU','B1_SL','B2_SO','B2_SU','B2_SL'];

    
    

    
}
 	

          