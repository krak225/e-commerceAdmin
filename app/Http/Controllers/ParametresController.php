<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ElecteurFormRequest;
use Illuminate\Http\Request;
use Auth;
use App\Commune;
use App\Commande;
use App\Categorie;
use App\Produit;
use App\ProduitFichier;
use App\FraisLivraison;
use App\Course;
use Stdfn;
use DB;


class ParametresController extends Controller
{
  
    //
	public function __construct()
    {

        $this->middleware('auth');
		
    }
	


    public function courses()
    {
		
    	$sql = 'select dim_course.*, commune_retrait.commune_libelle as commune_retrait_libelle, commune_livraison.commune_libelle as commune_livraison_libelle, utilisateur_login, utilisateur_telephone
    	from dim_course 
    	inner join utilisateur USING(utilisateur_id) 
    	inner join dim_commune as commune_retrait on commune_retrait.commune_id = dim_course.commune_id_retrait
    	inner join dim_commune as commune_livraison on commune_livraison.commune_id = dim_course.commune_id_livraison
    	where dim_course.statut <> "SUPPRIME"
    	';					
    		
    	$courses = DB::select($sql);

        return view('courses',['courses'=>$courses]);
		
    }

    public function DetailsCourse($course_id)
    {
		
    	$sql = 'select dim_course.*, commune_retrait.commune_libelle as commune_retrait_libelle, commune_livraison.commune_libelle as commune_livraison_libelle, utilisateur_login, utilisateur_telephone
    	from dim_course 
    	inner join utilisateur USING(utilisateur_id) 
    	inner join dim_commune as commune_retrait on commune_retrait.commune_id = dim_course.commune_id_retrait
    	inner join dim_commune as commune_livraison on commune_livraison.commune_id = dim_course.commune_id_livraison
    	where dim_course.statut <> "SUPPRIME"
    	AND course_id = "'.$course_id.'"
    	';					
    		
    	$course = current(DB::select($sql));

        return view('details_course',['course'=>$course]);
		
    }

    public function setcourselivree(Request $request)
    {
		
		$course_id = $request->course_id;
		
		$course 	= Course::find($course_id);
		
		$course->statut_livraison = 'LIVREE';
		$course->exists = true;
		$course->save();
		
		echo 1;
		
	}



    public function commandes()
    {
		
    	$commandes = Commande::join('tb_users','tb_users.id','commande.utilisateur_id')->get();

    	//dd($commandes);								
        return view('commandes',['commandes'=>$commandes]);
		
    }
	

    public function DetailsCommande(Request $request)
    {
		
		$commande_id = $request->commande_id;
		
		$commande 	= Commande::leftjoin('tb_users','tb_users.id','commande.utilisateur_id')
								->where(['commande_id'=>$commande_id])
								->first();
								
		// dd($commande);
		
		if(!empty($commande)){

			$produits 	= Produit::join('categorie','categorie.categorie_id','produit.categorie_id')
								->join('panier','panier.produit_id','produit.produit_id')
								->join('commande','commande.commande_id','panier.commande_id')
								->where(['commande.commande_id'=>$commande_id])
								->get();
									
			
			return view('details_commande', ['commande'=>$commande,'produits'=>$produits]);
		
		}else{
			
			return Redirect('commandes')->with('warning',"LA COMMANDE QUE VOUS CHERCHEZ N'A PAS ÉTÉ TROUVÉ");
		}
		
	}
	


    public function setcommandelivree(Request $request)
    {
		
		$commande_id = $request->commande_id;
		
		$commande 	= Commande::find($commande_id);
		
		$commande->commande_statut_livraison = 'LIVREE';
		$commande->exists = true;
		$commande->save();
		
		echo 1;
		
	}
	


