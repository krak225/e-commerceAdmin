<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li class=""><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Prospection</li>
	</ul> 
	<div class="m-b-md"> 
	<h3 class="m-b-none">TABLEAU DE BORD</h3>
	</div> 
	<section class="panel panel-default"> 
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-info"></i> 
				<i class="fa fa-home fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('etablissements')); ?>"> 
				<span class="h3 block m-t-xs">
				<strong id="bugs"><?php echo e(number_format($nombre_users, 0, '', ' ')); ?></strong>
				</span> 
				<small class="text-muted text-uc">Tous les établissements</small> 
				</a> 
			</div>
			
			<!--div class="col-sm-8 col-md-4 padder-v b-r b-light lt"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-warning"></i> 
				<i class="fa fa-users fa-stack-1x text-white"></i> 
				<span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update="3000"></span> 
				</span> 
				
				<a class="clear" href="#"> 
					<span class="h3 block m-t-xs"><strong><?php echo e(number_format(0, 0, '', ' ')); ?></strong></span> 
					<small class="text-muted text-uc">Non contractualisés</small> 
				</a> 
			</div>
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-success"></i> 
				<i class="fa fa-money fa-stack-1x text-white"></i> 
				<span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update="5000"></span> 
				</span> <a class="clear" href="#"> 
				<span class="h3 block m-t-xs"><strong><?php echo e(number_format(0, 0, '', ' ')); ?></strong></span> 
				<small class="text-muted text-uc">découvert aujourd'hui</small> 
				</a> 
			</div--> 
			
		</div> 
	</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>