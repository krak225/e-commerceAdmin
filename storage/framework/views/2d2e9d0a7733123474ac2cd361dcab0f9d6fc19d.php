<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Tâches</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Création d'une diligence</h3> 
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
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('SaveTache')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="libelle" class="col-md-4 control-label">Libellé <span class="text text-danger">*<span></label></label>

					<div class="col-md-8">
						<input id="libelle" type="text" class="form-control" name="libelle" value="<?php echo e(old('libelle')); ?>" required autofocus>

						<?php if($errors->has('libelle')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('libelle')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('categorie_tache_id') ? ' has-error' : ''); ?>">
					<label for="categorie_tache_id" class="col-md-4 control-label">Catégorie <span class="text text-danger">*<span></label>
					<div class="col-md-8">
						<select id="categorie_tache_id" class="form-control" name="categorie_tache_id" required>
							<option value="">Choisir</option>
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($categorie->categorie_tache_id); ?>"><?php echo e($categorie->categorie_tache_libelle); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
					<label for="description" class="col-md-4 control-label">Description</label>

					<div class="col-md-8">
						<textarea id="description" class="form-control" name="description" value="<?php echo e(old('description')); ?>" required></textarea>

						<?php if($errors->has('description')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('description')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('critere_evaluation') ? ' has-error' : ''); ?>">
					<label for="critere_evaluation" class="col-md-4 control-label">Indicateurs de fin</label>

					<div class="col-md-8">
						<textarea id="critere_evaluation" class="form-control" name="critere_evaluation" value="<?php echo e(old('critere_evaluation')); ?>" required></textarea>

						<?php if($errors->has('critere_evaluation')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('critere_evaluation')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('assignee_a_user_id') ? ' has-error' : ''); ?>">
					<label for="assignee_a_user_id" class="col-md-4 control-label">Affectuée à <span class="text text-danger">&nbsp;<span></label>
					<div class="col-md-8">
						
						<select multiple data-placeholder="Sélection multiple autorisée" id="assignee_a_user_id" class="form-control" name="assignee_a_user_id[]" required style="padding: 0px;">
							<option value=""></option>
							<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($user->id); ?>"><?php echo e($user->prenoms.' '.$user->nom); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						
					</div>
				</div>
				
				
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="date_debut" class="col-md-4 control-label">Date début prévu /Date fin prévu  </label>

					<div class="col-md-4">
						<input id="date_debut" type="date" class="form-control" name="date_debut_prevu" value="<?php echo e(old('date_debut')); ?>" required autofocus>

						<?php if($errors->has('date_debut')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('date_debut')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
					
					<div class="col-md-4">
						<input id="date_fin" type="date" class="form-control" name="date_fin_prevu" value="<?php echo e(old('date_fin')); ?>" required autofocus>

						<?php if($errors->has('date_fin')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('date_fin')); ?></strong>
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