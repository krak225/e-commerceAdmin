@extends('layouts.app')

@section('content')
@if(!empty($produit))
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('produits') }}">Produits</a></li> 
	<li class="active">{{ ucfirst(strtolower($produit->produit_nom)) }}</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">{{ $produit->produit_nom }}</h3>
</div>

@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif

<style type="text/css">
<!--
.title{
	padding:0px 15px;
}

.dz-preview, .dz-file-preview {
    display: none;
}
#table_justifs{
    border: 1px solid #eee;
	margin-top:0px;
}
#table_justifs th{
    background:#eee;	
}


.select-checkbox option::before {
  content: "\2610";
  width: 1.3em;
  text-align: center;
  display: inline-block;
}
.select-checkbox option:checked::before {
  content: "\2611";
}


ul.no_liste_item li {
  list-style:none;
}

.bold{font-weight:bold;}

-->
</style>

<div class="panel panel-default"> 

		<div class="col-lg-12" style="padding-top:15px;padding-left: 0px;padding-right: 0px;"> 
		<div class="row0"> 
			
			<div class="col-sm-7"> 
				<section class="panel panel-default"> 
					<header class="panel-heading bg-info lt no-border title"> 
						<div class="clearfix"> 
							<div class="clear"> 
							<div class="h3 m-t-xs m-b-xs text-white">
							<small style="color:white;">Informations sur le produit</small>
							<span class="btnModifierProduit pull-right " data-produit_id="{{$produit->produit_id}}" style="cursor: pointer;"><i class="fa fa-edit text-white" title="Modifier"></i></span>
						
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="list-group no-radius alt"> 
						<div class="list-group-item"> 
							<span class="badge bg-light" style="background: none;"><span class="label label-default" style="font-size: 100%;">{{ Stdfn::truncateN($produit->produit_id,5) }}</span></span> 
							<i class="fa fa- icon-muted"></i> Numéro du produit
						</div> 
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $produit->produit_nom }}</span> 
							<i class="fa fa- icon-muted"></i> Nom du produit 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $produit->categorie_nom }}</span> 
							<i class="fa fa- icon-muted"></i> Catégorie
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ Stdfn::dateTimeFromDB($produit->produit_date_creation) }}</span> 
							<i class="fa fa- icon-muted"></i> Date enregistrement
						</span> 
						

					</div> 
					
				</section>
			</div>
			
			
			
			<div class="col-sm-5"> 
			
				<section class="panel panel-default">
					<header class="panel-heading bg-info lt no-border title"> 
						<div class="clearfix"> 
							<div class="clear"> 
							<div class="h3 m-t-xs m-b-xs text-white">
							<small style="color:white">Photo principale</small>
							
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="col-md-12" style="padding:0px;">
						<div style="height:200px;max-height:200px;overflow:auto;">
							<table class="table table-responsive" id="table_pieces_jointes"> 
								<tr>
									<td> 
										<img src="{{asset('images/produits/'.$produit->produit_photo) }}" style="width:100%;height:auto;"/>
									</td>
								</tr>
							</table>    
						</div>

						<form method="post" action="{{route('UpdateProduitPhoto', $produit->produit_id)}}" enctype="multipart/form-data" class="dropzone" id="dropzone_principale">
							{!! csrf_field() !!}
							<div class="dz-message btn btn-sm btn-default col-md-12">
								<span>
									<span class="fa-stack fa-2x pull-left m-r-sm"> 
										<i class="fa fa-circle fa-stack-2x text-warning"></i> 
										<i class="fa fa-edit fa-stack-1x text-white"></i> 
									</span> 
									Modifier la photo
								</span>
							</div>
						</form>
					</div> 
					<br style="clear: both;"/>
				</section> 
			 	

			</div> 
		
		
			
		</div> 
		</div> 
		
		<br style="clear:both;"/>	
