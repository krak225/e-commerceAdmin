<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Retardataires</li> 
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
	<h3 class="m-b-none"> Retardataires</h3> 
</div>

<section class="panel panel-default"> 

	<header class="panel-heading"> Sélectionner une période pour voir les retardataires
		<span> 
			<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" title="recherche" id="crtlBoxRecherche">Recherche avancée <b class="caret"></b></a> 
		</span>
	</header> 
	<div class="panel-body dropdown" style="background:#d9edf7;" id="boxRecherche"> 
		<div class="">
			<form class="form" method="get" action="<?php echo e(route('retardataires')); ?>">
				
				<!--<?php echo csrf_field(); ?>-->
				
				<div class="row">
					
					<div class="col-md-12" style="margin-top:7px;">
						
						<label for="date_debut" class="col-md-2 control-label">Date début</label>

						<div class="col-md-3">
							
							<input type="date" id="date_debut" class="form-control" name="db" value="<?php echo e($date_debut); ?>" style="padding-top:0px;" required0 />
							
						</div>
					
						
						<label for="date_fin" class="col-md-2 control-label">Date fin</label>

						<div class="col-md-3">
							
							<input type="date" id="date_fin" class="form-control" name="df" value="<?php echo e($date_fin); ?>" style="padding-top:0px;" required0 />
							
						</div>
						
						<div class="col-md-2 pull-right" style="">
							<button name="search" value="Rechercher" type="submit" class="btn btn-warning rounded"><i class="fa fa-search"></i> Rechercher</button>
						</div>
						
					</div>
					
					<hr/>
					
				</div>
				
				
			</form>
			
		</div>
	</div>
	
</section>	


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des retardataires</header> 
	
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
					<!--th width="10%">Actions</th-->
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e(Stdfn::dateFromDB($user->date)); ?></td>
					<td><?php echo e($user->matricule); ?></a></td>
					<td><a href="<?php echo e(route('DetailsUtilisateur',$user->id)); ?>"><?php echo e($user->nom .' '.$user->prenoms); ?></td> 
					<td><span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_arrivee)); ?></span></td> 
					<td><span class="heure_saisie heure_confirme"><?php echo e(Stdfn::timeFromDB($user->pointage_depart)); ?></span></td> 
					<td><?php echo e(substr($user->temps_retard,0,5)); ?></td>
					<!--td></td-->
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>