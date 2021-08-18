<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active"><a href="<?php echo e(route('perceptions')); ?>">Perceptions</a> </li> 
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
	<h3 class="m-b-none">Liste des perceptions</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des perceptions <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
		<?php if(Auth::user()->profil_id == 1): ?>
		<span> 
			<a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" title="recherche" id="crtlBoxRecherche">Recherche avancée <b class="caret"></b></a> 
		</span>
		<?php endif; ?>
	</header> 
	
	<div class="panel-body dropdown" style="background:#d9edf7;" id="boxRecherche"> 
		<div class="">
			<form class="form" method="get" action="<?php echo e(route('perceptions')); ?>">
				
				<!--<?php echo csrf_field(); ?>-->
				
				<div class="row">
					
					<div class="col-md-12">
						
						<label for="bureau_id" class="col-md-2 control-label">Bureau</label>
						
						<div class="col-md-4">
							
							<select id="bureau_id" class="form-control" name="b">
								<option value=""></option>
								<?php $__currentLoopData = $bureaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bureau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option <?php if($selectedBureauID == $bureau->bureauID): ?> selected <?php endif; ?> value="<?php echo e($bureau->bureauID); ?>"><?php echo e($bureau->bureauLibelle); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							
						</div>
					
						
						<label for="percepteur" class="col-md-2 control-label">Percepteur</label>

						<div class="col-md-4">
							
							<select id="percepteur_id" class="form-control" name="u">
								<option value=""></option>
							</select>
							
						</div>
					
					</div>
					
					<div class="col-md-12" style="margin-top:7px;">
						
						<label for="date_debut" class="col-md-2 control-label">Date début</label>

						<div class="col-md-4">
							
							<input type="date" id="date_debut" class="form-control" name="db" value="<?php echo e($date_fin); ?>" style="padding-top:0px;" required0 />
							
						</div>
					
						
						<label for="date_fin" class="col-md-2 control-label">Date fin</label>

						<div class="col-md-4">
							
							<input type="date" id="date_fin" class="form-control" name="df" value="<?php echo e($date_fin); ?>" style="padding-top:0px;" required0 />
							
						</div>
					
					</div>
					
					<hr/>
					
					<div class="col-md-12">
						<div class="col-md-4 pull-right" style="padding-top:10px;">
							<button name="search" value="Rechercher" type="submit" class="btn btn-warning rounded"><i class="fa fa-search"></i> Rechercher</button>
						</div>
					</div>
					
					
				</div>
				
				
			</form>
			
		</div>
	</div> 
	
	
	
	<!--header class="panel-heading"> Liste des perceptions <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header--> 
	
	<div class="col-md-12" style="padding:15px;background:rgb(192,227,245);border-bottom:1px solid #272727;border-top:1px solid #272727;">
		<div class="col-md-4 pull-right" style="text-align:right;">
			<strong>Montant Total : <?php echo e(number_format($recherche_montant_total, 0, '', ' ')); ?> FCFA</strong> 
		</div>
	</div>
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="15%">Bureau</th>
					<th width="20%">Percepteur</th>
					<th width="15%">Date</th>
					<th width="15%">Montant</th> 
					<th width="10%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $perceptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($user->bureauLibelle); ?></td> 
					<td><?php echo e($user->nom . ' '. $user->prenoms); ?></td> 
					<td><?php echo e(Stdfn::dateTimeFromDB($user->perception_date)); ?></td> 
					<td><?php echo e($user->perception_montant); ?></td>
					<td><?php echo e($user->perception_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
	
	
	<div class="col-md-12" style="margin-bottom:50px;padding:15px;background:rgb(192,227,245);border-bottom:1px solid #272727;border-top:1px solid #272727;">
		<div class="col-md-4 pull-right" style="text-align:right;">
			<strong>Montant Total : <?php echo e(number_format($recherche_montant_total, 0, '', ' ')); ?> FCFA</strong> 
		</div>
	</div>
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>