<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Marquer les absents</li> 
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


<style type="text/css">
<!--
td{vertical-align:middle;}
.heure_arrivee > .datetime-reset-button {
    display:none;
}

.heure_saisie{
	width:58px;
	padding:0px;
	text-align:center;
}
.heure_verouillee{
	background:#eee;
	font-weight:bold;
}

.heure_confirme{
	margin-top:3px;
	font-weight:bold;
	padding:4px 10px;
	border:1px solid #ddd;
	background:#eee;
	border-radius:2px;
}

-->
</style>

 
<div class="m-b-md"> 
	<h3 class="m-b-none"> Marquer les absents - <?php echo e(date('d/m/Y')); ?></h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Marquer les absents</header> 
	
	<div class="table-responsive"> 
		<table id="table_pointage_arrivee" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>  
					<th width="7%">ID</th>
					<th width="15%">Matricule</th>
					<th width="20%">Nom</th> 
					<th width="">Prénoms</th> 
					<th width="">Date</th> 
					<th width="10%"></th> 
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsUtilisateur',$user->id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les information de l'utilisateur"></i></a></td>
					<td><?php echo e($user->matricule); ?></td>
					<td><?php echo e($user->nom); ?></td> 
					<td><?php echo e($user->prenoms); ?></td>
					<td><?php echo e(gmdate('d/m/Y')); ?></td>
					<td>
						<?php if(Stdfn::getStatutPresence($user->id, gmdate('Y-m-d'))=="ABSENT"): ?> <span class="label label-danger"><i class="fa fa-check-circle"></i> ABSENT CONFIRMÉ</span><?php else: ?> <span class="btnSetAbsent" data-user_id="<?php echo e($user->id); ?>" style="cursor:pointer" title="Marquer comme absent" ><span class="label label-warning"><i class="fa fa-check-circle"></i> TRAITER</span></span><?php endif; ?>
					</td> 
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>