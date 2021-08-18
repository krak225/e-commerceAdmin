<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li><a href="<?php echo e(route('utilisateurs')); ?>"><i class="fa fa-users"></i> Prospection</a></li>
	<li class="active"> Prospecteur</a></li>
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Prospecteur</h3> 
</div>

<section class="panel panel-default"> 
	<!--header class="panel-heading"> Mon profil utilisateur</header--> 
	
	<div class="panel-body">
		<!--div class="row">
			<div class="col-md-12 lead">Informations personnelles<hr></div>
		</div-->
		<div class="row">
			<div class="col-md-4 text-center">
				
				<div class="wrapper">
					<div class="panel wrapper panel-info">
						<div class="text-center bg-info">
							<?php if(File::exists('images/'. $user->photo ) && !is_dir('images/'. $user->photo) ): ?>
							<img class="col-md-12 rounded img-responsive"
							src="<?php echo e(asset('images/'. $user->photo )); ?>">
							<?php else: ?>
							<img class="col-md-12 rounded img-responsive" src="<?php echo e(asset('images/avatar.jpg')); ?>"/>
							<?php endif; ?>
						</div>
						<div class="col-md-12 text-center">
							<h4><?php echo e($user->nom .' '. $user->prenoms); ?></h4>
						</div>
						<div class="row"> 
							
						</div> 
					</div> 
					
					
				</div>
				
			</div>
			
			<div class="col-md-8 bordered">
				
				
				<div class="list-group radius"> 
					<span class="list-group-item"> 
						<span class="badge bg-light"><?php echo e($user->nom); ?></span> 
						<i class="fa fa- icon-muted"></i> Nom 
					</span>
					<span class="list-group-item"> 
						<span class="badge bg-light"><?php echo e($user->prenoms); ?></span> 
						<i class="fa fa- icon-muted"></i> Prénoms 
					</span>
					
					<span class="list-group-item"> 
						<span class="badge bg-light"><a href="<?php echo e(route('DetailsUtilisateur',$user->ddc_id)); ?>"><?php echo e($user->profilLibelle); ?></a></span> 
						<i class="fa fa- icon-muted"></i> Profil 
					</span>
					
					<span class="list-group-item" href="#"> 
						<span class="badge bg-light"><?php echo e(Stdfn::dateFromDB($user->date_naissance)); ?></span> 
						<i class="fa fa- icon-muted"></i> Date naissance 
					</span> 
					<span class="list-group-item"> 
						<span class="badge bg-light"><?php echo e($user->telephone); ?></span> 
						<i class="fa fa- icon-muted strong"></i> Téléphone 
					</span>
					<span class="list-group-item"> 
						<span class="badge bg-light"><?php echo e($user->email); ?></span> 
						<i class="fa fa- icon-muted"></i> E-mail 
					</span>
					
					<span class="list-group-item" href="#"> 
						<span class="badge bg-light"><?php echo e(Stdfn::dateTimeFromDB($user->created_at)); ?></span> 
						<i class="fa fa- icon-muted"></i> Date d'enregistrement 
					</span> 
					<span class="list-group-item" href="#"> 
						<span class="badge bg-success"><?php echo e($user->statut); ?></span> 
						<i class="fa fa- icon-muted"></i> Statut 
					</span> 
				</div>
				
			</div>
		</div>
		
		
		
	</div>
	
	
	
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>