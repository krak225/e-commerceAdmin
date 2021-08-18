<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RequestData extends Model
{
    //
	protected $table = 'tb_request';
	protected $primaryKey = 'request_id';
	public $timestamps = false;
	
}
