<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Commune extends Model
{
    //
	protected $table = 'dim_commune';
	protected $primaryKey = 'commune_id';
	public $timestamps = false;

}
