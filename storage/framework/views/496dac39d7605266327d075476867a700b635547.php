<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li class=""><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Todo APP</li>
	</ul> 
	<div class="m-b-md"> 
	<h3 class="m-b-none">TABLEAU DE BORD</h3>
	</div> 
	
	<?php if(Stdfn::SiActionAutorisee('CREER_TYPE_REUNION')): ?>
	<div>
		<a class="btn btn-sm btn-info" href="<?php echo e(route('categories')); ?>" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouvelle catégorie</a>
	</div>
	<?php endif; ?>

	<?php if(Stdfn::SiActionAutorisee('TACHE_DISPLAY_ALL')): ?>{
	<h3 style="font-size:18px">Comité de direction</h3>
	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-4 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('taches_all',1)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($taches_codir, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Toutes les diligences</small> 
				</a> 
			</div> 
			<div class="col-sm-4 col-md-4 padder-v b-r b-light "> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('taches_encours',1)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($taches_encours_codir, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Diligences en cours</small> 
				</a> 
			</div> 
			<div class="col-sm-4 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('taches_terminees',1)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($taches_terminees_codir, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Diligences terminées</small> 
				</a> 
			</div> 
			
		</div> 
	</section>	
	


	<h3 style="font-size:18px">Conseil de gestion</h3>
	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-4 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('taches_all',2)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($taches_coger, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Toutes les diligences</small> 
				</a> 
			</div> 
			<div class="col-sm-4 col-md-4 padder-v b-r b-light "> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('taches_encours',2)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($taches_encours_coger, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Diligences en cours</small> 
				</a> 
			</div> 
			<div class="col-sm-4 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('taches_terminees',2)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($taches_terminees_coger, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Diligences terminées</small> 
				</a> 
			</div> 
			
		</div> 
	</section>	
	<?php endif; ?>


	<?php $__currentLoopData = $data_autres_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<h3 style="font-size:18px"><?php echo e($categorie['categorie']->categorie_tache_libelle); ?></h3>
	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-6 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('taches_all',$categorie['categorie']->categorie_tache_id)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($categorie['taches_of_type'], 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Toutes les diligences</small> 
				</a> 
			</div>
			<div class="col-sm-6 col-md-4 padder-v b-r b-light "> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('taches_encours',$categorie['categorie']->categorie_tache_id)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($categorie['taches_encours_of_type'], 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Diligences en cours</small> 
				</a> 
			</div>
			<div class="col-sm-6 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('taches_terminees',$categorie['categorie']->categorie_tache_id)); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($categorie['taches_terminees_of_type'], 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Diligences terminées</small> 
				</a> 
			</div> 
			
		</div> 
	</section>	
	
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>