    public function FraisLivraison()
    {
		
    	$communes = Commune::get();
		
    	$frais_livraison = DB::select('select dim_frais_livraison.*, commune_retrait.commune_libelle as lieu_retrait, commune_livraison.commune_libelle as lieu_livraison
		 from dim_frais_livraison 
		inner join dim_commune as commune_retrait on commune_retrait.commune_id = dim_frais_livraison.commune_id_retrait
		inner join dim_commune as commune_livraison on commune_livraison.commune_id = dim_frais_livraison.commune_id_livraison
		WHERE frais_livraison_statut="VALIDE"
		');
				
        return view('frais_livraison',['frais_livraison'=>$frais_livraison, 'communes'=>$communes]);
		
    }
	
	
    public function SaveFraisLivraison(Request $request)
    {
		
    	$fl = new FraisLivraison();
		$fl->commune_id_retrait   			= $request->commune_id_retrait;
		$fl->commune_id_livraison			= $request->commune_id_livraison;
		$fl->frais_livraison_montant  		= $request->montant;
		$fl->frais_livraison_date_creation  = gmdate('Y-m-d H:i:s');
		$fl->frais_livraison_statut  		= 'VALIDE';
		
		$fl->save();
		
		return back()->with('message','OPÉRATION EFFECTUÉE AVEC SUCCÈS !');
		
    }
	
    public function SupprimerFraisLivraison(Request $request)
    {
		
		$frais_livraison_id = $request->frais_livraison_id;

		$frais_livraison 	= FraisLivraison::find($frais_livraison_id);

		if(!empty($frais_livraison)){

			$frais_livraison->frais_livraison_date_suppression 	= gmdate('Y-m-d H:i:s');
			$frais_livraison->frais_livraison_statut			= "SUPPRIME";
			$frais_livraison->exists 							= true;
			$frais_livraison->save();
			
			echo 1;
			
		}else{
			echo 0;
		}
	}
	
	
    public function categories()
    {
		
    	$categories = Categorie::get();

    	$categories = DB::select('select categorie.*, categorie_parente.categorie_nom as categorie_nom_parent, count(*) as nombre_produits 
    		from categorie 
    		LEFT join categorie as categorie_parente on categorie_parente.categorie_id = categorie.categorie_id_parent
    		LEFT join produit on produit.categorie_id = categorie.categorie_id
    		WHERE categorie.categorie_statut="VALIDE"
    		GROUP BY categorie.categorie_id
		');
			

    	//dd($categories);								
        return view('categories',['categories'=>$categories]);
		
    }
	
	
    public function SaveCategorie(Request $request)
    {
		
		$courrier = new Categorie();
		$courrier->categorie_nom   				= $request->libelle;
		$courrier->categorie_id_parent   		= $request->categorie_id_parent;
		$courrier->categorie_date_creation  	= gmdate('Y-m-d H:i:s');
		
		$courrier->save();
		
		return back()->with('message','OPÉRATION EFFECTUÉE AVEC SUCCÈS !');
		
	}
	

	
    public function SupprimerCategorie(Request $request)
    {
		
		$categorie_id = $request->categorie_id;

		$categorie = Categorie::find($categorie_id);

		if(!empty($categorie)){

			$categorie->categorie_date_suppression 	= gmdate('Y-m-d H:i:s');
			$categorie->categorie_statut 			= "SUPPRIME";
			$categorie->exists 						= true;
			$categorie->save();
			
			echo 1;
			
		}else{
			echo 0;
		}
	}
	

    public function produits()
    {
		
    	$produits = Produit::join('categorie','produit.categorie_id','categorie.categorie_id')
    						->where(['produit_statut'=>'VALIDE'])
    						->get();
    						
    	$categories = Categorie::get();
    	
    	//dd($produits);								
        return view('produits',['produits'=>$produits,'categories'=>$categories]);
		
    }
	
	
    public function SaveProduit(Request $request)
    {
		
		$produit = new Produit();
		$produit->produit_nom   				= $request->produit_nom;
		$produit->categorie_id   				= $request->categorie_id;
		$produit->produit_description   		= $request->produit_description;
		$produit->produit_prix   				= $request->produit_prix;
		$produit->produit_stock   				= $request->produit_stock;
		$produit->produit_date_creation  		= gmdate('Y-m-d H:i:s');
		
		$fichier 		= $request->file('produit_photo');
        $fileName	 	= 'produit_'.''.time().'_'.Auth::user()->id.'_'.$fichier->getClientOriginalName();
        $original_name 	= $fichier->getClientOriginalName();
		
		$mimetype	= $fichier->getMimeType();
		
        $fichier->move(public_path('images/produits'),$fileName);


		$produit->produit_photo = $fileName;
		$produit->save();
		
		$produit_id = $produit->produit_id;


		return back()->with('message','OPÉRATION EFFECTUÉE AVEC SUCCÈS !');
		
	}
	




    public function DetailsProduit(Request $request)
    {
		
		$produit_id = $request->produit_id;
		
		$produit 	= Produit::join('categorie','categorie.categorie_id','produit.categorie_id')
								->where(['produit_statut'=>'VALIDE','produit_id'=>$produit_id])
								->first();
		
		if(!empty($produit)){

			$piecesjointes = ProduitFichier::where(['produit_id'=>$produit_id])->get();
				
			return view('details_produit', ['produit'=>$produit,'piecesjointes'=>$piecesjointes]);
		
		}else{
			
			return Redirect('produits')->with('warning',"LE PRODUIT QUE VOUS CHERCHEZ N'A PAS ÉTÉ TROUVÉ");
		}
		
	}
	

	
    public function SupprimerProduit(Request $request)
    {
		
		$produit_id = $request->produit_id;

		$produit = Produit::find($produit_id);

		if(!empty($produit)){

			$produit->produit_date_suppression 	= gmdate('Y-m-d H:i:s');
			$produit->produit_statut 			= "SUPPRIME";
			$produit->exists 					= true;
			$produit->save();
			
			echo 1;
			
		}else{
			echo 0;
		}
	}
	

	//Ajout de fichiers à la demande au tout le long du processus
	public function UpdateFichiers($produit_id, Request $request){
		
		$produit = Produit::find($produit_id);
		
		
		$fichier 		= $request->file('produits_fichiers');
        $fileName	 	= 'produit_'.$produit_id.'_'.time().'_'.Auth::user()->id.'_'.$fichier->getClientOriginalName();
        $original_name 	= $fichier->getClientOriginalName();
		
		$mimetype	= $fichier->getMimeType();
		
        $fichier->move(public_path('images/produits'),$fileName);
		
		
		$piecejointe = new ProduitFichier();
		
		$piecejointe->user_id 						= Auth::user()->id;
		$piecejointe->produit_id 					= $produit_id;
		$piecejointe->autreimage_photo 				= $fileName;
		$piecejointe->autreimage_date_creation 		= gmdate('Y-m-d H:i:s');
		$piecejointe->save();
		
		return $piecejointe;
		
		
	}
	

	


}


