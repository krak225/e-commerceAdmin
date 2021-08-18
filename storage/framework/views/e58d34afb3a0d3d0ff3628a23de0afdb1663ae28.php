<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Pointage départ</li> 
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
	<h3 class="m-b-none"> Pointage départ</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Saisie des heures de départ</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="5%">ID</th>
					<th width="15%">Matricule</th>
					<th width="20%">Nom</th> 
					<th width="">Prénoms</th> 
					<th width="">Date</th> 
					<th width="15%">Arrivé</th> 
					<!--th width="10%"></th--> 
					<th width="15%">Départ</th> 
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
					<td><?php echo e(Stdfn::dateFromDB($user->pointage_date)); ?></td>
					<td>
						<span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_arrivee)); ?></span>
					</td>
					<!--td>
						<?php if($user->pointage_arrivee==""): ?><span class="btnSaveHeureArrivee" data-pointage_id="<?php echo e($user->pointage_id); ?>" data-user_id="<?php echo e($user->id); ?>" style="cursor:pointer" title="Enregistrer l'heure d'arrivé" ><span class="label label-success"><i class="fa fa-check-circle"></i> VALIDER</span></span><?php endif; ?>
					</td--> 
					<td>
						<?php if($user->pointage_depart==""): ?><input id="heure_depart_<?php echo e($user->id); ?>" date-user_id="<?php echo e($user->id); ?>" class="heure_depart heure_saisie" type="time" style="padding:0px;padding-top:-5px;"/> <?php else: ?> <span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_depart)); ?></span> <?php endif; ?>
					</td>	
					<td>	
						<?php if($user->pointage_depart==""): ?><span class="btnSaveHeureDepart" data-pointage_id="<?php echo e($user->pointage_id); ?>" data-user_id="<?php echo e($user->id); ?>" style="cursor:pointer" title="Enregistrer l'heure de départ" ><span class="label label-success"><i class="fa fa-check-circle"></i> VALIDER</span></span><?php endif; ?>
					</td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>