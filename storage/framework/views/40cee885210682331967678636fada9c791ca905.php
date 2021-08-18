<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li><a href="<?php echo e(route('utilisateurs')); ?>"><i class="fa fa-users"></i> Utilisateurs</a></li>
	<li class="active"> Fiche de l'utilisateur</a></li>
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Fiche de l'utilisateur</h3> 
</div>

<section class="panel panel-default"> 
	<!--header class="panel-heading"> Mon profil utilisateur</header--> 
	
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 lead">Informations personnelles<hr></div>
		</div>
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
	
	
	<div class="panel-body">
	
		<section class="panel panel-default"> 
			<header class="panel-heading"> Historique de ses retards</header> 
			
			<div class="table-responsive"> 
				<table class="table table-striped m-b-none datatable"> 
					<thead> 
						<tr>  
							<th width="5%">Date</th>
							<th width="10%">Matricule</th>
							<th width="20%">Nom & Prénoms</th> 
							<th width="10%">Arrivé</th> 
							<th width="10%">Départ</th> 
							<th width="10%">Tps retard</th>
						</tr> 
					</thead> 
					<tbody>
					<?php $__currentLoopData = $retardataires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e(Stdfn::dateFromDB($user->date)); ?></td>
							<td><?php echo e($user->matricule); ?></a></td>
							<td><a href="<?php echo e(route('DetailsUtilisateur',$user->id)); ?>"><?php echo e($user->nom .' '.$user->prenoms); ?></td> 
							<td><span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_arrivee)); ?></span></td> 
							<td><span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_depart)); ?></span></td> 
							<td><?php echo e(substr($user->temps_retard,0,5)); ?></td>
						</tr>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody> 
				</table> 
			</div> 
		</section>
	
	</div>
	
	
	<div class="panel-body">
	
		<section class="panel panel-default"> 
			<header class="panel-heading"> Historique de ses absences</header> 
			
			<div class="table-responsive"> 
				<table class="table table-striped m-b-none datatable"> 
					<thead> 
						<tr>  
							<th width="5%">Date</th>
							<th width="15%">Matricule</th>
							<th width="25%">Nom & Prénoms</th> 
							<th width="15%">Arrivé</th> 
							<th width="15%">Départ</th> 
							<th width="10%">Actions</th>
						</tr> 
					</thead> 
					<tbody>
					<?php $__currentLoopData = $absences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e(Stdfn::dateFromDB($user->date)); ?></td>
							<td><?php echo e($user->matricule); ?></a></td>
							<td><a href="<?php echo e(route('DetailsUtilisateur',$user->id)); ?>"><?php echo e($user->nom .' '.$user->prenoms); ?></td> 
							<td><span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_arrivee)); ?></span></td> 
							<td><span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_depart)); ?></span></td> 
							<td>
							</td>
						</tr>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody> 
				</table> 
			</div> 
		</section>
	
	</div>
	
	
	
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>