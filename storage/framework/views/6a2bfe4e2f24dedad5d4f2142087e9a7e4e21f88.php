<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('equipes')); ?>"></i> Equipes</a></li>  
	<li class="active"><?php echo e($equipe->equipe_nom); ?></li> 
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
	<h3 class="m-b-none"><?php echo e($equipe->equipe_nom); ?></h3> 
</div>

<section class="panel panel-default" style="display:none;"> 
	<header class="panel-heading"> Informations</header> 
	
	<div class="col-md-12" style="padding-top:20px;">
		<div class="list-group col-md-6 radius"> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($equipe->equipe_nom); ?></span> 
				<i class="fa fa- icon-muted"></i> Nom
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($equipe->nom. ' '. $equipe->prenoms); ?></span> 
				<i class="fa fa- icon-muted"></i> Chef d'équipe 
			</span>
		</div>
		<div class="list-group col-md-6 radius"> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e(Stdfn::dateTimeFromDB($equipe->equipe_date_creation)); ?></span> 
				<i class="fa fa- icon-muted"></i> Date d'enregistrement
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($equipe->equipe_statut); ?></span> 
				<i class="fa fa- icon-muted"></i> Statut 
			</span>
		</div>
	</div>
	<br style="clear:both;"/>	
</section>



<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des membres</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr>  
					<th width="20%">Nom</th> 
					<th width="">Prénoms</th> 
					<th width="15%">Login</th>
					<th width="10%">Téléphone</th>
					<th width="10%">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($user->nom); ?></td> 
					<td><?php echo e($user->prenoms); ?></td>
					<td><?php echo e($user->email); ?></td> 
					<td><?php echo e($user->telephone); ?></td>
					<td>
						<a href="<?php echo e(route('DetailsUtilisateur',$user->id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les information de l'utilisateur"></i></a>					
					</td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des établissements recensés</header> 
	
	<div class="table-responsive"> 
		<table id="etablissements" class="table table-striped m-b-none datatable someClass" data-ride="listeusers"> 
			<thead> 
				<tr>
					<th style="display:none;"></th>
					<th width="5%"></th>
					<th width="15%">Nom</th>
					<th width="20%">Représentant</th> 
					<th width="">Téléphone</th>  
					<th width="">Type support</th>
					<th width="">Quartier</th>
					<th width="">Observations</th>
					<th width="">Date</th>
					<th width="">Saisi par</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $etablissements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etablissement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td style="display:none;"><?php echo e($etablissement->etablissement_id); ?></td>
					<td>
						<a href="<?php echo e(route('DetailsEtablissement',$etablissement->etablissement_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les information de l'établissement"></i></a>					
					</td>
					<td><?php echo e($etablissement->etablissement_nom); ?></td>
					<td><?php echo e($etablissement->etablissement_representant); ?></td> 
					<td><?php echo e($etablissement->etablissement_telephone); ?></td>
					<td><?php echo e($etablissement->etablissement_type_support); ?></td>
					<td title="<?php echo e('Lat: '. $etablissement->etablissement_latitude .' ,Long: '. $etablissement->etablissement_longitude); ?>"><?php echo e($etablissement->etablissement_quartier); ?></td> 
					<td><?php echo e($etablissement->etablissement_observations); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($etablissement->etablissement_date_creation)); ?></td>
					<td><?php echo e($etablissement->nom . ' ' . $etablissement->prenoms); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>