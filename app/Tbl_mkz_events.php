<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Tbl_mkz_events extends Model
{
    use Sortable;
    
    protected $table = 'tbl_mkz_events';
    protected  $primaryKey = 'id_liftboy';
    protected $fillable = ['id_test', 'cbx_bremse1','cbx_bremse2','cbx_kupplung','cbx_kfp','cbx_dichtung1','cbx_dichtung2','cbx_haken_service','cbx_bbelag1','cbx_bbelag2','cbx_kbelag','cbx_kf_service','cbx_kontakte','cbx_kupplung_service','cbx_haken_ufo','cbx_stopper_ufo'];
    
        
    public $sortable = ['id_test', 'cbx_bremse1','cbx_bremse2','cbx_kupplung','cbx_kfp','cbx_dichtung1','cbx_dichtung2','cbx_haken_service','cbx_bbelag1','cbx_bbelag2','cbx_kbelag','cbx_kf_service','cbx_kontakte','cbx_kupplung_service','cbx_haken_ufo','cbx_stopper_ufo']; 

    public function stamm() {
        return $this->hasOne('App\Tbl_stammdaten', 'id_liftboy','id_liftboy');
    }
    
    
    public function neustes($id)
    {
        return $id->latest('created_at');
    }
    public function allEvents() {
        return $this->belongsTo('App\Tbl_events','id_event', 'id_test');
    }
    public function artikel()
    {
        return $this->belongsTo('App\Tbl_article','id_article', 'id_artikel');
    }
}
           