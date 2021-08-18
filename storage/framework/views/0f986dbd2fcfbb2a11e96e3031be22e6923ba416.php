<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Equipes</li> 
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
	<h3 class="m-b-none">Liste des équipes</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des équipes</header> 
	
	<div class="table-responsive"> 
		<table id="equipes" class="table table-striped m-b-none datatable someClass" data-ride="listeusers"> 
			<thead> 
				<tr>  
					<th style="display:none;"></th>
					<th width="5%"></th>
					<th width="">Nom</th>
					<th width="">Chef d'équipe</th> 
					<th width="">Nombre ets</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $equipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td style="display:none;"><?php echo e($equipe->equipe_id); ?></td>
					<td>
						<a href="<?php echo e(route('DetailsEquipe',$equipe->equipe_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les information de l'équipe"></i></a>					
					</td>
					<td><?php echo e($equipe->equipe_nom); ?></td>
					<td><?php echo e($equipe->nom . ' ' . $equipe->prenoms); ?></td> 
					<td><?php echo e(Stdfn::getNombreEtsParEquipe($equipe->equipe_id)); ?></td>
					<td><?php echo e($equipe->equipe_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>