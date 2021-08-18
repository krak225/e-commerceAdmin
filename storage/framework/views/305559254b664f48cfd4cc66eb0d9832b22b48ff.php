<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('courrierHome')); ?>"> Courriers</a></li>   
	<li class="active">Courriers</li> 
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

<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul style="padding-left: 5px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="m-b-md"> 
	<h3 class="m-b-none">Gestion des courriers</h3> 
</div>


<?php if(Stdfn::SiActionAutorisee('SAISIECOURRIER')): ?>
<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau courrier</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveCourrier')); ?>" enctype="multipart/form-data" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group<?php echo e($errors->has('courrier_objet') ? ' has-error' : ''); ?>">
					
					<div class="col-md-12 row">
						
						<div class="col-md-5">
							<span> Objet <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="courrier_objet"  value="<?php echo e(old('courrier_objet')); ?>" required>
						</div>
						
						<div class="col-md-5">
							<span> Expéditeur<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="text" class="form-control" name="courrier_expediteur" value="<?php echo e(old('courrier_expediteur')); ?>" required>
						</div>
						
						<div class="col-md-2">
							<span> Numéro<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="text" class="form-control" name="courrier_numero" required> 
						</div>

					</div>
					
					<div class="col-md-12 row" style="margin-top:10px;">	
						
						<div class="col-md-5">
							<span> Fichier<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="file" class="form-control" name="courrier_fichier" required>
							
						</div>
						
						<div class="col-md-3">
							<span> Date arrivée<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="date" class="form-control" name="courrier_date_arrivee" value="<?php echo e(old('courrier_date_arrivee')); ?>" required>
							
						</div>
						
						<div class="col-md-2">
							<span> Heure arrivée <span class="text text-danger"></span></span>
							<input style="padding-top:0px;" placeholder="" type="time" class="form-control" name="courrier_heure_arrivee" value="<?php echo e(old('courrier_heure_arrivee')); ?>" >
							
						</div>
						
						<div class="col-md-1">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="submit" class="btn btn-success btn-sm rounded">ENREGISTRER</button> 
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>
<?php endif; ?>


<section class="panel panel-default"> 
	<header class="panel-heading"> <?php echo e($page_title); ?>

		<!--div class="actions pull-right" style="padding:0px;"> 
			<a class="btn btn-sm btn-info" href="<?php echo e(route('courriers')); ?>" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouveau</a>
		</div-->
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Numéro</th>
					<th width="">Objet</th>
					<th width="">Expéditeur</th>
					<th width="">Date arrivée</th>
					<!--th width="">Proposition imputation</th-->
					<th width="">Imputation</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $courriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courrier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsCourrier',$courrier->courrier_id)); ?>"><i class="fa fa-cogs text-info" title="Afficher les information"></i></a></td> 
					<td><span class="label label-default"><?php echo e(Stdfn::truncateN($courrier->courrier_numero,5)); ?></span></td> 
					<td><?php echo e($courrier->courrier_objet); ?></td>
					<td><?php echo e($courrier->courrier_expediteur); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($courrier->courrier_date_arrivee)); ?></td>
					<!--td><span class="label <?php if($courrier->courrier_statut_proposition_imputation == 'PROPOSE'): ?> label-info <?php else: ?> label-default <?php endif; ?> "><?php echo e($courrier->courrier_statut_proposition_imputation); ?></span></td-->
					<td><span class="label <?php if($courrier->courrier_statut_imputation == 'IMPUTE'): ?> label-info <?php else: ?> label-default <?php endif; ?> "> <?php echo e($courrier->courrier_statut_imputation); ?> </span><?php if($courrier->courrier_statut_imputation == "NON IMPUTE" && $courrier->courrier_statut_proposition_imputation == "PROPOSE"): ?><i class="fa fa-star text-danger" title="Propositions effectuées par l'assistante" style="margin-left: 3px;"></i><?php endif; ?> <?php if($courrier->courrier_statut_imputation == "IMPUTE" && $courrier->courrier_statut_consultation_imputation == "VU"): ?><i class="fa fa-eye text-success" title="Vu par le service chargé du traitement" style="margin-left: 3px;"></i><?php endif; ?>
					</td>
					<td><span class="label <?php if($courrier->courrier_statut_traitement == 'TRAITE'): ?> label-success <?php else: ?> label-warning <?php endif; ?> "><?php echo e($courrier->courrier_statut_traitement); ?></span></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>