<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table      = "tb_profil";    
    protected $primaryKey = "ProfilID";    
    public $timestamps    = false;
}
