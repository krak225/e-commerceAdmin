<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Frais de livraison</li> 
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
	<h3 class="m-b-none">Gestion des frais de livraison</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau frais</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveFraisLivraison')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12">
						<div class="col-md-3">
							<span> Départ <span class="text text-danger">*</span></span>
							<select class="form-control" name="commune_id_retrait" required>
								<option value="">Choisir</option>
								<?php $__currentLoopData = $communes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commune): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($commune->commune_id); ?>"><?php echo e($commune->commune_libelle); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						
						<div class="col-md-3">
							<span> Destination <span class="text text-danger">*</span></span>
							<select class="form-control" name="commune_id_livraison" required>
								<option value="">Choisir</option>
								<?php $__currentLoopData = $communes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commune): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($commune->commune_id); ?>"><?php echo e($commune->commune_libelle); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>

						<div class="col-md-3">
							<span> Frais <span class="text text-danger">*</span></span>
							<input type="text" class="form-control" name="montant" required />
						</div>

						<div class="col-md-3">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="submit" class="btn btn-success btn-sm">ENREGISTRER</button> 
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des frais de livraison
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Commune départ</th>
					<th width="">Commune destination</th>
					<th width="">Frais livraison</th>
					<th width="">Date création</th>
					<th width="">Statut</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $frais_livraison; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $frais): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td></td> 
					<td><?php echo e($frais->lieu_retrait); ?></td> 
					<td><?php echo e($frais->lieu_livraison); ?></td> 
					<td><?php echo e($frais->frais_livraison_montant); ?></td> 
					<td><?php echo e(Stdfn::dateTimeFromDB($frais->frais_livraison_date_creation)); ?></td>
					<td><?php echo e($frais->frais_livraison_statut); ?></td>
					<td><span class="btnSupprimerFraisLivraison" data-frais_livraison_id="<?php echo e($frais->frais_livraison_id); ?>" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer ce frais de livraison"></i></a></td> 
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>