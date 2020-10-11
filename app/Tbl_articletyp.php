<?php
// id_artikel	INT		
// id_artikeltyp	varchar(20)	latin1_swedish_ci	
// traglast	INT		
// norm	varchar(50)	latin1_swedish_ci	
// einsatz	varchar(50)	latin1_swedish_ci	
// bez_ravel	varchar(50)	latin1_swedish_ci	
// bez_hersteller	varchar(50)	latin1_swedish_ci	
/// bez_artikeltyp	varchar(50)	latin1_swedish_ci	
// bez_mo2	varchar(50)	latin1_swedish_ci	
// deleted_at	timestamp	

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\softDeletes;

class Tbl_articletyp extends Model
{
    use Sortable;

    use SoftDeletes;
    
    protected $table = 'tbl_article_typ';

    // protected  $primaryKey = 'id_artikeltyp';

    // protected $fillable = [''];
    
        
    public $sortable = ['id_artikeltyp','bez_artikeltyp']; 

    public function jartikel() {
        // return $this->hasMany('App\Tbl_article','id_artikeltyp','id_artikeltyp');
        return $this->belongsTo(Tbl_article::class,'id_artikeltyp','id_artikeltyp');
        
    }
    

   
    // SoftDeletes;Falls ausschließlich gelöschte Objekte abgefragt werden sollen, geht das analog dazu über ->onlyTrashed().
    // SoftDeletes;Ein per softDeletes gelöschtes Objekt kann mit ->restore() wiederhergestellt werden.
    // SoftDeletes;Wenn ein Eintrag nun aber endgültig aus der Datenbank gelöscht werden soll, kann die ->forceDelete() auf dem Objekt verwendet werden.
    
}
	
