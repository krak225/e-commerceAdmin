<?php 
class krakVerification
{
	public $cpt_erreurs;
	public $erreurs;
	public $etatpj;
	public $extensionpj;
	public $etatenregistrement;
//____________________________________________________________________________________________________________//	
	function _initialiser()
	{
		$this->cpt_erreurs=null;
		$this->erreurs=null;
		$this->etatpj=array();
		$this->extensionpj=null;
	}
//____________________________________________________________________________________________________________//	
	function InitLibelles($tablibelle)
	{
		foreach($tablibelle as $valeur)
		{
			$this->erreurs[$valeur]=null;
		}
	}
//____________________________________________________________________________________________________________//
	function ToutEstCorrecte()
	{
		if($this->cpt_erreurs==0){return true;} else {return false;}
	}
////____________________________________________________________________________________________________________//
	function verifierNonVide($chaine,$libelle,$minsize,$obligatoire)
	{
		if(empty($chaine)){
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
		}
	}
//____________________________________________________________________________________________________________//
	function verifierChaine($chaine,$libelle,$minsize,$obligatoire)
	{
		if(!empty($chaine))
		{
			if(strlen($chaine)<$minsize)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> trop court (au moins $minsize caractères)";
			}
			if(is_numeric($chaine))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> ne doit pas être un nombre";
			}
		}
		if($obligatoire==1)
		{
			if(empty($chaine))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}
	}
//____________________________________________________________________________________________________________//
	function verifierMotdepasse($chaine,$libelle,$minsize,$maxsize,$obligatoire)
	{
		if(!empty($chaine))
		{
			if(strlen($chaine)<$minsize)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> trop court ($minsize caractères minimum)";
			}
			
			if(strlen($chaine)>$maxsize)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> trop long ($maxsize caractères maximum)";
			}
			
			$format_nombre="#[0-9]#";
			$format_majuscule="#[A-Z]#";
			$format_miniscule="#[a-z]#";
			// $format_caractere_special="#[$*^@(_°)£&]#";
			$format_caractere_special="#[^ \w]#";// || !preg_match($format_caractere_special,$chaine)
			if(!preg_match($format_nombre,$chaine) || !preg_match($format_majuscule,$chaine))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Format de <b>$libelle</b> incorrecte (au moins une lettre majuscule, un chiffre)";
			}
			
		}
		if($obligatoire==1)
		{
			if(empty($chaine))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}
	}
	
//____________________________________________________________________________________________________________//
	function verifierRobot($chaine)
	{
		if(!empty($chaine))
		{
				$this->cpt_erreurs++;
				$this->erreurs['Robot']="Le formulaire a été validé par un robot";
		}
	}
//____________________________________________________________________________________________________________//
	function verifierNombre($nombre,$libelle,$min,$max,$obligatoire)
	{
		$nombre=str_replace(' ',null,$nombre);
		if(!empty($nombre))
		{
			if($nombre<$min or $nombre >$max)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> doit être compris entre $min et $max";
			}
			if(!is_numeric($nombre))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> doit être un nombre";
			}
		}
		if($obligatoire==1)
		{
			if(empty($nombre))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}
	}
//____________________________________________________________________________________________________________//
	function verifierEmail($email,$libelle,$obligatoire)
	{	
		if(!empty($email))
		{
			$format_email="#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#";
			if(!preg_match($format_email,$email))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Adresse E-mail invalide";			
			}
		}
		if($obligatoire==1)
		{
			if(empty($email))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}

//____________________________________________________________________________________________________________//
	function verifierDate($date,$libelle,$obligatoire)
	{	
		$date=str_replace('-','/',$date);
		if(!empty($date))
		{
			$format_date="#^[0-9]{2,2}+/[0-9]{2,2}+/[0-9]{4,4}$#";
			if(!preg_match($format_date,$date))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Date invalide";			
			}
		}
		if($obligatoire==1)
		{
			if(empty($date))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}

