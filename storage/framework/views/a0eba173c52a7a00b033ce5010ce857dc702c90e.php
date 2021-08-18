<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('todoHome')); ?>"> TodoAPP</a></li>  
	<li class="active">Tâches</li> 
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
	<h3 class="m-b-none">Gestion des diligences</h3>
</div>

<?php if(!empty($reunion)): ?>
<div>
	<a class="btn btn-sm btn-info" href="<?php echo e(route('tache',$reunion->reunion_id)); ?>" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouvelle dilligence</a>
</div>
<?php endif; ?>

<br style="clear:both;"/> 

<section class="panel panel-default"> 
	
	<div class="" style="margin-top:10px;">
		
		<div class="col-md-4 firstTasks"> 
			<header class="panel-heading bg-info"> TACHES EN ATTENTE</header> 
			<div class="todo-lists"> 
				<ul id="tasks1" data-statut="EN ATTENTE" >
					<li class="draggable new_item" draggable="false" data-tache_id="">...</li>
				<?php $__currentLoopData = $taches_en_attente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li class="todo_item draggable" draggable="true" data-tache_id="<?php echo e($tache->tache_id); ?>" data-tache_numero="<?php echo e(Stdfn::truncateN($tache->tache_id, 5)); ?>" data-tache_libelle="<?php echo e($tache->tache_libelle); ?>" data-tache_statut="EN ATTENTE"><span class="tache_libelle"><?php echo e($tache->tache_libelle); ?></span><span class="tache_dates"><?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?> <i class="fa fa-arrow-right"></i> <?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?> [<span class="diff_date"><?php echo e($tache->diff_date); ?></span>]</span></li>	
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul> 
			</div> 
		</div> 
		
		<div class="col-md-4 middleTasks"> 
			<header class="panel-heading bg-warning"> TACHES EN COURS</header> 
			<div class="todo-lists"> 
				<ul id="tasks2" data-statut="EN COURS" >
					<li class="draggable new_item" draggable="false" data-tache_id="">...</li>
				<?php $__currentLoopData = $taches_en_cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li class="todo_item draggable" draggable="true" data-tache_id="<?php echo e($tache->tache_id); ?>" data-tache_numero="<?php echo e(Stdfn::truncateN($tache->tache_id, 5)); ?>" data-tache_libelle="<?php echo e($tache->tache_libelle); ?>" data-tache_statut="EN COURS"><span class="tache_libelle"><?php echo e($tache->tache_libelle); ?></span><span class="tache_dates"><?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?> <i class="fa fa-arrow-right"></i> <?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?> [<span class="diff_date"><?php echo e($tache->diff_date); ?></span>]</span></li>	
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul> 
			</div> 
		</div> 
		
		<div class="col-md-4 lastsTasks"> 
			<header class="panel-heading bg-success"> TACHES TERMINÉES</header> 
			<div class="todo-lists" style="padding:0px;margin:0px;"> 
				<ul id="tasks3" data-statut="TERMINE" style="padding:0px;margin:0px;">
					<li class="draggable new_item" draggable="false" data-tache_id="">...</li>
				<?php $__currentLoopData = $taches_terminees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tache): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li class="todo_item draggable" draggable="true" data-tache_id="<?php echo e($tache->tache_id); ?>" data-tache_numero="<?php echo e(Stdfn::truncateN($tache->tache_id, 5)); ?>" data-tache_libelle="<?php echo e($tache->tache_libelle); ?>" data-tache_statut="TERMINE"><span class="tache_libelle"><?php echo e($tache->tache_libelle); ?></span><span class="tache_dates"><?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?> <i class="fa fa-arrow-right"></i> <?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?> [<span class="diff_date"><?php echo e($tache->diff_date); ?></span>]</span></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul> 
			</div> 
		</div>
		
		<br style="clear:both;"/> 
		
	</div>
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>