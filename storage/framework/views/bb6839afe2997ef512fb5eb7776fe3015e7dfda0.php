<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Utilisateurs</li> 
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
	<h3 class="m-b-none">Liste des utilisateurs</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des utilisateurs <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr>  
					<th width="15%">Bureau</th>
					<th width="20%">Nom</th> 
					<th width="">Prénoms</th> 
					<th width="15%">Profil</th> 
					<th width="15%">Login</th>
					<th width="10%">Téléphone</th>
					<th width="10%">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($user->bureauLibelle); ?></td>
					<td><?php echo e($user->nom); ?></td> 
					<td><?php echo e($user->prenoms); ?></td>
					<td><?php echo e($user->profilLibelle); ?></td>
					<td><?php echo e($user->email); ?></td> 
					<td><?php echo e($user->telephone); ?></td>
					<td>
						<a href="<?php echo e(route('DetailsUtilisateur',$user->id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les information de l'utilisateur"></i></a>					
					<?php if(Auth::user()->profil_id == 1): ?>
						<a href="<?php echo e(route('ModifierUtilisateur',$user->id)); ?>"><i class="fa fa-edit text-warning" title="Modifier un utilisateur"></i></a>
						<!--span style="cursor:pointer" class="btnSupprimerUtilisateur" data-id="<?php echo e($user->id); ?>"><i class="fa fa-times text-danger" title="Supprimer un utilisateur"></i></span-->
					<?php endif; ?>
					</td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>