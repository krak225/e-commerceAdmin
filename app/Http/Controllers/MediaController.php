<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\CourrierFichier;
use App\TacheFichier;
use finfo;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	
    public function getImage($filename)
    {
		$path = '/storage/app/images/'.$filename;
		$type = "image/png";
		header('Content-Type:'.$type);
		header('Content-Length: ' . filesize($path));
		readfile($path);
		
    }
	
	
    public function ShowPieceJointe($id)
    {
		
		
		if(is_numeric($id)){
			
			$piecejointe = CourrierFichier::find($id);
			
			if(!empty($piecejointe)){
					
				$content 	= base64_decode($piecejointe->courrier_fichier_contenu);
				$mimetype 	= $piecejointe->courrier_fichier_mimetype;
				$filename 	= $piecejointe->courrier_fichier_nom;
				
				$headers = [
					'Content-type'        => $mimetype,
					'Content-Disposition' => 'attachment; filename="'.$filename.'"',
				];
				
				//si image, affiché
				if(in_array($piecejointe->courrier_fichier_extension, array('jpg','jpeg','png','gif'))){
					
					//display image
					return '<img src="data:image/jpeg;base64,'.$piecejointe->courrier_fichier_contenu.'"/>';
					
				}else{
					
					//download image
					return \Response::make($content, 200, $headers);
					
				}
				
				
			}else{
				
				return back()->with('warning','FICHIER INTROUVABLE');
				
			}
			
		}else{
			
			return back()->with('warning','FICHIER INTROUVABLE');
			
		}
		
    }
	
	
    public function ShowPieceJointeTache($id)
    {
		
		
		if(is_numeric($id)){
			
			$piecejointe = TacheFichier::find($id);
			
			if(!empty($piecejointe)){
					
				$content 	= base64_decode($piecejointe->tache_fichier_contenu);
				$mimetype 	= $piecejointe->tache_fichier_mimetype;
				$filename 	= $piecejointe->tache_fichier_nom;
				
				$headers = [
					'Content-type'        => $mimetype,
					'Content-Disposition' => 'attachment; filename="'.$filename.'"',
				];
				
				//si image, affiché
				if(in_array($piecejointe->tache_fichier_extension, array('jpg','jpeg','png','gif'))){
					
					//display image
					return '<img src="data:image/jpeg;base64,'.$piecejointe->tache_fichier_contenu.'"/>';
					
				}else{
					
					//download image
					return \Response::make($content, 200, $headers);
					
				}
				
				
			}else{
				
				return back()->with('warning','FICHIER INTROUVABLE');
				
			}
			
		}else{
			
			return back()->with('warning','FICHIER INTROUVABLE');
			
		}
		
    }
	

	function cript_image(){
		
		/*
	   //encrypt
	   $cipher = "aes-128-cbc";
	   $ivlen = openssl_cipher_iv_length($cipher);
	   $iv = openssl_random_pseudo_bytes($ivlen);
	   $key = openssl_random_pseudo_bytes(128);
	   $ciphertext = openssl_encrypt($image, $cipher, $key, $options=0, $iv);

	   
	   //decrpyt and display
	   $img = base64_encode(openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv));
	   
	   */
		
	}
	
	
	function PutOldPieceJointesContentInDB(){
		
		$piecesjointes = Piecejointe::where(['piecejointe_statut'=>'VALIDE'])->get();
		
		foreach($piecesjointes as $piecejointe){
			
			$filename = $this->escapefile_url('http://menuesdepenses11.com/images/'.$piecejointe->piecejointe_nom);
			
			$file_content = file_get_contents($filename);
			
			$file_info  = new finfo(FILEINFO_MIME_TYPE);
			$mimetype   = $file_info->buffer($file_content);
			
			$contenu 	= base64_encode($file_content);
			
			$piecejointe->piecejointe_contenu 			= $contenu;
			$piecejointe->piecejointe_mimetype 			= $mimetype;
			$piecejointe->piecejointe_mode_sauvegarde 	= 'DB';
			$piecejointe->exists 						= true;
			$piecejointe->save();
			
			
		}
		
		
		return 'OPERATION EFFECTUEE AVEC SUCCES';
		
		
	}
	
	function escapefile_url($url){
	  $parts = parse_url($url);
	  $path_parts = array_map('rawurldecode', explode('/', $parts['path']));

	  return
		$parts['scheme'] . '://' .
		$parts['host'] .
		implode('/', array_map('rawurlencode', $path_parts))
	  ;
	}
	
}
