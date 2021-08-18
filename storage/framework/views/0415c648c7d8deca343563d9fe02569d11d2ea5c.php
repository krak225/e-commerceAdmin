<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Statistiques prospection par équipe</li> 
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
	<h3 class="m-b-none">Statistiques des prospections par équipe</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Statistiques des prospections par équipe</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="30%">Equipe</th>
					<th width="15%">Date saisie</th>
					<th width="10%">Nombre</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsEquipe',$user->equipe_id)); ?>"><?php echo e($user->equipe_nom); ?></a></td>
					<td><?php echo e(Stdfn::dateFromDB($user->date_saisie)); ?></td>
					<td style="text-align:center;"><?php echo e($user->total); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div>
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>