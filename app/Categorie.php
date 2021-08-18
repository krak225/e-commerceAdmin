<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categorie extends Model
{
    //
	protected $table = 'categorie';
	protected $primaryKey = 'categorie_id';
	public $timestamps = false;

}
