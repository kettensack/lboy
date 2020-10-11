<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Kyslik\ColumnSortable\Sortable;

class Tbl_article extends Model
{

    use Sortable;
    use SoftDeletes;
    
    protected $table = 'tbl_articles';

    protected  $primaryKey = 'id_artikel';

    protected $fillable = ['id_artikeltyp','traglast','norm','einsatz','bez_ravel','bez_hersteller','bez_mo2'];
    
        
    public $sortable = ['id_artikeltyp','traglast','norm','einsatz','bez_ravel','bez_hersteller','bez_mo2'];

    public function jstamm() {
        return $this->hasMany('App\Tbl_stammdaten','id_artikel','id_artikel');
        
    }
    public function jartikeltyp() {
        return $this->belongsTo('App\Tbl_articletyp','id_artikeltyp','id_artikeltyp');
        
        // return $this->belongsTo(Tbl_articletyp::class,'id_artikeltyp','id_artikeltyp');
        // return $this->hasMany('App\Tbl_article','id_artikeltyp','id_artikeltyp');
        
    }

   
    // SoftDeletes;Falls ausschließlich gelöschte Objekte abgefragt werden sollen, geht das analog dazu über ->onlyTrashed().
    // SoftDeletes;Ein per softDeletes gelöschtes Objekt kann mit ->restore() wiederhergestellt werden.
    // SoftDeletes;Wenn ein Eintrag nun aber endgültig aus der Datenbank gelöscht werden soll, kann die ->forceDelete() auf dem Objekt verwendet werden.
    
}
	
