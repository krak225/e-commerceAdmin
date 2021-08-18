@extends('layouts.app')

@section('content')
@if(!empty($commande))
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('commandes') }}">Commandes</a></li> 
	<li class="active">Commande N°{{ Stdfn::truncateN($commande->commande_id,5) }}</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Commande N°{{ Stdfn::truncateN($commande->commande_id,5) }}</h3>
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
							<small style="color:white;">Informations sur la commande</small>
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="list-group no-radius alt"> 
						<div class="list-group-item"> 
							<span class="badge bg-light" style="background: none;"><span class="label label-default" style="font-size: 100%;">{{ Stdfn::truncateN($commande->commande_id,5) }}</span></span> 
							<i class="fa fa- icon-muted"></i> Numéro 
						</div> 
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $commande->nom.' '.$commande->prenoms }}</span> 
							<i class="fa fa- icon-muted"></i> Nom du client 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ number_format($commande->commande_montant_ttc, 0, '', ' ') }} FCFA</span> 
							<i class="fa fa- icon-muted"></i> Montant total
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ Stdfn::dateTimeFromDB($commande->commande_date_creation) }}</span> 
							<i class="fa fa- icon-muted"></i> Date commande
						</span>
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $commande->commande_statut }}</span> 
							<i class="fa fa- icon-muted"></i> Statut
						</span> 
						
						<span class="list-group-item"> 
							<span class="badge " style="background:none;">@if($commande->commande_statut_livraison == "NON LIVREE")<span id="btnChangerStatutLivraisonCommande" data-commande_id="{{$commande->commande_id}}" class="btn btn-sm btn-default" style="display: inline-block;padding:0px 10px;">Changer le statut</span> @endif <span class="label label-{{ strtolower(str_replace(' ', '',$commande->commande_statut_livraison)) }}">{{ $commande->commande_statut_livraison }}</span></span> 
							<i class="fa fa- icon-muted"></i> Statut livraison 
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
							<small style="color:white">Divers</small>
							
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div>
						<div style="height:200px;max-height:200px;overflow:auto;">
							<table class="table table-responsive" id="table_pieces_jointes"> 
								<tr>
									<td> 
									</td>
								</tr>
							</table> 
						</div>
					</div> 
				</section> 
			 	

			</div> 
		
		
			
		</div> 
		</div> 
		
		<br style="clear:both;"/>	
</div>

			<div class="line line-lg pull-in"></div>
				
			
<section class="panel panel-default"> 
	<header class="panel-heading"> Contenu de la commande
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Image</th>
					<th width="">Nom</th>
					<th width="">Catégorie</th>
					<th width="">Prix unitaire</th>
					<th width="">Quantité</th>
					<th width="">Total</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($produits as $produit)
				<tr>
					<td><a href="{{route('DetailsProduit',$produit->produit_id)}}"><i class="fa fa-cogs text-info" title="Afficher les détails"></i></a></td> 
					<td><img src="{{asset('images/produits/'.$produit->produit_photo) }}" style="width:50px;height:auto;"/></td> 
					<td>{{ $produit->produit_nom }}</td>
					<td>{{ $produit->categorie_nom }}</td>
					<td style="text-align: right;">{{ number_format($produit->panier_produit_pu, 0, '', ' ') }}</td>
					<td style="text-align: center;">{{ $produit->panier_quantite }}</td>
					<td style="text-align: right;font-weight:bold;">{{ number_format($produit->panier_produit_pu * $produit->panier_quantite, 0, '', ' ')}}  FCFA</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

			
		 
		
		</div>
		
	</div>

		</div>

	</div>


@else

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('commandes') }}">Commandes</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Commande introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		La commande que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

@endif

@endsection