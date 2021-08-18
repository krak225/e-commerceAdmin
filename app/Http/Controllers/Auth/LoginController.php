<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
        $this->middleware('guest')->except('logout');
		
		// $this->testLogin();
		
    }
	
	
	public function testLogin()
	{
		 $user = new User;
		 $user->nom = 'Admin';
		 $user->prenoms = 'Web';
		 $user->email = 'admin@revision.ci';
		 $user->password = Hash::make('12345678');

		 // if ( ! ($user->save()))
		 // {
			 // dd('user is not being saved to database properly - this is the problem');          
		 // }

		 if ( ! (Hash::check('12345678', Hash::make('12345678'))))
		 {
			 dd('hashing of password is not working correctly - this is the problem');          
		 }

		 if ( ! (Auth::attempt(array('email' => 'admin@revision.ci', 'password' => '12345678'))))
		 {
			 dd('storage of user password is not working correctly - this is the problem');          
		 }

		 else
		 {
			 dd('everything is working when the correct data is supplied - so the problem is related to your forms and the data being passed to the function');
		 }
	}

	
    //Added on 27032019:Permettre de mettre à jour la date de dernière connexion
	function authenticated(Request $request, $user)
    {
		
		$u = User::find($user->id);
		
		$u->statut_connexion 		= 'CONNECTE';
		$u->date_derniere_connexion = date('Y-m-d H:i:s');
		$u->ip_derniere_connexion 	= $request->getClientIp();
		$u->exists = true;
		$u->save();
		
		
		/*
        $user->update([
            'statut_connexion'=>'CONNECTE',
            'date_derniere_connexion' => date('Y-m-d H:i:s'),
            'ip_derniere_connexion' => $request->getClientIp()
        ]);
		*/
		
        Auth::user()->password="";
        Auth::user()->remember_token="";
		
    }

	
}