//____________________________________________________________________________________________________________//
	function verifierPhone($phone,$libelle,$obligatoire)
	{			
		$phone=str_replace(' ',null,$phone);
		$phone=trim($phone);
		if(!empty($phone))
		{
			$format_phone0="#^[0]{2}+[0-9]{1,3}+[0-9]{8}$#";//0022504783689
			$format_phone1="#^[+]{1}+[0-9]{1,3}+[0-9]{8}$#";//+22504783689
			$format_phone2="#^[0-9]{1,3}+[0-9]{8}$#";//22504783689
			$format_phone3="#^[0-9]{8}$#";//04783689
			
			if(!preg_match($format_phone0,$phone)
			and !preg_match($format_phone1,$phone)
			and !preg_match($format_phone2,$phone)
			and !preg_match($format_phone3,$phone)
			)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Numéro de téléphone invalide";			
			}
		}
		if($obligatoire==1)
		{
			if(empty($phone))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}
//____________________________________________________________________________________________________________//
	function verifierPhone0($phone,$libelle,$obligatoire)
	{	
		$phone=str_replace(' ',null,$phone);
		$phone=trim($phone);
		if(!empty($phone))
		{
			$format_phone11="#^[0]{2}+[0-9]{1,3}+ [0-9]{1,8}$#";//00225 04783689
			$format_phone12="#^[0]{2}+[0-9]{1,3}+[0-9]{1,8}$#";//0022504783689
			$format_phone21="#^[+]{1}+[0-9]{1,3}+ [0-9]{1,8}$#";//+225 04783689
			$format_phone22="#^[+]{1}+[0-9]{1,3}+[0-9]{1,8}$#";//+22504783689
			$format_phone31="#^[0-9]{1,3}+ [0-9]{1,8}$#";//225 04783689
			$format_phone32="#^[0-9]{1,3}+ [0-9]{1,8}$#";//22504783689
			$format_phone41="#^[0-9]{1,8}$#";//04783689
			$format_phone42="#^[0-9]{2}+ [0-9]{2}+ [0-9]{2}+ [0-9]{2}$#";//04 78 36 89
			
			if(!preg_match($format_phone0,$phone)
			and !preg_match($format_phone1,$phone)
			and !preg_match($format_phone2,$phone)
			and !preg_match($format_phone3,$phone)
			and !preg_match($format_phone4,$phone)
			and !preg_match($format_phone5,$phone)
			)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Numéro de téléphone invalide";			
			}
		}
		if($obligatoire==1)
		{
			if(empty($phone))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}
