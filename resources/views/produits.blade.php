@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Produits</li> 
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

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="padding-left: 5px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="m-b-md"> 
	<h3 class="m-b-none">Gestion des produits</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau produit</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="{{route('SaveProduit')}}" enctype="multipart/form-data" class="form-horizontal">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group{{ $errors->has('produit_nom') ? ' has-error' : '' }}">
					
					<div class="col-md-12 row">
						
						<div class="col-md-5">
							<span> Nom du produit <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="produit_nom"  value="{{ old('produit_nom') }}" required>
						</div>
						
						<div class="col-md-5">
							<span> Description<span class="text text-danger"></span></span>
							<input style="padding-top:0px;" placeholder="" type="text" class="form-control" name="produit_description" value="{{ old('produit_description') }}">
						</div>
						
						<div class="col-md-2">
							<span> Prix<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="number" class="form-control" name="produit_prix" required> 
						</div>

					</div>
					
					<div class="col-md-12 row" style="margin-top:10px;">	
						
						<div class="col-md-5">
							<span> Photo<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="file" class="form-control" name="produit_photo" required>
							
						</div>
						
						<div class="col-md-4">
							<span> Catégorie <span class="text text-danger">*</span></span>
							<select class="form-control" name="categorie_id" required>
								<option value="">Choisir</option>
								@foreach($categories as $categorie)
								<option value="{{ $categorie->categorie_id }}">{{ $categorie->categorie_nom }}</option>
								@endforeach
							</select>
						</div>
						
						<!--div class="col-md-2">
							<span> Stock<span class="text text-danger"></span></span>
							<input style="padding-top:0px;" placeholder="" type="number" class="form-control" name="produit_stock" value="{{ old('produit_stock') }}" >
														
						</div-->
						
						<div class="col-md-2">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="submit" class="btn btn-success btn-sm rounded">ENREGISTRER</button> 
						</div>
						
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des produits
		<!--div class="actions pull-right" style="padding:0px;"> 
			<a class="btn btn-sm btn-info" href="{{route('produits')}}" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouveau</a>
		</div-->
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable "> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width=""></th>
					<th width="">Image</th>
					<th width="">Nom</th>
					<th width="">Catégorie</th>
					<th width="">Prix</th>
					<th width="">Date création</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($produits as $produit)
				<tr>
					<td><a href="{{route('DetailsProduit',$produit->produit_id)}}"><i class="fa fa-cogs text-info" title="Afficher les détails"></i></a></td> 
					<td><span class="btnModifierProduit" data-produit_id="{{$produit->produit_id}}" style="cursor: pointer;"><i class="fa fa-edit text-warning" title="Modifier"></i></span></td> 
					<td><img src="{{asset('images/produits/'.$produit->produit_photo) }}" style="width:50px;height:auto;"/></td> 
					<td>{{ $produit->produit_nom }}</td>
					<td>{{ $produit->categorie_nom }}</td>
					<td style="text-align: right;">{{ number_format($produit->produit_prix, 0, '', ' ') }}</td>
					<td>{{ Stdfn::dateFromDB($produit->produit_date_creation) }}</td>
					<td><span class="btnSupprimerProduit" data-produit_id="{{$produit->produit_id}}" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer ce produit"></i></a></td> 
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection