@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Commandes</li> 
</ul> 


@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('message')}}
	</div>
@endif


<div class="m-b-md"> 
	<h3 class="m-b-none">Gestion des commandes</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des commandes</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">N° commande</th>
					<th width="">Nom du client</th>
					<th width="">Montant</th>
					<th width="">Date</th>
					<th width="">Livraison</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($commandes as $commande)
				<tr>
					<td><a href="{{route('DetailsCommande',$commande->commande_id)}}"><i class="fa fa-info-circle text-info" title="Afficher les détails"></i></a></td> 
					<td><span class="label label-default">{{ Stdfn::truncateN($commande->commande_id, 5) }}</span></td> 
					<td>{{ $commande->nom.' '.$commande->prenoms }}</td> 
					<td>{{ $commande->commande_montant_ttc }}</td> 
					<td>{{ Stdfn::dateFromDB($commande->commande_date_creation) }}</td>
					<td><span class="label label-default" class="label label-{{strtolower(str_replace(' ','',$commande->commande_statut_livraison))}} ">{{ $commande->commande_statut_livraison }}</span></td>
					<td><span class="label label-{{strtolower(str_replace(' ','',$commande->commande_statut))}} ">{{ $commande->commande_statut }}</span></td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection