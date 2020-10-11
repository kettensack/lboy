<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\softDeletes;

class Tbl_sv extends Model
{
    use Sortable;
    use SoftDeletes;
    
    
    public $timestamps = false;
    protected $table = 'tbl_sv';
    protected  $primaryKey = 'id_event';
    protected $fillable = ['id_event','id_expert'];
    

    
}
 	

          