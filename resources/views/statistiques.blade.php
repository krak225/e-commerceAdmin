@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Statistiques</li> 
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
	<h3 class="m-b-none">Graphe</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Évolution des perceptions
		
		<!--span> 
			<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" title="recherche" id="crtlBoxRecherche">Recherche avancée <b class="caret"></b></a> 
		</span-->
		
	</header> 
	
	<div class="panel-body dropdown" style="background:#d9edf7;" id="boxRecherche0"> 
		<div class="">
			<form class="form" method="get" action="">
				
				<!--{!! csrf_field() !!}-->
				
				<div class="row">
					
					<div class="col-md-12">
						
						<label class="col-md-1 control-label" style="padding-top: 5px;">Année</label>
						
						<div class="col-md-4">
							
							<select class="form-control" name="a" required>
								<option value="">Choisir</option>
								@foreach($liste_annees as $annee)
								<option @if($annee->exercice_comptable_id == $a) selected @endif value="{{ $annee->exercice_comptable_id }}">{{ $annee->exercice_comptable_id }}</option>
								@endforeach
							</select>
							
							
						</div>

						<label class="col-md-1 control-label" style="padding-top: 5px;">Mois</label>
						
						<div class="col-md-4">
							
							<select class="form-control" name="m" required>
								<option value="">Choisir</option>
								@foreach($liste_mois as $mois)
								<option @if($mois->mois_id == $m) selected @endif value="{{ $mois->mois_id }}">{{ $mois->mois_libelle }}</option>
								@endforeach
							</select>
							
						</div>

						<div class="col-md-2 pull-right">
								<button type="submit" class="btn btn-warning rounded"><i class="fa fa-search"></i> Rechercher</button>
							</div>
							
						</div>
						
					<!--div class="col-md-12" style="margin-top:7px;">
						
						<label for="date_debut" class="col-md-2 control-label">Date début</label>

						<div class="col-md-4">
							
							<input type="date" id="date_debut" class="form-control" name="db" value="" style="padding-top:0px;" required0 />
							
						</div>
					
						
						<label for="date_fin" class="col-md-2 control-label">Date fin</label>

						<div class="col-md-4">
							
							<input type="date" id="date_fin" class="form-control" name="df" value="" style="padding-top:0px;" required0 />
							
						</div>
					
					</div-->
					
					<hr/>
					
				</div>
				
				
			</form>
			
		</div>
	</div> 
	
	
<section class="panel panel-default"> 
	<header class="panel-heading font-bold">
		Évolution des perceptions du mois {{ $mois_selected->mois_libelle . ' ' . $a }} par Bureau
	</header> 
	<div class="panel-body"> 
		<div>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
			
			<canvas id="chart_gains" style="height:auto"></canvas>

			<script type="text/javascript">
			<!--
			// Bar chart
			new Chart(document.getElementById("chart_gains"), {
				type: 'bar',
				data: {
				labels: [<?php foreach($chart_statistiques as $gain){ echo '"'. $gain->bureau_libelle . '"'.',';}?>],
				  datasets: [
					{
					  label: "Montant perçu",
					  backgroundColor: [<?php foreach($chart_statistiques as $gain){ echo '"'.Stdfn::RandomColor().'"'.',';}?>],
					  data: [<?php foreach($chart_statistiques as $gain){ echo '"'.$gain->montant_total_perception.'"'.',';}?>]
					}
				  ]
				},
				options: {
					legend: { display: false },
					title: {
						display: true,
						text: "Évolution des perceptions du mois {{ $mois_selected->mois_libelle . ' ' . $a }} par Bureau"
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
		<!--div class="row text-center no-gutter"> 
		<div class="col-xs-3 b-r b-light"> 
			<span class="h4 font-bold m-t block">0</span> 
			<small class="text-muted m-b block">15 Mars 2018</small> 
		</div> 
		<div class="col-xs-3 b-r b-light"> 
			<span class="h4 font-bold m-t block">0</span> 
			<small class="text-muted m-b block">20 Septembre 2017</small> 
		</div> 
		<div class="col-xs-3 b-r b-light"> 
		<span class="h4 font-bold m-t block">0</span> 
		<small class="text-muted m-b block">17 Déc 2017</small> 
		</div> 
		<div class="col-xs-3"> 
		<span class="h4 font-bold m-t block">0</span> 
		<small class="text-muted m-b block">15 Mars 2018</small> 
		</div> 
		</div--> 
	</footer> 
	<br style="clear:both;"/> 
</section> 

@endsection