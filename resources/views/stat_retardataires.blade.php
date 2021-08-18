@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Statistiques des retardataires</li> 
</ul> 


@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('warning')}}
	</div>
@endif


<div class="m-b-md"> 
	<h3 class="m-b-none">Graphe des retardataires</h3> 
</div>

<section class="panel panel-default"> 

	<header class="panel-heading"> Sélectionner une période pour voir les retardataires
		<span> 
			<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" title="recherche" id="crtlBoxRecherche">Recherche avancée <b class="caret"></b></a> 
		</span>
	</header> 
	<div class="panel-body dropdown" style="background:#d9edf7;" id="boxRecherche"> 
		<div class="">
			<form class="form" method="get" action="{{ route('stat_retardataires') }}">
				
				<!--{!! csrf_field() !!}-->
				
				<div class="row">
					
					<div class="col-md-12" style="margin-top:7px;">
						
						<label for="date_debut" class="col-md-2 control-label">Date début</label>

						<div class="col-md-3">
							
							<input type="date" id="date_debut" class="form-control" name="db" value="{{ $date_debut }}" style="padding-top:0px;" required0 />
							
						</div>
					
						
						<label for="date_fin" class="col-md-2 control-label">Date fin</label>

						<div class="col-md-3">
							
							<input type="date" id="date_fin" class="form-control" name="df" value="{{ $date_fin }}" style="padding-top:0px;" required0 />
							
						</div>
						
						<div class="col-md-2 pull-right" style="">
							<button name="search" value="Rechercher" type="submit" class="btn btn-warning rounded"><i class="fa fa-search"></i> Rechercher</button>
						</div>
						
					</div>
					
					<hr/>
					
				</div>
				
				
			</form>
			
		</div>
	</div>
	
</section>	
	

<section class="panel panel-default"> 
	<header class="panel-heading font-bold">
		Etats des retardataires
	</header> 
	<div class="panel-body"> 
		<div>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
			
			<canvas id="chart_retards" style="height:auto"></canvas>

			<script type="text/javascript">
			<!--
			// Bar chart
			new Chart(document.getElementById("chart_retards"), {
				type: 'bar',
				data: {
					labels: [<?php foreach($users as $user){ echo '"'. $user->nom . ' ' . $user->prenoms . '"'.',';}?>],
					datasets: [
					{
					  label: "Nombre retards",
					  backgroundColor: [<?php foreach($users as $user){ echo '"'.Stdfn::RandomColor().'"'.',';}?>],
					  data: [<?php foreach($users as $user){ echo '"'.$user->nbre_retard.'"'.',';}?>]
					}
					]
				},
				options: {
					legend: { display: false },
					title: {
						display: true,
						text: "Nombre de retards par employé"
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});

			--> 
			</script>
		</div>

	</div> 
	<footer class="panel-footer bg-white no-padder"> 
		<div class="row text-center no-gutter"> 
		
		</div> 
	</footer> 
	<br style="clear:both;"/> 
</section> 

@endsection