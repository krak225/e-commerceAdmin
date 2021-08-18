<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('todoHome')); ?>"> TodoAPP</a></li>  
	<li class="active">Diligences</li> 
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
	<h3 class="m-b-none">Liste des diligences</h3>
</div>

<div class="m-b-md">
	<div class="actions pull-right" style="padding:10px;"> 
		<a class="btn btn-sm btn-info" href="<?php echo e(route('tache',0)); ?>" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouveau</a>
	</div>
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des diligences</header> 
	
	<div class="table-responsive"> 
		<table id="table_taches" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>  
					<th style="display:none"></th>
					<th></th>
					<th width="">Libellé</th>
					<th width="">Date début</th>
					<th width="">Date fin prévu</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $taches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td style="display:none">
						<?php echo e($tache->tache_id); ?>		
					</td>
					<td>
						<a href="<?php echo e(route('DetailsTache',$tache->tache_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les information de l'établissement"></i></a>					
					</td>
					<td><a href="<?php echo e(route('DetailsTache',$tache->tache_id)); ?>"><?php echo e($tache->tache_libelle); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?></td> 
					<td><?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?></td>
					<td><span class="label label-<?php echo e(strtolower(str_replace(' ','',$tache->tache_statut))); ?> "><?php echo e($tache->tache_statut); ?></span></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>