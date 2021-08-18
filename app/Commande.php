<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Commande extends Model
{
    //
	protected $table = 'commande';
	protected $primaryKey = 'commande_id';
	public $timestamps = false;

}
