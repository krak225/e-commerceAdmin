@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Frais de livraison</li> 
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
	<h3 class="m-b-none">Gestion des frais de livraison</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau frais</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="{{route('SaveFraisLivraison')}}" class="form-horizontal">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12">
						<div class="col-md-3">
							<span> Départ <span class="text text-danger">*</span></span>
							<select class="form-control" name="commune_id_retrait" required>
								<option value="">Choisir</option>
								@foreach($communes as $commune)
								<option value="{{ $commune->commune_id }}">{{ $commune->commune_libelle }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="col-md-3">
							<span> Destination <span class="text text-danger">*</span></span>
							<select class="form-control" name="commune_id_livraison" required>
								<option value="">Choisir</option>
								@foreach($communes as $commune)
								<option value="{{ $commune->commune_id }}">{{ $commune->commune_libelle }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-3">
							<span> Frais <span class="text text-danger">*</span></span>
							<input type="text" class="form-control" name="montant" required />
						</div>

						<div class="col-md-3">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="submit" class="btn btn-success btn-sm">ENREGISTRER</button> 
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des frais de livraison
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Commune départ</th>
					<th width="">Commune destination</th>
					<th width="">Frais livraison</th>
					<th width="">Date création</th>
					<th width="">Statut</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($frais_livraison as $frais)
				<tr>
					<td></td> 
					<td>{{ $frais->lieu_retrait }}</td> 
					<td>{{ $frais->lieu_livraison }}</td> 
					<td>{{ $frais->frais_livraison_montant }}</td> 
					<td>{{ Stdfn::dateTimeFromDB($frais->frais_livraison_date_creation) }}</td>
					<td>{{ $frais->frais_livraison_statut }}</td>
					<td><span class="btnSupprimerFraisLivraison" data-frais_livraison_id="{{$frais->frais_livraison_id}}" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer ce frais de livraison"></i></a></td> 
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection