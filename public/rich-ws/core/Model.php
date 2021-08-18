<?php

class Model{
	
	
	private $pdo;
	
	public function __construct(){
		$this->pdo = getPDO();
	}
	
	public function getPdo(){
		return $this->pdo;
	}
	
	
	//Connexion utilisateur
	function connexionUtilisateur($utilisateur_login,$utilisateur_password){
		
		$sql = 'SELECT * from utilisateur 
		WHERE utilisateur_login= ?
		AND  utilisateur_password= ?
		AND utilisateur_statut= ? 
		LIMIT 0,1 
		';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($utilisateur_login, $utilisateur_password,"VALIDE"));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		
		foreach($data as $d){
			
			if(file_exists(ROOT."/images/upload-utilisateur/".$d->utilisateur_photo) 
				&& isImage(ROOT."/images/upload-utilisateur/".$d->utilisateur_photo)
				&& !empty($d->utilisateur_photo)
			){
				$d->utilisateur_photo = ROOT."/images/upload-utilisateur/".$d->utilisateur_photo;
			}else{
				$d->utilisateur_photo = ROOT."/images/upload-utilisateur/user.png";
			}
			
		}
		
		return $data;
	
	}
	
	
	public function getUtilisateur($utilisateur_id){
		$sql = 'SELECT * from utilisateur
		WHERE utilisateur_id = ?
		';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($utilisateur_id));
		$data = $stm->fetch(PDO::FETCH_OBJ);
		
		return $data;
	}
	
	public function getProduits($categorie_id=0){
		
		$sql = 'select produit.*, categorie_nom
		from produit 
		inner join categorie using(categorie_id)
		where produit_statut="VALIDE" ';
		
		if($categorie_id > 0){
			$sql.= ' AND produit.categorie_id = "'.$categorie_id.'"';
		}

		$sql.= ' order by produit_id desc ';
		

		$stm = $this->pdo->prepare($sql);
		$stm->execute(array());
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		

		return $data;
		
	}

	public function getCourses($utilisateur_id){
		
		$sql = 'select dim_course.*, commune_retrait.commune_libelle as lieu_retrait, commune_livraison.commune_libelle as lieu_livraison
		 from dim_course 
		inner join dim_commune as commune_retrait on commune_retrait.commune_id = dim_course.commune_id_retrait
		inner join dim_commune as commune_livraison on commune_livraison.commune_id = dim_course.commune_id_livraison
		 where 1 
		 and utilisateur_id = ? ';

		$sql.= ' order by course_id desc ';
		

		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($utilisateur_id));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		

