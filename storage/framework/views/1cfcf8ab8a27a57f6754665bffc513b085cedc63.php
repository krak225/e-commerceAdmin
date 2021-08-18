<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Responsabilités</li> 
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
	<h3 class="m-b-none">Gestion des Responsabilités</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouvelle responsabilité</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveResponsableService')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12 row">	
						
						
						<div class="col-md-4 form-group<?php echo e($errors->has('service_id') ? ' has-error' : ''); ?>">
							<label for="service_id" class="col-md-12">Service</label>

							<div class="col-md-12">
								<select id="service_id" class="form-control" name="service_id"required>
									<option></option>
									<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($service->service_id); ?>"><?php echo e($service->service_nom); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>

								<?php if($errors->has('service_id')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('service_id')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-4 form-group<?php echo e($errors->has('user_id') ? ' has-error' : ''); ?>">
							<label for="user_id" class="col-md-12">Utilisateur responsable</label>

							<div class="col-md-12">
								<select id="user_id" class="form-control" name="user_id"required>
									<option></option>
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($user->id); ?>"><?php echo e($user->nom.' '.$user->prenoms); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>

								<?php if($errors->has('user_id')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('user_id')); ?></strong>
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
	<header class="panel-heading"> Liste des responsables des services</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width="">Service</th>
					<th width="">Utilisateur</th>
					<th width="">Date début</th>
					<th width="">Date fin</th>
					<th width="">Statut</th>
					<!--th width="">Date création</th-->
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $responsables_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($rs->service_nom); ?></td>
					<td><a href="<?php echo e(route('DetailsUtilisateur',$rs->id)); ?>"> <?php echo e($rs->nom.' '.$rs->prenoms); ?></a></td>
					<td><?php echo e(Stdfn::dateFromDB($rs->responsable_service_date_debut)); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($rs->responsable_service_date_fin)); ?></td>
					<td><?php echo e($rs->responsable_service_statut); ?></td>
					<!--td><?php echo e(Stdfn::dateFromDB($rs->responsable_service_date_creation)); ?></td-->
					<td></td>
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