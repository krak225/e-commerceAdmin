<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li class=""><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Pointage</li>
	</ul> 
	<div class="m-b-md"> 
	<h3 class="m-b-none">TABLEAU DE BORD</h3>
	</div> 
	<section class="panel panel-default"> 
		<div class="row m-l-none m-r-none bg-light lter"> 
		<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
			<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-info"></i> 
				<i class="fa fa-users fa-stack-1x text-white"></i> 
			</span> 
			<a class="clear" href="<?php echo e(route('bureaux')); ?>"> 
				<span class="h3 block m-t-xs">
				<strong id="bugs"><?php echo e(number_format($nombre_users, 0, '', ' ')); ?></strong>
				</span> 
				<small class="text-muted text-uc">Employés</small> 
			</a> 
		</div> 
		<!--div class="col-sm-8 col-md-4 padder-v b-r b-light lt"> 
			<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-warning"></i> 
				<i class="fa fa-users fa-stack-1x text-white"></i>
			</span>
			<a class="clear" href="<?php echo e(route('pointagearrivee')); ?>"> 
				<span class="h3 block m-t-xs"><strong><?php echo e(number_format($nombre_presents, 0, '', ' ')); ?></strong></span> 
				<small class="text-muted text-uc">Présents aujourd'hui</small> 
			</a> 
		</div--> 
		<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
			<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-warning"></i> 
				<i class="fa fa-users fa-stack-1x text-white"></i> 
			</span>
			<a class="clear" href="<?php echo e(route('retardataires')); ?>"> 
				<span class="h3 block m-t-xs"><strong><?php echo e(number_format($nombre_retardataires, 0, '', ' ')); ?></strong></span> 
				<small class="text-muted text-uc">Retardataires</small> 
			</a> 
		</div> 


		<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
			<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-danger"></i> 
				<i class="fa fa-users fa-stack-1x text-white"></i> 
			</span>
			<a class="clear" href="<?php echo e(route('pointageabsence')); ?>"> 
				<span class="h3 block m-t-xs"><strong><?php echo e(number_format($nombre_absents, 0, '', ' ')); ?></strong></span> 
				<small class="text-muted text-uc">Absents aujourd'hui</small> 
			</a> 
		</div> 

		</div> 
	</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>