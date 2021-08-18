<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('etablissements')); ?>"></i> Etablissements</a></li>  
	<li class="active"><?php echo e($etablissement->etablissement_nom); ?></li> 
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
	<h3 class="m-b-none"><?php echo e($etablissement->etablissement_nom); ?></h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Informations</header> 
	
	<div class="col-md-12" style="padding-top:20px;">
		<div class="list-group col-md-6 radius"> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->etablissement_nom); ?></span> 
				<i class="fa fa- icon-muted"></i> Nom
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->nature_affaire_id); ?></span> 
				<i class="fa fa- icon-muted"></i> Nature 
			</span>
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->etablissement_representant); ?></span> 
				<i class="fa fa- icon-muted"></i> Representant 
			</span>
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->etablissement_telephone); ?></span> 
				<i class="fa fa- icon-muted"></i> Téléphone
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light" style="background: orange;color:white;font-size: 15px;"><?php echo e(substr($etablissement->etablissement_code_mobile,0,2) .' '. substr($etablissement->etablissement_code_mobile,2,2) .' '. substr($etablissement->etablissement_code_mobile,4,4)); ?></span> 
				<i class="fa fa- icon-muted"></i> Code mobile
			</span> 
		</div>
		<div class="list-group col-md-6 radius"> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->etablissement_type_support); ?></span> 
				<i class="fa fa- icon-muted"></i> Type support
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->BDN_COMMUNE_LIBELLE .' / '. $etablissement->etablissement_quartier); ?></span> 
				<i class="fa fa- icon-muted"></i> Commune/Quartier 
			</span>
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->etablissement_observations); ?></span> 
				<i class="fa fa- icon-muted"></i> Observations 
			</span>
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($etablissement->nom . " ". $etablissement->prenoms); ?></span> 
				<i class="fa fa- icon-muted"></i> Enregistré par 
			</span>
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e(Stdfn::dateFromDB($etablissement->etablissement_date_creation)); ?></span> 
				<i class="fa fa- icon-muted"></i> Date 
			</span>
		</div>
	</div>
	<br style="clear:both;"/>	
</section>

<section class="panel panel-default"> 
	<header class="panel-heading"> Géolocalisation</header> 
	
	<div class="table-responsive"> 

		<iframe style="width:100%;height:450px;" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $etablissement->etablissement_latitude; ?>%2C<?php echo $etablissement->etablissement_longitude; ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>