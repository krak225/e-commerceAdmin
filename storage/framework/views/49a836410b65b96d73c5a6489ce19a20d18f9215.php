<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Autorisations</li> 
</ul> 


<?php if(Session::has('warning')): ?>
	<div class="alert alert-warning">
	  <?php echo e(Session::get('warning')); ?>

	</div>
<?php endif; ?>

<?php if(Session::has('message')): ?>
	<div class="alert alert-success">
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>


<div class="m-b-md"> 
	<h3 class="m-b-none">Gestion des autorisation</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouvelle autorisation</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveAutorisation')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12 row">	
						
						
						<div class="col-md-4 form-group<?php echo e($errors->has('profil_id') ? ' has-error' : ''); ?>">
							<label for="profil_id" class="col-md-12">Profil</label>

							<div class="col-md-12">
								<select id="profil_id" class="form-control" name="profil_id"required>
									<option></option>
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

						<div class="col-md-4 form-group<?php echo e($errors->has('action_id') ? ' has-error' : ''); ?>">
							<label for="action_id" class="col-md-12">Action</label>

							<div class="col-md-12">
								<select id="action_id" class="form-control" name="action_id"required>
									<option></option>
									<?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($action->action_id); ?>"><?php echo e($action->action_libelle); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>

								<?php if($errors->has('action_id')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('action_id')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						
						<div class="col-md-4">
							<label for="prenoms" class="col-md-12">&nbsp;</label>
							<div class="col-md-12">
								<button type="submit" class="btn btn-warning btn-sm rounded">ENREGISTRER</button> 
							</div>
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
	</div>
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des autorisations</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width="">Profil</th>
					<th width="">Action</th>
					<th width="">Date autorisation</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $autorisations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autorisation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($autorisation->profil_libelle); ?></td>
					<td><?php echo e($autorisation->action_libelle); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($autorisation->autorisation_date_creation)); ?></td>
					<td><!--input type="checkbox" data-toggle="toggle" data-on="Activer" data-off="Désactiver"-->
						<input class="btn_toogle_autorisation" data-autorisation_id="<?php echo e($autorisation->autorisation_id); ?>" type="checkbox" <?php if($autorisation->autorisation_statut=="VALIDE"): ?> checked <?php endif; ?> data-toggle="toggle" data-on="<i class='fa fa-check'></i> Activé" data-off="<i class='fa fa-times'></i> Désactivé">
						<!--label class="switch">
						  <input type="checkbox">
						  <span class="slider round"></span>
						</label-->
					</td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<style type="text/css">
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;border: 1px solid red;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  display: none;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>