		return $data;
		
	}

	public function getPhotos($produit_id){

		$sql = 'select autreimage_id, autreimage_photo from autreimage
		where produit_id=? ';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($produit_id));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);

		return $data;
	}

	public function getTotalProduits(){
		
		$sql = 'select count(*) as nombre, sum(produit_prix) as montant 
		from produit 
		inner join categorie using(categorie_id)
		where 1';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array());
		$data = $stm->fetch(PDO::FETCH_OBJ);
		//debug($data);

		return $data;
		
	}

	public function getTotalTPanier($session_id){
		
		$sql = 'select count(*) as nombre, sum(panier_quantite * panier_produit_pu) as montant 
		from produit 
		inner join categorie using(categorie_id)
		inner join panier using(produit_id)
		where session_id = ? 
		AND panier_statut = ?';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($session_id,"BROUILLON"));
		$data = $stm->fetch(PDO::FETCH_OBJ);
		//debug($data);

		return $data;
		
	}
	
	public function getProduit($produit_id){
		
		$sql = 'select produit.*, categorie_nom
		from produit 
		inner join categorie using(categorie_id)
		where produit_id = ? AND produit_statut="VALIDE"  ';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($produit_id));
		$data = $stm->fetch(PDO::FETCH_OBJ);
		
		

		return $data;
		
	}
	
	
	
	public function getPanier($session_id){
		
		$sql = 'select produit.*, categorie_nom, panier_quantite
		from produit 
		inner join categorie using(categorie_id)
		inner join panier using(produit_id) 
		where session_id=? 
		and panier_statut=?
		';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($session_id,"BROUILLON"));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		

		return $data;
		
	}
	

	//contenu d'une commande
	public function getPanierValide($session_id, $commande_id){
		
		$sql = 'select produit.*, categorie_nom, panier_quantite
		from produit 
		inner join categorie using(categorie_id)
		inner join panier using(produit_id) 
		where session_id=? 
		and commande_id = ?
		and panier_statut=?
		';
		//die($sql);
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($session_id, $commande_id, "VALIDE"));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		

		return $data;
		
	}
	

	public function addToPanier($produit_id,$quantite,$session_id){

		//vérifier
		$sql = 'select * from panier where produit_id = ? and session_id = ? and panier_statut = ? ';

		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($produit_id, $session_id,"BROUILLON"));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);

		if(empty($data)){

			//récupérer le prix du produit et le mettre à jour dans le panier
			$sql = 'select produit_prix from produit where produit_id = ? ';
			$stm = $this->pdo->prepare($sql);
			$stm->execute(array($produit_id));
			$data = $stm->fetch(PDO::FETCH_OBJ);
			$produit_prix = $data->produit_prix;

			$sql = 'insert into panier (produit_id,panier_produit_pu,session_id,panier_quantite) values("'.$produit_id.'","'.$produit_prix.'","'.$session_id.'","'.$quantite.'")';

		}else{

			$sql = 'update panier set panier_quantite = panier_quantite + '.$quantite.' where produit_id="'.$produit_id.'" and session_id="'.$session_id.'" and panier_statut="BROUILLON"';


		}
		
		
		return $this->insertDB($sql);

	}

	public function UpdatePanier($produit_id,$quantite,$session_id){

		$sql = 'update panier set panier_quantite = "'.$quantite.'" where produit_id="'.$produit_id.'" and session_id="'.$session_id.'" and panier_statut="BROUILLON"';

		
		return $this->updateDB($sql);

	}

	
	public function SupprimerDuPanier($produit_id,$session_id){

		$sql = 'delete from panier where produit_id="'.$produit_id.'" and session_id="'.$session_id.'"';

		
		return $this->updateDB($sql);

	}

	


	public function getCommandes($utilisateur_id){
		
		$sql = 'select *
		from commande 
		inner join utilisateur using(utilisateur_id)
		where utilisateur_id = "'.$utilisateur_id.'" ';
		
		$sql.= ' order by commande_id desc ';
		
		//die($sql);
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($utilisateur_id));
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		

		return $data;
		
	}


	//
	public function saveUser($nom,$prenoms,$commune_id,$telephone,$email,$password){
		
		$sql1 = 'SELECT * FROM utilisateur where utilisateur_email = "'.$email.'"';
		$stm1 = $this->pdo->prepare($sql1);
		$stm1->execute();
		$data1 = $stm1->fetch(PDO::FETCH_OBJ);
		
		//if(empty($data1)){

			$password = krakCript($password);

			$sql = 'INSERT INTO utilisateur (utilisateur_id, profil_utilisateur_id, commune_id, utilisateur_nom, utilisateur_prenoms, utilisateur_telephone, utilisateur_email,utilisateur_login, utilisateur_password) 
			VALUES (NULL, "2", "'.$commune_id.'", "'.$nom.'", "'.$prenoms.'", "'.$telephone.'",  "'.$email.'", "'.$email.'",  "'.$password.'")';
			
			//die($sql);
			
			$data = $this->insertDb($sql);
			
			return ($data->statut == 1)? $data->lastId : '0';
			
		//}else{
			
			//return 2;//téléphone déjà utilisé
			
		//}
		
	}

	public function SaveCommande($session_id,$client_id,$mode_paiement_id,$numero_compte){

		$total = $this->getTotalTPanier($session_id);

		$montant = $total->montant;

		$sql = 'insert into commande (utilisateur_id, commande_montant_ht, commande_montant_ttc, commande_date_creation) 
		values("'.$client_id.'", "'.$montant.'", "'.$montant.'", "'.date('Y-m-d H:i:s').'")';


		$data = $this->insertDB($sql);
		$commande_id = $data->lastId;

		$sql = 'update panier set commande_id = "'.$commande_id.'", panier_statut = "VALIDE" 
		where session_id = "'.$session_id.'"
		AND panier_statut="BROUILLON"
		';
		$data = $this->updateDB($sql);

	}


	public function SaveCourse($utilisateur_id,$nature_course, $nom, $telephone, $date_retrait, $date_livraison, $commune_id_retrait, $commune_id_livraison, $frais_livraison){
		
		$sql = 'insert into dim_course (utilisateur_id,nature_course, nom, telephone, date_retrait, date_livraison, commune_id_retrait, commune_id_livraison, frais_livraison,date_creation) 
		values("'.$utilisateur_id.'", "'.$nature_course.'", "'.$nom.'", "'.$telephone.'", "'.$date_retrait.'", "'.$date_livraison.'", "'.$commune_id_retrait.'", "'.$commune_id_livraison.'", "'.$frais_livraison.'", "'.date('Y-m-d H:i:s').'")';
		
		$data = $this->insertDB($sql);
		$course_id = $data->lastId;
		
		return $course_id;

	}

	public function getFraisLivraison($commune_id_retrait, $commune_id_livraison){

		$sql = 'SELECT * from dim_frais_livraison where commune_id_retrait = ? and commune_id_livraison = ? ';
		
		//die($sql);

		$stm = $this->pdo->prepare($sql);
		$stm->execute(array($commune_id_retrait, $commune_id_livraison));
		$data = $stm->fetch(PDO::FETCH_OBJ);
		
		return !empty($data)? $data->frais_livraison_montant : 0;

	}

	//
	public function getCommunes(){
		
		$sql = 'SELECT * from dim_commune order by commune_libelle asc';
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_OBJ);
		
		return $data;
		
	}

	//
	
	//PERMET D'INSERER DES DES DONNEES DANS UNE TABLE
	function insertDb($sql){
		$out = new stdClass();
		$out->statut = 0;
		$out->lastId = null;
		try{
			// $this->pdo->exec($sql);
			if($this->pdo->exec($sql)){
				$lastId = $this->pdo->lastInsertId();
				$out->statut = 1;
				$out->lastId = $lastId;
			}else{
				$error= $this->pdo->errorInfo();//debug($error);
				$out->statut = 0;
				$out->exception = $error[2];
			}
		}catch(Exception $ex){
			$out->statut = 0;
			$out->exception = $ex->getMessage();
			$out->lastId = "undefined";
		}
		// debug($out);

		return $out;
	}
	
	//PERMET DE METTRE A JOUR DES DES DONNEES DANS UNE TABLE
	function updateDB($sql){//debug($sql);
		$out = new stdClass();
		try{
			if($this->pdo->exec($sql)){
				$out->statut = 1;
			}else{
				$error= $this->pdo->errorInfo();//debug($error);
				$out->statut = 0;
				$out->exception = $error[2];
			}
		}catch(Exception $ex){
			$out->statut = 0;
			$out->exception = $ex->getMessage();
		}
		// debug($out);
		return $out;
	}
	
	
	
	function rowCount($sql){
		
		$stm = $this->pdo->prepare($sql);
		$stm->execute();
		return $stm->rowCount();
		
	}
	
	
}

?>