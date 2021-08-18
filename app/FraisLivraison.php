<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FraisLivraison extends Model
{
    //
	protected $table = 'dim_frais_livraison';
	protected $primaryKey = 'frais_livraison_id';
	public $timestamps = false;

}
