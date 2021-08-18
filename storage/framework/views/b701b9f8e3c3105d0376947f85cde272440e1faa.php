<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('todoHome')); ?>"> TodoAPP</a></li>   
	<li class="active">Categories</li> 
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
	<h3 class="m-b-none">Gestion des catégories de diligences</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouvelle catégorie</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveCategorieTache')); ?>" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					
					<div class="col-md-12">
						<div class="col-md-6">
							<span> Intitulé de la catégorie <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="libelle"  value="<?php echo e(old('libelle')); ?>" required>
						</div>

						<div class="col-md-3">
							<span> Abréviation <span class="text text-danger">&nbsp;</span></span>
							<input style="padding-top:0px;" placeholder="" class="form-control" name="abreviation" value="<?php echo e(old('abreviation')); ?>">
						</div>
						
						<div class="col-md-1">
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
	<header class="panel-heading"> Liste des catégories
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width="">Libellé</th>
					<th width="">Abréviation</th>
					<th width="">Date enregistrement</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($categorie->categorie_tache_libelle); ?></td> 
					<td><?php echo e($categorie->categorie_tache_abreviation); ?></td> 
					<td><?php echo e(Stdfn::dateFromDB($categorie->categorie_tache_date_creation)); ?></td>
					<td><?php echo e($categorie->categorie_tache_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>