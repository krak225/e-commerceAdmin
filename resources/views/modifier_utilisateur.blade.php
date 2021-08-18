@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('utilisateurs') }}"><i class="fa fa-users"></i> Utilisateurs</a></li> 
	<li class="active">Modification de compte utilisateur</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modification d'un compte utilisateur</h3> 
</div>

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('message')}}
	</div>
@endif

@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Informations</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="{{route('ModifierUtilisateur',$user->id)}}">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group">
					<label for="login" class="col-md-4 control-label">Login</label>

					<div class="col-md-4">
						<input type="text" disabled class="form-control" value="{{ $user->email }}">
						
					</div>
				</div>

				<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
					<label for="nom" class="col-md-4 control-label">Nom</label>

					<div class="col-md-4">
						<input id="nom" type="text" class="form-control" name="nom" value="{{ $user->nom }}" required autofocus>

						@if ($errors->has('nom'))
							<span class="help-block">
								<strong>{{ $errors->first('nom') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('prenoms') ? ' has-error' : '' }}">
					<label for="prenoms" class="col-md-4 control-label">Prénoms</label>

					<div class="col-md-4">
						<input id="prenoms" type="text" class="form-control" name="prenoms" value="{{ $user->prenoms }}" required>

						@if ($errors->has('prenoms'))
							<span class="help-block">
								<strong>{{ $errors->first('prenoms') }}</strong>
							</span>
						@endif
					</div>
				</div>

				
				<div class="form-group{{ $errors->has('profil_id') ? ' has-error' : '' }}">
					<label for="profil_id" class="col-md-4 control-label">Profil <span class="text text-danger">&nbsp;<span></label>

					<div class="col-md-4">
						
						<select disabled id="profil_id" class="form-control" name="profil_id"required>
							<option></option>
							@foreach($profils as $profil)
							@if($user->profil_id == $profil->profilID){ 
								<?php $selected = ' selected '; ?>
							@else
								<?php $selected = '  '; ?>
							@endif
							<option {{$selected}} value="{{ $profil->profilID }}">{{ $profil->profilLibelle }}</option>
							@endforeach
						</select>
						@if ($errors->has('profil_id'))
							<span class="help-block">
								<strong>{{ $errors->first('profil_id') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				
				<div id="choose_ddc" class="form-group{{ $errors->has('ddc') ? ' has-error' : '' }}" style="display:none;">
					<label for="ddc" class="col-md-4 control-label">DDC <span class="text text-danger">&nbsp;<span></label>
					<div class="col-md-4">
						
						<select class="form-control" name="ddc">
							<option></option>
							@foreach($ddcs as $ddc)
							@if($user->id == $ddc->id){ 
								<?php $selected = ' selected '; ?>
							@else
								<?php $selected = '  '; ?>
							@endif
							<option {{ $selected }} value="{{ $ddc->id }}">{{ $ddc->nom . ' ' . $ddc->prenoms }}</option>
							@endforeach
						</select>
						
					</div>
				</div>
				
				
				<div class="form-group{{ $errors->has('bureau_id') ? ' has-error' : '' }}">
					<label for="bureau_id" class="col-md-4 control-label">Bureau <span class="text text-danger">&nbsp;<span></label>
					<div class="col-md-4">
						<select id="bureau_id" class="form-control" name="bureau_id" required>
							<option></option>
							@foreach($bureaux as $bureau)
							@if($user->bureauID == $bureau->bureauID){ 
								<?php $selected = ' selected '; ?>
							@else
								<?php $selected = '  '; ?>
							@endif
							<option {{ $selected }} value="{{ $bureau->bureauID }}">{{ $bureau->bureauLibelle }}</option>
							@endforeach
						</select>
						
					</div>
				</div>
				
				
				<div class="form-group{{ $errors->has('equipe_id') ? ' has-error' : '' }}">
					<label for="equipe_id" class="col-md-4 control-label">Equipe <span class="text text-danger">&nbsp;<span></label>
					<div class="col-md-4">
						<select id="equipe_id" class="form-control" name="equipe_id" required>
							<option></option>
							@foreach($equipes as $equipe)
							@if($user->equipe_id == $equipe->equipe_id){ 
								<?php $selected = ' selected '; ?>
							@else
								<?php $selected = '  '; ?>
							@endif
							<option {{ $selected }} value="{{ $equipe->equipe_id }}">{{ $equipe->equipe_nom }}</option>
							@endforeach
						</select>
						
					</div>
				</div>
				
				
				
				<div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
					<label for="telephone" class="col-md-4 control-label">Téléphone mobile</label>

					<div class="col-md-4">
						<input id="telephone" type="text" class="form-control" name="telephone" value="{{ $user->telephone }}" >

						@if ($errors->has('telephone'))
							<span class="help-block">
								<strong>{{ $errors->first('telephone') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="option_modifier_motdepasse" class="col-md-4 control-label">Modifier le mot de passe</label>

					<div class="col-md-4">
						<input type="checkbox" id="checkbox_option_modifier_motdepasse" name="option_modifier_motdepasse" value="1"> 
					</div>
				</div>
				
				<div id="box_motdepasse" style="display:none;">
					
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="col-md-4 control-label">Mot de passe</label>

						<div class="col-md-4">
							<input id="password" type="password" class="form-control" name="password">

							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group">
						<label for="password-confirm" class="col-md-4 control-label">Confirmer mot de passe</label>

						<div class="col-md-4">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
						
					</div>
				</div>
				
				
			</div> 
			
			
			<div class="line line-lg pull-in"></div>
			
			<div class="actions pull-right"> 
				<button type="reset" class="btn btn-warning btn-sm">Annuler</button> 
				<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER LES MODIFICATIONS</button> 
			</div>
			
		</form>
		
		 
	
	</div>
	
	
	
	
	
</div>
 
@endsection