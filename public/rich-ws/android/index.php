<?php
require_once('../fonctions/fnDB.php');
require_once('../fonctions/fonctions.php');
require_once('../core/Model.php');


define('INTERNET',1);//Valeurs 1: en ligne, 0: hors ligne

define('ROOT',(INTERNET==1)? 'https://www.dipdip.fr/ecommerce-admin/public/images/produits/' : 'http://192.168.138.1:1986/www.ecommerce.com');


//Une instance du model Pour l'interaction avec la Base de données
$db = new Model();
$pdo = $db->getPDO();



//$_GET['fn']            	 = 'confirmerpaiement';
//$_GET['categorie_id']    = 0; 
//$_GET['produit_id']    = 2; 
//$_GET['quantite']    = 2; 
//$_GET['session_id']    = 'sess'.time(); 

// $fp= fopen('POST.log','a+');
// $content = file_get_contents('php://input');
// fputs($fp,$content);
// fclose($fp);


if(isset($_GET['fn'])){
	
	extract($_POST);
	extract($_GET);
	
	$tab = array();
	
	switch($fn){
		

		default:
		case 'connexionUtilisateur':
		
			$connectedUtilisateur = $db->connexionUtilisateur($utilisateur_login, krakCript($utilisateur_password));
			//$connectedUtilisateur = $db->connexionUtilisateur($utilisateur_login, $utilisateur_password);
			
			$listeUtilisateurs = array();
		
			if(!empty($connectedUtilisateur) ){
				
				foreach($connectedUtilisateur as $user){
					$listeUtilisateurs[] = 
						array('utilisateurId'=>$user->utilisateur_id,
                        'utilisateurNomPrenoms'=>strtoupper($user->utilisateur_nom." ".$user->utilisateur_prenoms),
                        'utilisateurLogin'=>strtoupper($user->utilisateur_login),
                        'utilisateurPassword'=>"",
                        'utilisateurSecteurId'=>"",
                        'utilisateurSecteurNom'=>""
						);
				}

			}else{
				
				$listeUtilisateurs[] = 
                    array('utilisateurId'=>"",
                        'utilisateurNomPrenoms'=>"",
                        'utilisateurLogin'=>"",
                        'utilisateurPassword'=>"",
                        'utilisateurSecteurId'=>"",
                        'utilisateurSecteurNom'=>""
						);
            
				
			}
			
			echo json_encode(array('listeUtilisateurs'=>$listeUtilisateurs));
			
		break;
		
		
		
		case 'produits':
			
			$produits = $db->getProduits($categorie_id);
			$listeProduits = array();

		    $totalProduits = array();
		    $montantTotalProduit = 0;

			foreach($produits as $produit){
				 	 
				$listeProduits[] = 
                    	array(
                    		'produitId' =>$produit->produit_id,
                    		'categorieId' =>$produit->categorie_id,
							'produitCategorieNom' =>utf8_encode(stripslashes($produit->categorie_nom)),
							'produitNom' =>utf8_encode(stripslashes($produit->produit_nom)),
							'produitStock' =>$produit->produit_stock,
							'produitPrix' =>$produit->produit_prix,
							'produitPhoto' =>ROOT.$produit->produit_photo,
							'produitDateCreation' =>dateFromDB($produit->produit_date_creation),
							'produitStatut' =>$produit->produit_statut,
							'produitDescription' =>html_entity_decode($produit->produit_description),
						);


			}
			
		
			$totalProduits = $db->getTotalTPanier($session_id);	

			echo json_encode(array('listeProduits'=>$listeProduits,'totalProduits'=>$totalProduits));
			
		break;
		


		
		case 'photos':
			
			$photos = $db->getPhotos($produit_id);
			$listePhotos = array();

			foreach($photos as $photo){
				 	 
				$listePhotos[] = 
                    	array(
                    		'photoId' =>$photo->autreimage_id,
							'photoSrc' =>ROOT.$photo->autreimage_photo,
						);


			}

			echo json_encode(array('listePhotos'=>$listePhotos));
			
		break;
		
		
		case 'addtopanier':

			
			$data = $db->addToPanier($produit_id,$quantite,$session_id);
			//debug($data);

			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";

			
			$listeProduits = array();

		    $totalProduits = array();
		    $montantTotalProduit = 0;


		    if($data->statut == 1){

				$produits = $db->getPanier($session_id);
				$listeProduits = array();


				foreach($produits as $produit){
					 	 
					$listeProduits[] = 
	                    	array(
	                    		'produitId' =>$produit->produit_id,
	                    		'categorieId' =>$produit->categorie_id,
								'produitCategorieNom' =>utf8_encode(stripslashes($produit->categorie_nom)),
								'produitNom' =>utf8_encode(stripslashes($produit->produit_nom)),
								'produitStock' =>$produit->produit_stock,
								'produitPrix' =>$produit->produit_prix,
								'produitPhoto' =>ROOT.$produit->produit_photo,
								'produitDateCreation' =>dateTimeFromDB($produit->produit_date_creation),
								'produitStatut' =>$produit->produit_statut,
								'produitDescription' =>html_entity_decode($produit->produit_description),
							);


				}
				
			
				$totalProduits = $db->getTotalTPanier($session_id);	

		
			}


			echo json_encode(array('OperationResult'=>$OperationResult,'listeProduits'=>$listeProduits,'totalProduits'=>$totalProduits));
			
		break;



		
		case 'updatepanier':

			
			$data = $db->UpdatePanier($produit_id,$quantite,$session_id);
			//debug($data);

			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";

			
			$listeProduits = array();

		    $totalProduits = array();
		    $montantTotalProduit = 0;


		    if($data->statut == 1){

				$produits = $db->getPanier($session_id);
				$listeProduits = array();


				foreach($produits as $produit){
					 	 
					$listeProduits[] = 
	                    	array(
	                    		'produitId' =>$produit->produit_id,
	                    		'categorieId' =>$produit->categorie_id,
								'produitCategorieNom' =>utf8_encode(stripslashes($produit->categorie_nom)),
								'produitNom' =>utf8_encode(stripslashes($produit->produit_nom)),
								'produitStock' =>$produit->produit_stock,
								'produitPrix' =>$produit->produit_prix,
								'produitPhoto' =>ROOT.$produit->produit_photo,
								'produitDateCreation' =>dateTimeFromDB($produit->produit_date_creation),
								'produitStatut' =>$produit->produit_statut,
								'produitDescription' =>html_entity_decode($produit->produit_description),
							);


				}
				
			
				$totalProduits = $db->getTotalTPanier($session_id);	

		
			}


			echo json_encode(array('OperationResult'=>$OperationResult,'listeProduits'=>$listeProduits,'totalProduits'=>$totalProduits));
			
		break;



		
		case 'supprimerdupanier':

			
			$data = $db->SupprimerDuPanier($produit_id,$session_id);
			//debug($data);

			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";

			
			$listeProduits = array();

		    $totalProduits = array();
		    $montantTotalProduit = 0;


		    if($data->statut == 1){

				$produits = $db->getPanier($session_id);
				$listeProduits = array();


				foreach($produits as $produit){
					 	 
					$listeProduits[] = 
	                    	array(
	                    		'produitId' =>$produit->produit_id,
	                    		'categorieId' =>$produit->categorie_id,
								'produitCategorieNom' =>utf8_encode(stripslashes($produit->categorie_nom)),
								'produitNom' =>utf8_encode(stripslashes($produit->produit_nom)),
								'produitStock' =>$produit->produit_stock,
								'produitPrix' =>$produit->produit_prix,
								'produitPhoto' =>ROOT.$produit->produit_photo,
								'produitDateCreation' =>dateTimeFromDB($produit->produit_date_creation),
								'produitStatut' =>$produit->produit_statut,
								'produitDescription' =>html_entity_decode($produit->produit_description),
							);


				}
				
			
				$totalProduits = $db->getTotalTPanier($session_id);	

		
			}


			echo json_encode(array('OperationResult'=>$OperationResult,'listeProduits'=>$listeProduits,'totalProduits'=>$totalProduits));
			
		break;



		case 'monpanier':
			
			$produits = $db->getPanier($session_id);
			$listeProduits = array();

		    $totalProduits = array();
		    $montantTotalProduit = 0;

			foreach($produits as $produit){
				 	 
				$listeProduits[] = 
                    	array(
                    		'produitId' =>$produit->produit_id,
                    		'categorieId' =>$produit->categorie_id,
							'produitCategorieNom' =>utf8_encode(stripslashes($produit->categorie_nom)),
							'produitNom' =>utf8_encode(stripslashes($produit->produit_nom)),
							'produitStock' =>$produit->produit_stock,
							'produitPrix' =>$produit->produit_prix,
							'produitPhoto' =>ROOT.$produit->produit_photo,
							'produitDateCreation' =>dateTimeFromDB($produit->produit_date_creation),
							'produitStatut' =>$produit->produit_statut,
							'panierQuantite' =>$produit->panier_quantite,
						);


			}
			
		
			$totalProduits = $db->getTotalTPanier($session_id);	

			echo json_encode(array('listePanier'=>$listeProduits,'totalProduits'=>$totalProduits));
			
		break;
		


		
		case 'commandes':
			
			$commandes = $db->getCommandes($session_id);
			$listeCommandes = array();

			foreach($commandes as $commande){
				 	 
				$listeCommandes[] = 
                    	array(
                    		'commandeId' =>$commande->commande_id,
							'commandeMontant' =>$commande->commande_montant_ttc,
							'commandeDate' =>dateFromDB($commande->commande_date_creation),
							'commandeStatut' =>$commande->commande_statut,
							'commandeStatutLivraison' =>$commande->commande_statut_livraison,
							'commandeLibelle' =>"Par ". strtoupper($commande->utilisateur_login) . " le " .dateFromDB($commande->commande_date_creation),
						);


			}
			
		
			echo json_encode(array('listeCommandes'=>$listeCommandes));
			
		break;
		


		case 'detailscommande':
			
			$produits = $db->getPanierValide($session_id, $commande_id);
			$listeProduits = array();

		    $totalProduits = array();
		    $montantTotalProduit = 0;

			foreach($produits as $produit){
				 	 
				$listeProduits[] = 
                    	array(
                    		'produitId' =>$produit->produit_id,
                    		'categorieId' =>$produit->categorie_id,
							'produitCategorieNom' =>utf8_encode(stripslashes($produit->categorie_nom)),
							'produitNom' =>utf8_encode(stripslashes($produit->produit_nom)),
							'produitStock' =>$produit->produit_stock,
							'produitPrix' =>$produit->produit_prix,
							'produitPhoto' =>ROOT.$produit->produit_photo,
							'produitDateCreation' =>dateTimeFromDB($produit->produit_date_creation),
							'produitStatut' =>$produit->produit_statut,
							'panierQuantite' =>$produit->panier_quantite,
						);


			}
			
		
			$totalProduits = $db->getTotalTPanier($session_id);	

			echo json_encode(array('listePanier'=>$listeProduits,'totalProduits'=>$totalProduits));
			
		break;
		


		case 'saveuser':
		
			$reponse = $db->saveUser($nom,$prenoms,$commune_id,$telephone,$email,$password);
			
			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";

			echo json_encode(array('OperationResult'=>$OperationResult));
			
		break;


		case 'inscriptionUtilisateur':
		
			$reponse = $db->saveUser("","","","",$login,$password);
		
			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";

			echo json_encode(array('OperationResult'=>$OperationResult));
			
			
		break;

		case 'SaveCourse':
			$date_retrait = dateTimeToDB($date_retrait);
			$date_livraison = dateTimeToDB($date_livraison);
			
			$reponse = $db->SaveCourse($session_id,$nature_course, $nom, $telephone, $date_retrait, $date_livraison, $commune_id_retrait, $commune_id_livraison, $frais_livraison);
		
			echo $reponse;
			
		break;

		
		case 'getFraisLivraison':
			
			$frais_livraison = $db->getFraisLivraison($commune_id_retrait, $commune_id_livraison);
			
			echo $frais_livraison;
			
		break;
		
		case 'communes':
			
			$pages = $db->getCommunes();
			$listeCommunes = array(array(
                        'communeId'=>0,
                        'communeLibelle'=>'Choisir',
                    ));
		
            
			foreach($pages as $page){
				 	 
				$listeCommunes[] = 
                    array(
                        'communeId'=>$page->commune_id,
                        'communeLibelle'=>utf8_encode($page->commune_libelle),
                    );
						
			}
			
			echo json_encode(array('listeCommunes'=>$listeCommunes));
			
		break;
		

		case "confirmerpaiement":


			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";

		    //récupérer les produit du panier en session
			$total = $db->getTotalTPanier($session_id);
			//debug($total);

		    //enregistrer la commande 
			$db->SaveCommande($session_id,$client_id,$mode_paiement_id,$numero_compte);

		    //mettre a jour l'id de la commande dans le panier



			echo json_encode(array('OperationResult'=>$OperationResult));

		break;



		case 'mescourses':
			
			$courses = $db->getCourses($session_id);
			$listeCourses = array();

			foreach($courses as $course){
				 	 
				$listeCourses[] = 
                    	array(
                    		'courseId' =>$course->course_id,
							'courseNature' =>utf8_encode(stripslashes($course->nature_course)),
							'courseDateRetrait' =>dateTimeFromDB($course->date_retrait),
							'courseLieuRetrait' =>utf8_encode(stripslashes($course->lieu_retrait)),
							'courseDateLivraison' =>dateTimeFromDB($course->date_livraison),
							'courseLieuLivraison' =>utf8_encode(stripslashes($course->lieu_livraison)),
							'courseFraisLivraison' =>utf8_encode(stripslashes($course->frais_livraison)),
							'courseStatut' =>utf8_encode(stripslashes($course->statut))
						);

			}
			

			$OperationResult = array();
		    $OperationResult['operationStatut'] = 1;
		    $OperationResult['operationMessage'] = "Opération effectuée avec succès!";


			echo json_encode(array('listeCourses'=>$listeCourses,'OperationResult'=>$listeOperationResult));
			
		break;
		



		
	}


	
	
}


?>