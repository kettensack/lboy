<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tbl_events extends Model
{
    // use Sortable;
    // use Carbon\Carbon;
    protected $table = 'tbl_events';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','id_liftboy','id_user','id_eventtyp','deleted_at','updated_at','created_at'];
    
        
    // public $sortable = ['baujahr','id_liftboy','pruefer','Traglast',]; 
    
    public function quartal()
      {
          
           return Carbon::$this->created_at->quarter;

           // $a = Carbon::now();
        // $a->month($a->month);
        // $Quarter = $a->quarter;
        
        // $date = new \Carbon\Carbon('-3 months');
        // $firstOfQuarter = $date->firstOfQuarter();
        // $lastOfQuarter = $date->lastOfQuarter();
      } 
      public function stamm() {
        return $this->hasOne('App\Tbl_stammdaten', 'id_liftboy','id_liftboy');
    }
    public function allMkzEvents() {
        return $this->hasOne('App\Tbl_mkz_events', 'id_test','id_event');
    }
    public function neustes()
    {
        return $this->hasOne('App\Tbl_events', 'id_liftboy')->latest('created_at');
    }
    

    
}
 	

          