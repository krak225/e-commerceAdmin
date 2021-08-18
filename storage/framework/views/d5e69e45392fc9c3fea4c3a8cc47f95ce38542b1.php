<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('courrierHome')); ?>"> Courrier APP</a></li>   
	<li class="active">Mémos</li> 
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
	<h3 class="m-b-none">Gestion des mémos</h3> 
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des mémos
		<div class="actions pull-right" style="padding:0px;"> 
			<a class="btn btn-sm btn-info" href="<?php echo e(route('memo')); ?>" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouveau</a>
		</div>
	</header> 
	
	<div class="table-responsive"> 
		<table id="memos" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width=""></th>
					<th width="">Objet</th>
					<th width="">Expéditeur</th>
					<th width="">Date</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $memos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsMemo',$memo->memo_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher ce mémo"></i></a></td> 
					<td><a target="_blank" href="<?php echo e(route('ImprimerMemo',$memo->memo_id)); ?>"><i class="fa fa-print text-info" title="Imprimer ce mémo"></i></a></td> 
					<td><?php echo e($memo->memo_objet); ?></td>
					<td><?php echo e($memo->nom . ' ' . $memo->prenoms); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($memo->memo_date_creation)); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>