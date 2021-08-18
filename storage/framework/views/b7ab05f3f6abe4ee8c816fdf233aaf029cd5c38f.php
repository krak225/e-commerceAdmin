<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Création de compte utilisateur</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Création de compte utilisateur</h3> 
</div>

<?php if(Session::has('message')): ?>
	<div class="alert alert-success">
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Informations</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" id="formRegister" action="<?php echo e(route('utilisateur')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="nom" class="col-md-4 control-label">Nom</label>

					<div class="col-md-4">
						<input id="nom" type="text" class="form-control" name="nom" value="<?php echo e(old('nom')); ?>" required autofocus>

						<?php if($errors->has('nom')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('nom')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('prenoms') ? ' has-error' : ''); ?>">
					<label for="prenoms" class="col-md-4 control-label">Prénoms</label>

					<div class="col-md-4">
						<input id="prenoms" type="text" class="form-control" name="prenoms" value="<?php echo e(old('prenoms')); ?>" required>

						<?php if($errors->has('prenoms')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('prenoms')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('profil_id') ? ' has-error' : ''); ?>">
					<label for="profil_id" class="col-md-4 control-label">Profil <span class="text text-danger">&nbsp;<span></label>

					<div class="col-md-4">
						
						<select id="profil_id" class="form-control" name="profil_id"required>
							<option value="">Choisir</option>
							<?php $__currentLoopData = $profils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($profil->profil_id); ?>"><?php echo e($profil->profil_libelle); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>

						<?php if($errors->has('profil_id')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('profil_id')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('bureau_id') ? ' has-error' : ''); ?>">
					<label for="bureau_id" class="col-md-4 control-label">Bureau <span class="text text-danger">&nbsp;<span></label>
					<div class="col-md-4">
						
						<select id="bureau_id" class="form-control" name="bureau_id" required>
							<option value="">Choisir</option>
							<?php $__currentLoopData = $bureaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bureau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($bureau->bureau_id); ?>"><?php echo e($bureau->bureau_libelle); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						
					</div>
				</div>
				
				
				
				<div class="form-group<?php echo e($errors->has('telephone') ? ' has-error' : ''); ?>">
					<label for="telephone" class="col-md-4 control-label">Téléphone mobile</label>

					<div class="col-md-4">
						<input id="telephone" type="text" class="form-control" name="telephone" value="<?php echo e(old('telephone')); ?>" >

						<?php if($errors->has('telephone')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('telephone')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				
				<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
					<label for="email" class="col-md-4 control-label">Login</label>

					<div class="col-md-4">
						<input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

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
					<label for="password-confirm" class="col-md-4 control-label">Confirmer mot de passe</label>

					<div class="col-md-4">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						<?php if($errors->has('password')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('password')); ?></strong>
							</span>
						<?php endif; ?>
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
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>