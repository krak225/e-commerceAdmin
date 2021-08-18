<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mon mot de passe</h3> 
</div>

<?php if(Session::has('message')): ?>
	<div class="alert alert-success">
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>

<?php if(Session::has('errors')): ?>
	<div class="alert alert-danger">
		<?php echo e($errors->first('new_password')); ?>

	</div>
<?php endif; ?>

<?php if(Session::has('authFailed')): ?>
	<div class="alert alert-danger">
	<?php echo e(Session::get('authFailed')); ?>

	</div>
<?php endif; ?>

<section class="panel panel-default"> 
	<div class="row m-l-none m-r-none bg-light lter">
	
		<header class="panel-heading text-center"> 
			<strong></strong> 
		</header> 

		<form class="form-horizontal panel-body wrapper-lg" method="post" action="<?php echo e(route('updatePassword')); ?>">
			<?php echo e(csrf_field()); ?>


			<div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
				<label for="current_password" class="col-md-4 control-label">Mot de passe actuel</label>

				<div class="col-md-4">
					<input id="current_password" type="password" class="form-control" name="current_password" value="<?php echo e(old('current_password')); ?>" required autofocus>

					<?php if($errors->has('current_password')): ?>
						<span class="help-block">
							<strong><?php echo e($errors->first('current_password')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<div class="form-group">
				<label for="new_password" class="col-md-4 control-label">Nouveau Mot de passe</label>

				<div class="col-md-4">
					<input id="new_password_confirmation" type="password" class="form-control <?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>" name="new_password_confirmation" required>

					
				</div>
			</div>

			
			<div class="form-group">
				<label for="new_password" class="col-md-4 control-label">Confirmer le nouveau Mot de passe</label>

				<div class="col-md-4">
					<input id="new_password" type="password" class="form-control <?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>" name="new_password" required>

				</div>
			</div>

			
			<div class="form-group">
				<label class="col-md-4 control-label">&nbsp;</label>
				<div class="col-md-4">
					<input type="submit" class="btn btn-primary" value="Valider"/>
				</div>
			</div>

		</form>
		
	</div>
	
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>