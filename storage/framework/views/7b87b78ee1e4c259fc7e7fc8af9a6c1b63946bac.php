<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('helpdeskHome')); ?>"> HELP DESK</a></li>   
	<li class="active">Visites</li> 
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
	<h3 class="m-b-none">Gestion des visites</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau visiteur</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveVisite')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					
					<div class="col-md-12 row">	
						
						<!--div class="col-md-3">
							<span> Catégorie de visiteur<span class="text text-danger">*</span></span>
							<select class="form-control" name="categorie_visite" required>
								<option value="">Choisir</option>
								<option value="1">ARTISTE</option>
								<option value="2">AUTRES</option>
							</select>
							
						</div-->
						<div class="col-md-4">
							<span> Nom et prénoms du visiteur <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="nom_visiteur"  value="<?php echo e(old('nom_visiteur')); ?>" required>
							
						</div>
						<div class="col-md-4">
							<span> Téléphone <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="telephone_visiteur"  value="<?php echo e(old('telephone_visiteur')); ?>" required>
							
						</div>
						
						<div class="col-md-4">
							<span> Services<span class="text text-danger">*</span></span>	
							<select class="form-control" name="service_id" required>
							<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($service->service_id); ?>"><?php echo e($service->service_nom); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>

					</div>	
					<div class="col-md-12 row">	

						<div class="col-md-4">
							<span> Objet<span class="text text-danger">*</span></span>	
							<select class="form-control" name="objetvisite_id" required>
							<?php $__currentLoopData = $objets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($objet->objetvisite_id); ?>"><?php echo e($objet->objetvisite_libelle); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>

						<div class="col-md-4">
							<span> Détails <span class="text text-danger"></span></span>
							<input placeholder="" type="text" class="form-control" name="objet_detail"  value="<?php echo e(old('objet_detail')); ?>">
						</div>

						<div class="col-md-4">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<div class="form-control " style="border: none;padding:0px;"><button type="submit" class="btn btn-success btn-sm">ENREGISTRER</button></div> 
						</div>

					</div>
					
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des visites</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Nom du visiteur</th>
					<th width="">Motif de la viste</th>
					<th width="">Date</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $visites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('visite',$visite->visite_id)); ?>"><i class="fa fa-cogs text-info" title="Détails de la visite"></i></a></td> 
					<td><?php echo e($visite->visite_nom_visiteur); ?></td> 
					<td><?php echo e($visite->visite_objet_detail); ?></td> 
					<td><?php echo e(Stdfn::dateFromDB($visite->visite_date_creation)); ?></td>
					<td><?php echo e($visite->visite_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>