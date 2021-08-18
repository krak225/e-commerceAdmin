<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Etablissements</li> 
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
	<h3 class="m-b-none">Liste des établissements</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des établissements <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table id="etablissements" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>  
					<th style="display:none;"></th>
					<th width="5%"></th>
					<th width="15%">Nom</th>
					<th width="20%">Représentant</th> 
					<!--th width="">Téléphone</th>  
					<th width="">Type support</th-->
					<!--th width="">DA</th>
					<th width="">DV</th-->
					<th width="">Redevance</th>
					<th width="">Commune</th>
					<!--th width="">Quartier</th-->
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
					<!--td><?php echo e($etablissement->etablissement_telephone); ?></td>
					<td><?php echo e($etablissement->etablissement_type_support); ?></td-->
					<!--td style="text-align: right;"><?php echo e(number_format($etablissement->etablissement_redevance_da_final, 0, '', ' ')); ?></td>
					<td style="text-align: right;"><?php echo e(number_format($etablissement->etablissement_redevance_dv_final, 0, '', ' ')); ?></td-->
					<td style="text-align: right;"><?php echo e(number_format($etablissement->etablissement_redevance_total, 0, '', ' ')); ?></td>
					<td title="<?php echo e($etablissement->etablissement_quartier); ?>"><?php echo e($etablissement->BDN_COMMUNE_LIBELLE); ?></td>
					<!--td title="<?php echo e('Lat: '. $etablissement->etablissement_latitude .' ,Long: '. $etablissement->etablissement_longitude); ?>"><?php echo e($etablissement->etablissement_quartier); ?></td--> 
					<td><?php echo e($etablissement->etablissement_observations); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($etablissement->etablissement_date_creation)); ?></td>
					<td><?php echo e($etablissement->nom . ' ' . $etablissement->prenoms); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 

		<center>
		<?php echo e($etablissements->links()); ?>

		</center>
		
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>