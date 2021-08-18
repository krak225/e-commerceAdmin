<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Courses</li> 
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
	<h3 class="m-b-none">Gestion des courses</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des courses
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable "> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Client</th>
					<!--th width="">Téléphone</th-->
					<th width="">Nature de la course</th>
					<th width="">Départ</th>
					<th width="">Destination</th>
					<th width="">Frais</th>
					<th width="">Date</th>
					<th width="">Livraison</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsCourse',$course->course_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les détails"></i></a></td> 
					<td><?php echo e(ucfirst($course->utilisateur_login)); ?></td>
					<!--td><?php echo e($course->utilisateur_telephone); ?></td-->
					<td><?php echo e($course->nature_course); ?></td>
					<td><?php echo e($course->commune_retrait_libelle); ?></td>
					<td><?php echo e($course->commune_livraison_libelle); ?></td>
					<td style="text-align: right;"><?php echo e(number_format($course->frais_livraison, 0, '', ' ')); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($course->date_creation)); ?></td>
					<td><span class="label label-<?php echo e(strtolower(str_replace(' ','',$course->statut_livraison))); ?> "><?php echo e($course->statut_livraison); ?></span></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>