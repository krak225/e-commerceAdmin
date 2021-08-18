<?php

namespace App\Services\Stdfn;
// use Illuminate\Http\Request;
use App\Etablissement;
use App\Pointage;
use App\UserProfilApplication;
use DB;
use Auth;

class Stdfn
{
	
	protected $author;
	
	
	
	//Renvoi une chaine sur un nombre de caractère défini	
	public static function truncate($text, $n){
		
		$strlen = strlen($text);
		
		if ($strlen == $n) {
			
			$text = $text;
			
		}elseif($strlen > $n){
		
			$text = substr($text,0,$n);
		
		}elseif($strlen < $n){
			
			$diff = $n - $strlen;
		
			for($i = 0; $i < $diff; $i++){
				
				$text.=' ';
			
			}
			
		}
		
		return $text;
		
	}

	//pour les nombre a précéder de x zéro (0000...)
	public static function truncateN($text, $n){
		
		$strlen = strlen($text);
		
		if ($strlen == $n) {
			
			$text = $text;
			
		}elseif($strlen > $n){
		
			$text = substr($text,0,$n);
		
		}elseif($strlen < $n){
			
			$diff = $n - $strlen;
			$zero = '';
			
			for($i = 0; $i < $diff; $i++){
				
				$zero.='0';
			
			}
			
			$text = $zero.$text;
			
		}
		
		return $text;
		
	}

	
	
	
	public static function debug($chaine){
		
		print '<pre>';print_r($chaine);print '</pre>';
		
	}
					
	public static function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	public static function RandomColor() {
		return '#'.Stdfn::random_color_part() . Stdfn::random_color_part() . Stdfn::random_color_part();
	}
	
			
	public static function generer_id(){
		
		srand((double)microtime()*1000000); 
		$id ="ID-".strtoupper(substr(md5(uniqid(rand())),0,7)); 

		return $id;
		
	}
		
		
	//fn pour convertir les dates
	public static function dateToDB($date){
		$date = str_replace('-','/',$date);
		sscanf($date, "%2s/%2s/%4s", $jj, $mm, $aaaa);
		$dbdate= !empty($aaaa) ?$aaaa.'-'.$mm.'-'.$jj : null;
		
		return $dbdate;
	}
	
	public static function dateFromDB($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s", $aaaa, $mm, $jj);
		$outdate=!empty($aaaa) ? $jj.'/'.$mm.'/'.$aaaa : null;
		return $outdate;
	}
	
	public static function dateTimeFromDB($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($aaaa) ? $jj.'/'.$mm.'/'.$aaaa.' à '.$hh.':'.$ii : null;
		return $outdate;
	}
	
	public static function timeFromDB($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($hh) ? $hh.':'.$ii : null;
		return $outdate;
	}
	
	public static function date($date){
		$date = str_replace('/','-',$date);
		sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $aaaa, $mm, $jj,$hh,$ii,$ss);
		$outdate=!empty($aaaa) ? $aaaa.'-'.$mm.'-'.$jj : null;
		
		
		return $outdate;
	}
	
	
	
	//Added on 02032021
	public static function SiActionAutorisee($action_code){
		
		$profil_id = Auth::user()->profil_id;
		
		
		$sql = 'select action_id
		from tb_autorisation
		inner join tb_action using(action_id)
		where action_code="'.$action_code.'"
		and profil_id="'.$profil_id.'"
		and autorisation_statut="VALIDE"
		';
		
		// die($sql);
		$data = DB::select($sql);
		
		
		if(!empty($data)){
			return true;
		}else{
			return false;
		}
		
	}
	
	
										
																	
	
	
}