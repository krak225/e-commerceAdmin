<?php $__env->startSection('content'); ?>
 
	<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
		<li class=""><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
		<li class="active">Courrier</li>
	</ul> 
	<div class="m-b-md"> 
		<h3 class="m-b-none">TABLEAU DE BORD</h3>
	</div>
	
	<?php if(Stdfn::SiActionAutorisee('IMPCOURRIER')): ?>
	<section class="panel panel-default"> 
		<div class="row m-l-none m-r-none bg-light lter">
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('courriers')); ?>"> 
					<span class="h3 block m-t-xs">
					<strong id="bugs"><?php echo e(number_format($courriers, 0, '', ' ')); ?></strong>
					</span> 
					<small class="text-muted text-uc">Courriers arrivés</small> 
				</a> 
			</div> 
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('courriers_non_imputes')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_non_imputes, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers à imputer</small> 
				</a> 
			</div> 
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('courriers_imputes')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_imputes, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers imputés</small> 
				</a> 
			</div> 
		</div> 
		
	</section>

	<h3>Suivi du traitement des courriers par les services</h3>
	<section class="panel panel-default"> 
		<div class="row m-l-none m-r-none bg-light lter">

			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('courriers_imputes')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_imputes, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers imputés</small> 
				</a> 
			</div> 

			<div class="col-sm-8 col-md-4 padder-v b-r b-light lt"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('courriers_non_traites')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_non_traites, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers non traités</small> 
				</a> 
			</div> 
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('courriers_traites')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_traites, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers traités</small> 
				</a> 
			</div> 
		</div> 
		
	</section>

	<?php else: ?>


	<?php if(Stdfn::SiActionAutorisee('SAISIECOURRIER')): ?>
	<section class="panel panel-default"> 
		<div class="row m-l-none m-r-none bg-light lter">
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-envelope fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('courriers')); ?>"> 
					<span class="h3 block m-t-xs">
					<strong id="bugs">Réception courrier</strong>
					</span> 
					<small class="text-muted text-uc">Pour un courrier arrivée</small> 
				</a> 
			</div> 
		</div> 
		
	</section>
	<?php else: ?>
	<section class="panel panel-default"> 
		<div class="row m-l-none m-r-none bg-light lter">
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('courriers')); ?>"> 
					<span class="h3 block m-t-xs">
					<strong id="bugs"><?php echo e(number_format($courriers, 0, '', ' ')); ?></strong>
					</span> 
					<small class="text-muted text-uc">Tous les courriers</small> 
				</a> 
			</div> 
			<div class="col-sm-8 col-md-4 padder-v b-r b-light lt"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i>
				</span>
				<a class="clear" href="<?php echo e(route('courriers_non_traites')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_non_traites, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers à traiter</small> 
				</a> 
			</div> 
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-list fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('courriers_traites')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format($courriers_traites, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Courriers traités</small> 
				</a> 
			</div> 
		</div> 
		
	</section>
	<?php endif; ?>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>