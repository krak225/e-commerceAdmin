<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Actions</li> 
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
	<h3 class="m-b-none">Gestion des actions</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouvelle action</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveAction')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12 row">	
						
						
						<div class="col-md-3 form-group<?php echo e($errors->has('action_code') ? ' has-error' : ''); ?>">
							<label for="action_code" class="col-md-12">Action code</label>

							<div class="col-md-12">
								<input type="text" class="form-control" name="action_code" placeholder="" required />

								<?php if($errors->has('action_code')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('action_code')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-7 form-group<?php echo e($errors->has('action_libelle') ? ' has-error' : ''); ?>">
							<label for="action_libelle" class="col-md-12">Action libellé</label>

							<div class="col-md-12">
								<input type="text" class="form-control" name="action_libelle" placeholder="" required />

								<?php if($errors->has('action_libelle')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('action_libelle')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						
						<div class="col-md-2">
							<label for="prenoms" class="col-md-12">&nbsp;</label>
							<div class="col-md-12">
								<button type="submit" class="btn btn-success btn-sm rounded"> <i class="fa fa-save"></i> ENREGISTRER</button> 
							</div>
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
	</div>
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des actions</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width="">Code</th>
					<th width="">Libellé</th>
					<th width="">Date création</th>
					<th width=""></th>
					<th width=""></th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($action->action_code); ?></td>
					<td><?php echo e($action->action_libelle); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($action->action_date_creation)); ?></td>
					<td><span class="btnModifierAction" data-action_id="<?php echo e($action->action_id); ?>" style="cursor: pointer;"><i class="fa fa-edit text-warning" title="Modifier"></i></span></td>
					<td><span class="btnSupprimerAction" data-action_id="<?php echo e($action->action_id); ?>" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer"></i></span></td> 
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>