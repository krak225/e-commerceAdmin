@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Courses</li> 
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
	<h3 class="m-b-none">Gestion des courses</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des courses
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable "> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Client</th>
					<!--th width="">Téléphone</th-->
					<th width="">Nature de la course</th>
					<th width="">Départ</th>
					<th width="">Destination</th>
					<th width="">Frais</th>
					<th width="">Date</th>
					<th width="">Livraison</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($courses as $course)
				<tr>
					<td><a href="{{route('DetailsCourse',$course->course_id)}}"><i class="fa fa-info-circle text-info" title="Afficher les détails"></i></a></td> 
					<td>{{ ucfirst($course->utilisateur_login) }}</td>
					<!--td>{{ $course->utilisateur_telephone }}</td-->
					<td>{{ $course->nature_course }}</td>
					<td>{{ $course->commune_retrait_libelle }}</td>
					<td>{{ $course->commune_livraison_libelle }}</td>
					<td style="text-align: right;">{{ number_format($course->frais_livraison, 0, '', ' ') }}</td>
					<td>{{ Stdfn::dateFromDB($course->date_creation) }}</td>
					<td><span class="label label-{{strtolower(str_replace(' ','',$course->statut_livraison))}} ">{{ $course->statut_livraison }}</span></td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection