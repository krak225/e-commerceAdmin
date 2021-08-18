@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Statistiques prospection</li> 
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
	<h3 class="m-b-none">Statistiques par utilisateur</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Statistiques des prospections par utilisateur</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<!--th width="30%">Equipe</th-->
					<th width="30%">Nom & Prénoms</th>
					<th width="15%">Login</th>
					<th width="15%">Date saisie</th>
					<th width="10%">Nombre</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($users as $user)
				<tr>
					<!--td>{{ $user->equipe_nom }}</td-->
					<td><a href="{{ route('DetailsProspecteur',$user->id) }}">{{ $user->nom .' '. $user->prenoms }}</a></td> 
					<td>{{ $user->email }}</td> 
					<td>{{ Stdfn::dateFromDB($user->date_saisie) }}</td>
					<td style="text-align:center;">{{ $user->total }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div>
	
</section>

@endsection