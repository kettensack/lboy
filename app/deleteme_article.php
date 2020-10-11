<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class article extends Model
{
    //protected $table = 'table_name' falls abweichender table-Name
    use SoftDeletes;
    protected $table = "article";
    protected $fillable = ['name','id_club','abgangMitErl','abgangOhneErl'];
    
}
