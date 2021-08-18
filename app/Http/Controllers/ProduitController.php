<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourrierFormRequest;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Carbon\Carbon;
use App\User; 
use App\Produit;
use DB;
use Stdfn;


class ProduitController extends Controller
{
  
    //
	public function __construct()
    {
        $this->middleware('auth');
		
		
		Carbon::setLocale('fr');
		
    }
	
	

}