//____________________________________________________________________________________________________________//
	function verifierChainesIdentiques($chaine1,$chaine2,$libelle,$minsize,$obligatoire)
	{
		if(strlen($chaine1)<$minsize)
		{

			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Entrez plus de $minsize caractères";			
		}
		if($chaine1!=$chaine2)
		{
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Les deux \"$libelle\" doivent être identiques";		
		}
		if($obligatoire==1)
		{
			if(empty($chaine1))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}

//____________________________________________________________________________________________________________//
	function verifierChainesNonIdentiques($chaine1,$chaine2,$libelle)
	{
		if($chaine1==$chaine2)
		{
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Les deux <b>$libelle</b> doivent être différents";		
		}
	}
//____________________________________________________________________________________________________________//
	function verifierCaptcha($captcha,$vrai,$libelle,$obligatoire)
	{
		if(!empty($captcha))
		{
			if($captcha!=$vrai)
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="<b>$libelle</b> incorrecte";		
			}
		}
		if($obligatoire==1)
		{
			if(empty($captcha))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}
//____________________________________________________________________________________________________________//
	function EstDisponible($chaine,$libelle,$table,$champ,$errerMsg,$obligatoire)
	{
		GLOBAL $pdo;
		// debug($pdo);
		$sql='SELECT * FROM '.$table.' WHERE '.$champ.'="'.$chaine.'"';
		$stm = $pdo->prepare($sql);
		$stm->execute();
		$n = $stm->rowCount();
		if($n!=0)
		{
			$this->cpt_erreurs++;
			// $this->erreurs[$libelle]="<b>$libelle</b> est déjà utilisé";
			$this->erreurs[$libelle]= !empty($errerMsg)? $errerMsg : "$libelle indisponible";
						
		}

		if($obligatoire==1)
		{
			if(empty($chaine))
			{
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
			}	
		}	
	}
//____________________________________________________________________________________________________________//
function verifierPieceJointe($pj,$libelle,$maxsize,$maxwidth,$maxheight,$extensionsvalides,$obligatoire)
{
	
	//erreur fichiers
	if ($pj['error']) {     
	    switch ($pj['error']){     
		   case 1: // UPLOAD_ERR_INI_SIZE     
				// echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !"; 
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Fichier trop lourd (Taille maximum autorisée :2MB)";		   
		   break;     
		   case 2: // UPLOAD_ERR_FORM_SIZE     
				// echo "Le fichiqer dépasse la limite autorisée dans le formulaire HTML !"; 
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="Fichier trop lourd (Taille maximum autorisée :2MB)";
		   break;     
		   case 3: // UPLOAD_ERR_PARTIAL
				$this->cpt_erreurs++;
				$this->erreurs[$libelle]="L'envoi du fichier a été interrompu pendant le transfert !";					
		   break;     
		   case 4: // UPLOAD_ERR_NO_FILE    
				if($obligatoire==1)
				{
					$this->cpt_erreurs++;
					$this->erreurs[$libelle]="Veuillez choisir un fichier";	
				}
		   break;     
	    }     
	}     
	else {     
		// $_FILES['nom_du_fichier']['error'] vaut 0 soit UPLOAD_ERR_OK     
		// ce qui signifie qu'il n'y a eu aucune erreur 
 	
		//vérifier le le type et la dimensions (lxh) si image
		$dim = getimagesize($pj['tmp_name']);
		$l=$dim[0];$h=$dim[1];
		$ext=strtolower(substr(strrchr($pj['name'],'.'),1));
		
		if($l>$maxwidth or $h>$maxheight)
		{
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="dimensions nom conforme ($l * $h contre $maxwidth * $maxheight)";			
		}
		
		if(!in_array($ext,$extensionsvalides))
		{
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Format de fichier invalide";				
		}
	 
	}   

}
//____________________________________________________________________________________________________________//
function DeplacerFichier($pj,$nom,$dir)
{
	$ext=strtolower(substr(strrchr($pj['name'],'.'),1));
	$this->extensionpj=$ext;
	$dir.=$nom;/*.'.'.$ext;*/
    $file_tmp = $pj['tmp_name'];
	if(!empty($ext)){copy($file_tmp,$dir);}
}

//____________________________________________________________________________________________________________//
function extensionfichier($pj)
{
	$ext=strtolower(substr(strrchr($pj['name'],'.'),1));
	return $ext;
}
//____________________________________________________________________________________________________________//
function nomFichier($pj)
{
	$filename=$pj['name'];
	return $filename;
}
//____________________________________________________________________________________________________________//
function EnregistrementTerminee()
{
	if($this->etatenregistrement='ok'){return true;}else{return false;}
}
//____________________________________________________________________________________________________________//
function verifierSiExisteDansBDD($chaine,$libelle,$table,$champ,$obligatoire)
{
	$sql='SELECT * FROM '.$table.' WHERE '.$champ.'="'.$chaine.'"';
	$req=mysql_query($sql);$n=mysql_num_rows($req);
	if($n==0)
	{
		$this->cpt_erreurs++;
		$this->erreurs[$libelle]="Ce <b>$libelle</b> n'existe pas";			
	}

	if($obligatoire==1)
	{
		if(empty($chaine))
		{
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
		}	
	}		
}
//____________________________________________________________________________________________________________//
function verifierSiExistePas($chaine,$libelle,$table,$champ,$obligatoire)
{
	$sql='SELECT * FROM '.$table.' WHERE '.$champ.'="'.$chaine.'"';
	$req=mysql_query($sql);$n=mysql_num_rows($req);
	if($n>0)
	{
		$this->cpt_erreurs++;
		$this->erreurs[$libelle]="Ce <b>$libelle</b> existe déjà ";			
	}

	if($obligatoire==1)
	{
		if(empty($chaine))
		{
			$this->cpt_erreurs++;
			$this->erreurs[$libelle]="Renseignez le champ <b>$libelle</b>";
		}	
	}		
}
//____________________________________________________________________________________________________________//
function krakSecurise($chaine)
{
    $chaine=trim(htmlspecialchars(mysql_real_escape_string($chaine)));
    return $chaine;
}
//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//____________________________________________________________________________________________________________//

//fin de la classe

}
?>
