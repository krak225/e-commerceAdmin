@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Création de compte utilisateur</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Création de compte utilisateur</h3> 
</div>

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('message')}}
	</div>
@endif


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Informations</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" id="formRegister" action="{{route('utilisateur')}}">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="nom" class="col-md-4 control-label">Nom</label>

					<div class="col-md-4">
						<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required autofocus>

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
						<input id="prenoms" type="text" class="form-control" name="prenoms" value="{{ old('prenoms') }}" required>

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
						
						<select id="profil_id" class="form-control" name="profil_id"required>
							<option value="">Choisir</option>
							@foreach($profils as $profil)
							<option value="{{ $profil->profil_id }}">{{ $profil->profil_libelle }}</option>
							@endforeach
						</select>

						@if ($errors->has('profil_id'))
							<span class="help-block">
								<strong>{{ $errors->first('profil_id') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('bureau_id') ? ' has-error' : '' }}">
					<label for="bureau_id" class="col-md-4 control-label">Bureau <span class="text text-danger">&nbsp;<span></label>
					<div class="col-md-4">
						
						<select id="bureau_id" class="form-control" name="bureau_id" required>
							<option value="">Choisir</option>
							@foreach($bureaux as $bureau)
							<option value="{{ $bureau->bureau_id }}">{{ $bureau->bureau_libelle }}</option>
							@endforeach
						</select>
						
					</div>
				</div>
				
				
				
				<div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
					<label for="telephone" class="col-md-4 control-label">Téléphone mobile</label>

					<div class="col-md-4">
						<input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" >

						@if ($errors->has('telephone'))
							<span class="help-block">
								<strong>{{ $errors->first('telephone') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-md-4 control-label">Login</label>

					<div class="col-md-4">
						<input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-md-4 control-label">Mot de passe</label>

					<div class="col-md-4">
						<input id="password" type="password" class="form-control" name="password" required>

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
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					
				</div>
				
				
			</div> 
			
			
			<div class="line line-lg pull-in"></div>
			
			<div class="actions pull-right"> 
				<button type="reset" class="btn btn-danger btn-sm">Annuler</button> 
				<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
			</div>
			
		</form>
		
		 
	
	</div>
	

	
</div>
 
@endsection