</div>

					<div class="line line-lg pull-in"></div>
					
					<div class="panel panel-default" style="padding-bottom:10px;"> 
												
						<script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
						<script src="{{ asset('js/dropzone.js') }}"></script>

						<script type="text/javascript">

						var my_login =  '{{Auth::user()->email}}';


						Dropzone.options.dropzone =
						{
							paramName: "produits_fichiers",
							disablePreview: true,
							capture: null,
							dictDefaultMessage: "Déverser les images ici !",
							maxFilesize: 5,
							renameFile: function(file) {
								var dt = new Date();
								var time = dt.getTime();
							   // return time+file.name;
							   return file.name;
							},
							acceptedFiles: ".jpeg,.jpg,.png",
							addRemoveLinks: false,
							timeout: 5000,
							success: function(file, response) 
							{
								
								this.removeFile(file);
								
								var img_preview_src = '{{asset("images/produits")}}/'+response.autreimage_photo;
								
								$('#table_fichiers_traitement').append('<a target="_blank" href="{{ route("ShowPieceJointe","")}}/'+response.autreimage_id+' " title="'+response.autreimage_photo+'" class="apercu_fichier"><img src="'+img_preview_src+'" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/></a>');
								
								
							},
							error: function(file, response)
							{
							   return false;
							}
						};


							var csrf_token = $('meta[name="csrf-token"]').attr('content');
							var base_url = $("#eco_base_url").val();
							var base_url = '{{'http://'.$_SERVER['HTTP_HOST']}}/';
							
							function SupprimerPieceJointe(piecejointe_id, ligne_selectionnee){
								
								var url 			= base_url+'supprimerpiecejointe';
								var url_ok 	 		= '';
								
								noty({
									dismissQueue: false,
									force: true,
									layout:'center',
									modal: true,
									theme: 'defaultTheme',
									text:"Voulez-vous supprimer ce fichier ?",
									type: "information",
									buttons: [{addClass: 'btn btn-danger ', text: 'Supprimer', onClick: function($noty) {
									   $noty.close();
											
											$.ajax({
												headers:{'X-CSRF-TOKEN': csrf_token},
												type:'post',
												url: url,
												data: {piecejointe_id:piecejointe_id},
												success: function(e){
													
													if(e == 1){
														
														$('#ligne_pj'+piecejointe_id).hide();
														// ligne_selectionnee.hide();
														// location.href = url_ok;
														// notification("Suppression effectuée avec succès","success");
														
													}else if(e == 2){
														
														// notification("Vous ne pouvez pas supprimer cet fichier","warning");
														
													}else{
														
														// notification("Erreur lors de la suppression du fichier","error");
														
													}
													
												},
												error: function(){
													
													// notification("Erreur lors de la suppression du fichier","error");
													
												}
											});
											
									
										
									   }},
									   {addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
											$noty.close();
										
									   
									   }}]
								});
								
								
							}

						</script>

						<style type="text/css">
						<!--
						.title{
							padding:0px 15px;
						}

						.dz-preview, .dz-file-preview {
							display: none;
						}
						#table_justifs{
							border: 1px solid #eee;
							margin-top:0px;
						}
						#table_justifs th{
							background:#eee;	
						}
						-->
						</style>

										
						<div class="col-sm-12" style="padding:0px;"> 
							<section class="panel panel-default"> 
								<header class="panel-heading bg-info lt no-border title"> 
									<div class="clearfix"> 
										<div class="clear"> 
										<div class="h3 m-t-xs m-b-xs text-white">
										<small style="color:white;">Plus de photos</small>
										<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
										</div>  
										</div> 
									</div> 
								</header> 
							</section>
						</div>

						<div class="row col-lg-12"> 
							
							<div class="col-sm-12"> 

								<div class="col-md-5" style="border-right:1px dotted #eee;">
									<form method="post" action="{{route('UpdateFichiers',[$produit->produit_id])}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
										{!! csrf_field() !!}
										<div style="height:120px;" class="dz-message rounded0 btn btn-sm btn-default" data-dz-message>
											<span>
												<span class="fa-stack fa-2x pull-left m-r-sm"> 
													<i class="fa fa-circle fa-stack-2x text-info"></i> 
													<i class="fa fa-camera fa-stack-1x text-white"></i> 
												</span> 
												Déverser les images ici !
											</span>
										</div>
									</form>
								</div>
								<div class="col-md-7" id="table_fichiers_traitement">
									
									@foreach($piecesjointes as $fichier)
									<a target="_blank" href="{{ route('ShowPieceJointe',$fichier->autreimage_id) }}" class="apercu_fichier">
										<img src="{{asset('images/produits/'.$fichier->autreimage_photo) }}" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/>
									</a>
									@endforeach
								</div>
								
							</div>
							
						</div>

						<br style="clear:both;"/>
					
					</div>
					
					
					
				</div> 
				
			 
		
		</div>
		
	</div>

		</div>

	</div>


@else

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('produits') }}">Produits</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Produit introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		Le produit que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

@endif

@endsection