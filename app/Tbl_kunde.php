<?php
	
    // (id_kunde)
    // info
    // ort
    // strasse


namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_kunde extends Model
{
    //protected $table = 'table_name' falls abweichender table-Name
    protected $table = "tbl_kunden";
    protected $fillable = ['name','ort','strasse'];
}
