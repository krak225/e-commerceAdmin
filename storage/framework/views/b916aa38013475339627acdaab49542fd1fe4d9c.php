<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Produits</li> 
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
	<h3 class="m-b-none">Gestion des produits</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau produit</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="<?php echo e(route('SaveProduit')); ?>" enctype="multipart/form-data" class="form-horizontal">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group<?php echo e($errors->has('produit_nom') ? ' has-error' : ''); ?>">
					
					<div class="col-md-12 row">
						
						<div class="col-md-5">
							<span> Nom du produit <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="produit_nom"  value="<?php echo e(old('produit_nom')); ?>" required>
						</div>
						
						<div class="col-md-5">
							<span> Description<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="text" class="form-control" name="produit_description" value="<?php echo e(old('produit_description')); ?>" required>
						</div>
						
						<div class="col-md-2">
							<span> Prix<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="number" class="form-control" name="produit_prix" required> 
						</div>

					</div>
					
					<div class="col-md-12 row" style="margin-top:10px;">	
						
						<div class="col-md-5">
							<span> Photo<span class="text text-danger">*</span></span>
							<input style="padding-top:0px;" placeholder="" type="file" class="form-control" name="produit_photo" required>
							
						</div>
						
						<div class="col-md-4">
							<span> Catégorie <span class="text text-danger">*</span></span>
							<select id="categorie_id" class="form-control" name="categorie_id" required>
								<option value="">Choisir</option>
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($categorie->categorie_id); ?>"><?php echo e($categorie->categorie_nom); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						
						<!--div class="col-md-2">
							<span> Stock<span class="text text-danger"></span></span>
							<input style="padding-top:0px;" placeholder="" type="number" class="form-control" name="produit_stock" value="<?php echo e(old('produit_stock')); ?>" >
														
						</div-->
						
						<div class="col-md-2">
							<span>&nbsp; <span class="text text-danger"></span></span>
							<button type="submit" class="btn btn-success btn-sm rounded">ENREGISTRER</button> 
						</div>
						
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des produits
		<!--div class="actions pull-right" style="padding:0px;"> 
			<a class="btn btn-sm btn-info" href="<?php echo e(route('produits')); ?>" style="padding:2px 10px;"><i class="fa fa-plus"></i> Nouveau</a>
		</div-->
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Image</th>
					<!--th width="">Numéro</th-->
					<th width="">Nom</th>
					<th width="">Catégorie</th>
					<th width="">Prix</th>
					<th width="">Date création</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsProduit',$produit->produit_id)); ?>"><i class="fa fa-cogs text-info" title="Afficher les détails"></i></a></td> 
					<td><img src="<?php echo e(asset('images/produits/'.$produit->produit_photo)); ?>" style="width:50px;height:auto;"/></td> 
					<!--td><span class="label label-default"><?php echo e(Stdfn::truncateN($produit->produit_id,5)); ?></span></td--> 
					<td><?php echo e($produit->produit_nom); ?></td>
					<td><?php echo e($produit->categorie_nom); ?></td>
					<td style="text-align: right;"><?php echo e(number_format($produit->produit_prix, 0, '', ' ')); ?></td>
					<td><?php echo e(Stdfn::dateFromDB($produit->produit_date_creation)); ?></td>
					<td><span class="btnSupprimerProduit" data-produit_id="<?php echo e($produit->produit_id); ?>" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer ce produit"></i></a></td> 
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>