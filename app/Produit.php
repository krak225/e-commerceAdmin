<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Produit extends Model
{
    //
	protected $table = 'produit';
	protected $primaryKey = 'produit_id';
	public $timestamps = false;

}
