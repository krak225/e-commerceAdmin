<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Course extends Model
{
    //
	protected $table = 'dim_course';
	protected $primaryKey = 'course_id';
	public $timestamps = false;

}
