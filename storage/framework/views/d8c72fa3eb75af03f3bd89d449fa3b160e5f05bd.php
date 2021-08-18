<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Commandes</li> 
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
	<h3 class="m-b-none">Gestion des commandes</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des commandes</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">N° commande</th>
					<th width="">Nom du client</th>
					<th width="">Montant</th>
					<th width="">Date</th>
					<th width="">Livraison</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsCommande',$commande->commande_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les détails"></i></a></td> 
					<td><span class="label label-default"><?php echo e(Stdfn::truncateN($commande->commande_id, 5)); ?></span></td> 
					<td><?php echo e($commande->nom.' '.$commande->prenoms); ?></td> 
					<td><?php echo e($commande->commande_montant_ttc); ?></td> 
					<td><?php echo e(Stdfn::dateFromDB($commande->commande_date_creation)); ?></td>
					<td><span class="label label-default" class="label label-<?php echo e(strtolower(str_replace(' ','',$commande->commande_statut_livraison))); ?> "><?php echo e($commande->commande_statut_livraison); ?></span></td>
					<td><span class="label label-<?php echo e(strtolower(str_replace(' ','',$commande->commande_statut))); ?> "><?php echo e($commande->commande_statut); ?></span></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>