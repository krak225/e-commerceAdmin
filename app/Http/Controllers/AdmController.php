<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ElecteurFormRequest;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Http\Requests\UpdatePasswordFormRequest;
use App\User;
use App\Prospecteur;
use App\Bureau;
use App\Electeur;
use App\Profil;
use App\LieuDeVote;
use App\UserLieuDeVote;
use App\Perception;
use App\Equipe;
use DB;
use Hash;


class AdmController extends Controller
{
  
    //
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
		
    }
	
	
	
	public function utilisateurs(){
		
		$users 	= User::where(['statut'=>'VALIDE'])
					->join('tb_profil','tb_users.profil_id','tb_profil.profil_id')
					->LeftJoin('tb_bureau','tb_users.bureauID','tb_bureau.bureau_id')
					->get()
					->sortBy('nom');
		
		//dd($users);
		
		return view('utilisateurs',['users'=>$users]);
		
	}
	
	public function DetailsUtilisateur($id){
		
		$user 	= User::find($id);
		
		$bureaux = Bureau::where('bureau_id',$user->bureauID)->get();
		
		$sql = 'select date(pointage_date) as date, id, nom, prenoms, email, pointage_id, pointage_arrivee, pointage_depart, TIMEDIFF(pointage_arrivee , concat(date(pointage_arrivee)," 08:00")) as temps_retard from users inner join tb_pointage on tb_pointage.user_id = users.id 
		where statut="VALIDE"
		AND users.id = "'.$id.'"
		AND time(pointage_arrivee) > "08:00"
		group by date(pointage_date), id
		';
		
		$retardataires = DB::select($sql);
		
		$absences = array();
		
		return view('details_utilisateur',['user'=>$user, 'bureaux'=>$bureaux, 'retardataires'=>$retardataires, 'absences'=>$absences]);
		
	}
	
	
	public function DetailsProspecteur($id){
		
		$user 	= Prospecteur::find($id);
		
		$bureaux = Bureau::where('bureau_id',$user->bureauID)->get();
		
		
		$retardataires = [];
		
		$absences = array();
		
		return view('details_prospecteur',['user'=>$user, 'bureaux'=>$bureaux, 'retardataires'=>$retardataires, 'absences'=>$absences]);
		
	}
	
	
	public function statistiques(){
		
		$statistiques	 			= Perception::getStatistiques();
		
		$chart_gains = Perception::StatistiquesGetGains();
		$tabMois = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
		
		$mois_annee = ' de '. $tabMois[gmdate('m') - 1].' '. gmdate('Y');
		 
		
		return view('statistiques',['mois_annee'=>$mois_annee, 'statistiques'=>$statistiques, 'chart_gains'=>$chart_gains]);
		
	}
	
	
	public function utilisateur(){
		
		$bureaux 	= Bureau::all()->sortBy('bureauLibelle');
		$coordonnateurs 	= User::where('profil_id',3)->get()->sortBy('nom');
		$ddcs 				= User::where('profil_id',2)->get()->sortBy('nom');
		$profils 			= Profil::where('profil_statut','VALIDE')->get()->sortBy('profil_libelle');
		// dd($profils);
		
		
		return view('utilisateur',['bureaux'=>$bureaux, 'coordonnateurs'=>$coordonnateurs,  'ddcs'=>$ddcs, 'profils'=>$profils]);
		
	}
	
	
	public function SaveUtilisateur(UserFormRequest $request){
		
		
		$user =  new User();
		
		// $user->groupesaisieID 		= 1;
		$user->bureauID 	= $request->bureau_id;
		$user->nom 					= $request->nom;
		$user->prenoms 				= $request->prenoms;
		$user->telephone 			= $request->telephone;
		$user->profil_id 			= $request->profil_id;
		$user->email 				= $request->email;
		// $user->password 			= Hash::make($request->password);
		$user->password 			= $request->password;
	
		
		$user->save();
	
		return back()
			->with('message', "LE COMPTE A ÉTÉ CRÉE AVEC SUCCÈS");

					
	}
	
	
	
	public function modifier_utilisateur($id){
		
		$user 	= User::find($id);
		
		$bureaux 	= Bureau::all()->sortBy('bureauLibelle');
		$equipes 	= Equipe::all()->sortBy('equipe_nom');
		$coordonnateurs 	= User::where('profil_id',3)->get()->sortBy('nom');
		$ddcs 				= User::where('profil_id',2)->get()->sortBy('nom');
		$profils 			= Profil::where('profilStatut','VALIDE')->get()->sortBy('profilLibelle');
		
		return view('modifier_utilisateur',['equipes'=>$equipes, 'user'=>$user, 'profils'=>$profils, 'bureaux'=>$bureaux,'coordonnateurs'=>$coordonnateurs, 'ddcs'=>$ddcs]);
		
	}
	
	public function ModifierUtilisateur(UpdateUserFormRequest $request, $id){
		
		$user 	= User::find($id);
		// $user->nom = $request->nom;
		// $user->prenoms = $request->prenoms;
		$user->telephone = $request->telephone;
		// $user->bureauID = $request->bureau_id;
		$user->equipe_id = intval($request->equipe_id);
		// $user->password = Hash::make($request->password);
		
		$option_modifier_motdepasse = $request->option_modifier_motdepasse;
		
		if($option_modifier_motdepasse == 1 && !empty($request->password)){
		
			if($request->password == $request->password_confirmation){
				
				$user->password = Hash::make($request->password);
				
			}else{
				
				return back()
					->with('warning', "LES DEUX MOTS DE PASSE NE SONT PAS IDENTIQUES");

			}
		}
		
		$user->exists = true;
		$user->save();
		
		// dd($user);
		return back()
			->with('message', "LE COMPTE A ÉTÉ MODIFIÉ AVEC SUCCÈS");

			
	}
	
	
	
	
	public function AddUserLieuDeVote(Request $request){
		
		
		$userLv =  new UserLieuDeVote();
		
		$userLv->userID 				= $request->user_id;
		$userLv->lieuDeVoteID 			= $request->lieudevote_id;
		$userLv->UserLieuDeVoteStatut 	= 'VALIDE';
		
		$userLv->save();
	
		return back()
			->with('message', "OPÉRATION EFFECTUÉE AVEC SUCCÈS");

					
	}
	
	
	
	public function RetirerUserLieuDeVote(Request $request){
		
		$lieuDeVoteID 	= $request->lieudevote_id;
		$userID 		= $request->user_id;
		
		UserLieuDeVote::where(['lieuDeVoteID'=>$lieuDeVoteID, 'userID'=>$userID])->delete();
		
		
		echo 1;
					
	}
	
	

	
    public function Perceptions(Request $request)
    {
		
		$bureauID  = $request->b;
		$user_id    = $request->u;
		$date_debut = !empty($request->db) ? $request->db : date('Y-m-d');
		$date_fin   = !empty($request->df) ? $request->df : date('Y-m-d');
		
		//Données pour recherche
		$bureaux 	= Bureau::all();
		
		$whereRaw =  ' 1 ';
		
		if(!empty($bureauID)){ $whereRaw.=  ' AND perception.bureauID = "'.$bureauID.'"'; }
		if(!empty($user_id)){ $whereRaw.=  ' AND perception.user_id = "'.$user_id.'"'; }
		if(!empty($date_debut) && !empty($date_fin)){ $whereRaw.=  ' AND date(perception_date) BETWEEN "'.$date_debut.'" AND "'.$date_fin.'" '; }
		
		
		$perceptions 	= Perception::join('users','perception.user_id','users.id')
									->join('bureau','perception.bureauID','bureau.bureauID')
									->whereRaw($whereRaw)->get(); 
		
		$recherche_montant_total = Perception::join('users','perception.user_id','users.id')
									->join('bureau','perception.bureauID','bureau.bureauID')
									->whereRaw($whereRaw)->get()->sum('perception_montant');
		
        return view('perceptions', [
			'perceptions' => $perceptions,
			'bureaux' => $bureaux,
			'selectedBureauID'=>$bureauID,
			'date_debut'=>$date_debut,
			'date_fin'=>$date_fin,
			'recherche_montant_total'=>$recherche_montant_total,
		]);
		
		
    }

	
    public function perceptionsgroupesparbureau()
    {
		
		$statistiques	 			= Perception::getStatistiques();
		 
        return view('perceptionsgroupesparbureau', [
			'statistiques' => $statistiques
		]);
		
		
    }

	
    public function etatjournalier($bureauID)
    {
		 
		$whereRaw=  ' perception.bureauID = "'.$bureauID.'"'; 
		
		$perceptions 	= Perception::join('users','perception.user_id','users.id')
									->join('bureau','perception.bureauID','bureau.bureauID')
									->whereRaw($whereRaw)->get(); 
									
        return view('etatjournalier', [
			'perceptions' => $perceptions
		]);
		
		
    }

    


}


