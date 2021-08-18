<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
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

		<form class="form-horizontal panel-body wrapper-lg" method="POST" action="<?php echo e(route('login')); ?>">
			<?php echo e(csrf_field()); ?>

			
			<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
				<label for="email" class="col-md-4 control-label">Login</label>

				<div class="col-md-4">
					<input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

					<?php if($errors->has('email')): ?>
						<span class="help-block">
							<strong><?php echo e($errors->first('email')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
				<label for="password" class="col-md-4 control-label">Mot de passe</label>

				<div class="col-md-4">
					<input id="password" type="password" class="form-control" name="password" required>

					<?php if($errors->has('password')): ?>
						<span class="help-block">
							<strong><?php echo e($errors->first('password')); ?></strong>
						</span>
					<?php endif; ?>
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
					 
					<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
						Mot de passe oublié
					</a>
				</div-->
			</div>
		</form>
		
	</div>
	
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>