<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\softDeletes;

class Tbl_stammdaten extends Model
{
    use Sortable;
    use SoftDeletes;
    
    protected $table = 'tbl_stammdaten';
    protected  $primaryKey = 'id_liftboy';
    // protected $fillable = ['cbx_bremse1','cbx_bremse2','cbx_kupplung','cbx_kfp','cbx_dichtung1','cbx_dichtung2','txt','txt_chain','warnung','cbx_haken_service','cbx_bbelag1','cbx_bbelag2','cbx_kbelag','cbx_kf_service','cbx_kontakte','cbx_kupplung_service','cbx_haken_ufo','cbx_stopper_ufo','B1_SO','B1_SU','B1_SL','B2_SO','B2_SU','B2_SL'];
    
        
    public $sortable = ['id_club','id_liftboy','snnr','baujahr','id_artikel','id_kunde','abgang_me','abgang_oe','aktiv','doppelstrang','ueberlaenge','comment','deleted_at']; 

    public function MkzEvents() {
        return $this->hasMany('App\Tbl_mkz_events','id_liftboy','id_liftboy');
        
    }
    public function lastMkzEvents()
    {
        return $this->hasMany('App\Tbl_mkz_events', 'id_liftboy','id_liftboy')->latest('created_at');
    }
    public function artikel()
    {
        return $this->hasMany('App\Tbl_article', 'id_artikel','id_artikel');
    }
    public function events()
    {
        return $this->hasMany('App\Tbl_events', 'id_liftboy','id_liftboy');
    }
    
    

    // SoftDeletes;Falls ausschließlich gelöschte Objekte abgefragt werden sollen, geht das analog dazu über ->onlyTrashed().
    // SoftDeletes;Ein per softDeletes gelöschtes Objekt kann mit ->restore() wiederhergestellt werden.
    // SoftDeletes;Wenn ein Eintrag nun aber endgültig aus der Datenbank gelöscht werden soll, kann die ->forceDelete() auf dem Objekt verwendet werden.
}
	
