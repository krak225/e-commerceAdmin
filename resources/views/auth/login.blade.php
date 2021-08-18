@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Connexion à la plateforme</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Connexion à la plateforme</h3> 
</div>


<section class="panel panel-default"> 
	<div class="row m-l-none m-r-none bg-light lter">
	
		<header class="panel-heading text-center"> 
			<!--strong>SE CONNECTER A LA PLATEFORME</strong--> 
		</header> 

		<form class="form-horizontal panel-body wrapper-lg" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-4 control-label">Login</label>

				<div class="col-md-4">
					<input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
			
				<div class="col-md-12 text-center">
				
					<button type="submit" class="btn btn-primary">
						SE CONNECTER
					</button>
				
				</div>
				
				<div class="col-md-8 text-center" style="padding:10px 0px;">
				
				</div>
				
				<!--div class="col-md-8 text-center" style="margin-left:120px;">
					 
					<a class="btn btn-link" href="{{ route('password.request') }}">
						Mot de passe oublié
					</a>
				</div-->
			</div>
		</form>
		
	</div>
	
</section>



@endsection