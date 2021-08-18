@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Categories</li> 
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
	<h3 class="m-b-none">Gestion des catégories</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouvelle catégorie</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="{{route('SaveCategorie')}}" class="form-horizontal">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					
					<div class="col-md-12">
						<div class="col-md-4">
							<span> Intitulé de la catégorie <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="libelle"  value="{{ old('libelle') }}" required>
						</div>
						<div class="col-md-4">
							<span> Parent <span class="text text-danger"></span></span>
							<select class="form-control" name="categorie_id_parent">
								<option value=""></option>
								@foreach($categories as $categorie)
								<option value="{{$categorie->categorie_id}}">{{$categorie->categorie_nom}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-4 ">
							<span> &nbsp;<span class="text text-danger"></span></span>
							<div class="form-control " style="padding:0px;border:none;">
								<button type="submit" class="btn btn-success btn-sm">ENREGISTRER</button> 
							</div>
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des catégories
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width="">N°</th>
					<th width="">Nom de la catégorie</th>
					<th width="">Catégorie parente</th>
					<th width="">Nombre produits</th>
					<th width="">Date enregistrement</th>
					<th width="">Statut</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($categories as $categorie)
				<tr>
					<td>{{ $categorie->categorie_id}}</td> 
					<td>{{ $categorie->categorie_nom }}</td> 
					<td>{{ $categorie->categorie_nom_parent }}</td> 
					<td>{{ $categorie->nombre_produits }}</td> 
					<td>{{ Stdfn::dateTimeFromDB($categorie->categorie_date_creation) }}</td>
					<td>{{ $categorie->categorie_statut }}</td>
					<td><span class="btnSupprimerCategorie" data-categorie_id="{{$categorie->categorie_id}}" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer cette catégorie"></i></a></td> 
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection