<?php $__env->startSection('content'); ?>
<?php if(!empty($memo)): ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courrierHome')); ?>"> CourrierAPP</a></li> 
	<li><a href="<?php echo e(route('memos')); ?>">Mémos</a></li> 
	<li class="active"><?php echo e(ucfirst(strtolower($memo->memo_objet))); ?></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none"><?php echo e($memo->memo_objet); ?></h3>
</div>

<?php if(Session::has('warning')): ?>
	<div class="alert alert-warning">
	  <?php echo e(Session::get('warning')); ?>

	</div>
<?php endif; ?>

<div class="actions pull-right" style="padding:5px 10px;"> 
	<a href="<?php echo e(route('ImprimerMemo',$memo->memo_id)); ?>"><i class="fa fa-print"></i> Imprimer</a>
</div>

<div class="panel panel-default"> 

	<div class="step-content clearfix"> 
				
		<?php echo html_entity_decode($memo->memo_contenu) ?>
		
	</div> 
		
</div>

	

<?php else: ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courrierHome')); ?>"> CourrierAPP</a></li> 
	<li><a href="<?php echo e(route('courriers')); ?>">Mémos</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Mémo introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		Le mémo que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>