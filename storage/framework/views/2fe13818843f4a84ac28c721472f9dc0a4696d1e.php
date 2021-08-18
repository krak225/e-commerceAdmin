<?php $__env->startSection('content'); ?>

	<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li class="active"><i class="fa fa-home"></i> Accueil</li>
	</ul> 
	<div class="m-b-md"> 
	<h3 class="m-b-none">MES APPLICATIONS</h3>
	</div> 
	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-clock-o fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('pointageHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>POINTEUSE</strong></span> 
					<small class="text-muted text-uc">Gestion des retards et absences</small> 
				</a> 
			</div>
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-users fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('prospectionHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>PROSPECTION</strong></span> 
					<small class="text-muted text-uc">Gestion de la prospection</small> 
				</a> 
			</div>
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-money fa-stack-1x text-white"></i> 
				</span>
				<a class="clear" href="<?php echo e(route('perceptionHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>PERCEPTION</strong></span> 
					<small class="text-muted text-uc">Gestion de la perception</small> 
				</a> 
			</div> 
			
		</div> 
		
	</section> 
	
	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-danger"></i> 
					<i class="fa fa-tasks fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('todoHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>TODO</strong></span> 
					<small class="text-muted text-uc">Gestion des tâches</small> 
				</a> 
			</div>
			
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-calendar-o fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="#"> 
					<span class="h3 block m-t-xs"><strong>E-CONGES</strong></span> 
					<small class="text-muted text-uc">Gestion des congés</small> 
				</a> 
			</div>
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-money fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="https://md.buridaci.com" target="_blank"> 
					<span class="h3 block m-t-xs"><strong>MenuesDepenses</strong></span> 
					<small class="text-muted text-uc">Gestion des dépenses</small> 
				</a> 
			</div>
			
			
		</div> 
		
	</section>


	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-envelope fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('courrierHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>COURRIERS</strong></span> 
					<small class="text-muted text-uc">Gestion des courriers</small> 
				</a> 
			</div>
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-envelope fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('memoHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>MEMOS</strong></span> 
					<small class="text-muted text-uc">Gestion des mémos internes</small> 
				</a> 
			</div>
			
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i>
					<i class="fa fa-question-circle fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="<?php echo e(route('helpdeskHome')); ?>"> 
					<span class="h3 block m-t-xs"><strong>HELP DESK</strong></span> 
					<small class="text-muted text-uc">Centre d'assistance aux visiteurs</small> 
				</a> 
			</div>
			
			
		</div> 
		
	</section>



	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-warning"></i> 
					<i class="fa fa-envelope fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="#"> 
					<span class="h3 block m-t-xs"><strong>AGENDA</strong></span> 
					<small class="text-muted text-uc">Gestion des rendez-vous</small> 
				</a> 
			</div>
			
			
		</div> 
		
	</section>


	<section class="panel panel-default"> 
	
		<div class="row m-l-none m-r-none bg-light lter"> 
			
			<div class="col-sm-12 col-md-12 padder-v b-r b-light"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-danger"></i> 
					<i class="fa fa-exclamation-triangle fa-stack-1x text-white"></i> 
				</span> 
				<a class="clear" href="#"> 
					<span class="h3 block m-t-xs"><strong>DILIGENCES ET ORIENTATIONS DU DG</strong></span> 
					<small class="text-muted text-uc">Urgence</small> 
				</a> 
			</div>
			
			
		</div> 
		
	</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>