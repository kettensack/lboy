<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tbl_mkz_haken extends Model
{
    public $timestamps = false;
    protected $table = 'Tbl_mkz_haken';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','dez_hakenmaul','dez_hakengrund'];

    
    

    
}
 	

          