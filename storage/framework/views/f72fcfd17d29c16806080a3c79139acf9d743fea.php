<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('todoHome')); ?>"> TodoAPP</a></li>   
	<li class="active">Réunions</li> 
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
	<h3 class="m-b-none">Gestion des réunions <?php if(!empty($selected_type_reunion)): ?>  <?php echo e(' du '. $selected_type_reunion->type_reunion_libelle); ?> <?php endif; ?></h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Ajouter une réunion</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveReunion')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					
					<div class="col-md-12">
					
						<span> Libellé <span class="text text-danger">*</span></span>
						<input placeholder="ex: Réunion du <?php echo gmdate('y-m-Y') ?>" type="text" class="form-control" name="reunion_libelle"  value="<?php echo e(old('reunion_libelle')); ?>" required>
						
					</div>
					
					<div class="col-md-12 row" style="margin-top:10px;">	
						
						<div class="col-md-3">
							<span> Type de réunion<span class="text text-danger">*</span></span>
							<select class="form-control" name="type_reunion" required>
								<option value="">Choisir</option>
								<?php $__currentLoopData = $types_reunion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php $selected = ($selected_type_reunion_id == $type->type_reunion_id)? ' selected ' : '';?>
									<option <?php echo e($selected); ?> value="<?php echo e($type->type_reunion_id); ?>"><?php echo e($type->type_reunion_abreviation); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							
						</div>
						
						<div class="col-md-3">
							<span> Date <span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="date" class="form-control" name="reunion_date" value="<?php echo e(old('reunion_date')); ?>" required>
							
						</div>
						
						<div class="col-md-2">
							<span> Heure début <span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="time" class="form-control" name="heure_debut" value="<?php echo e(old('heure_debut')); ?>" required>
							
						</div>
						<div class="col-md-2">
							<span> Heure Fin <span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="time" class="form-control" name="heure_fin" value="<?php echo e(old('heure_fin')); ?>" required>
							
						</div>
						
						
						<div class="col-md-1">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="submit" class="btn btn-warning btn-sm">ENREGISTRER</button> 
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des réunions <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width=""></th>
					<th width="">Libellé de la réunion</th>
					<th width="">Type</th>
					<th width="">Date</th>
					<th width="">Heure Début</th>
					<th width="">Heure Fin</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $reunions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reunion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('taches',$reunion->reunion_id)); ?>"><i class="fa fa-cogs text-info" title="Gérer les tâches"></i></a></td> 
					<td><a href="<?php echo e(route('taches_liste',$reunion->reunion_id)); ?>"><i class="fa fa-list text-warning" title="Liste des tâches"></i></a></td> 
					<td><?php echo e($reunion->reunion_libelle); ?></td> 
					<td><?php echo e($reunion->type_reunion_abreviation); ?></td> 
					<td><?php echo e(Stdfn::dateFromDB($reunion->reunion_date)); ?></td>
					<td><span class="heure_confirme"><?php echo e(Stdfn::timeFromDB($reunion->reunion_date_debut)); ?></span></td>
					<td><span class="heure_confirme"><?php echo e(Stdfn::timeFromDB($reunion->reunion_date_fin)); ?></span></td>
					<td><?php echo e($reunion->reunion_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>