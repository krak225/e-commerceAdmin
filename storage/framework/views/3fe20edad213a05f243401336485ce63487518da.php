<?php $__env->startSection('content'); ?>
<?php if(!empty($commande)): ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('commandes')); ?>">Commandes</a></li> 
	<li class="active">Commande N°<?php echo e(Stdfn::truncateN($commande->commande_id,5)); ?></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Commande N°<?php echo e(Stdfn::truncateN($commande->commande_id,5)); ?></h3>
</div>

<?php if(Session::has('warning')): ?>
	<div class="alert alert-warning">
	  <?php echo e(Session::get('warning')); ?>

	</div>
<?php endif; ?>

<style type="text/css">
<!--
.title{
	padding:0px 15px;
}

.dz-preview, .dz-file-preview {
    display: none;
}
#table_justifs{
    border: 1px solid #eee;
	margin-top:0px;
}
#table_justifs th{
    background:#eee;	
}


.select-checkbox option::before {
  content: "\2610";
  width: 1.3em;
  text-align: center;
  display: inline-block;
}
.select-checkbox option:checked::before {
  content: "\2611";
}


ul.no_liste_item li {
  list-style:none;
}

.bold{font-weight:bold;}

-->
</style>

<div class="panel panel-default"> 

		<div class="col-lg-12" style="padding-top:15px;padding-left: 0px;padding-right: 0px;"> 
		<div class="row0"> 
			
			<div class="col-sm-7"> 
				<section class="panel panel-default"> 
					<header class="panel-heading bg-info lt no-border title"> 
						<div class="clearfix"> 
							<div class="clear"> 
							<div class="h3 m-t-xs m-b-xs text-white">
							<small style="color:white;">Informations sur la commande</small>
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="list-group no-radius alt"> 
						<div class="list-group-item"> 
							<span class="badge bg-light" style="background: none;"><span class="label label-default" style="font-size: 100%;"><?php echo e(Stdfn::truncateN($commande->commande_id,5)); ?></span></span> 
							<i class="fa fa- icon-muted"></i> Numéro 
						</div> 
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e($commande->nom.' '.$commande->prenoms); ?></span> 
							<i class="fa fa- icon-muted"></i> Nom du client 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(number_format($commande->commande_montant_ttc, 0, '', ' ')); ?> FCFA</span> 
							<i class="fa fa- icon-muted"></i> Montant total
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(Stdfn::dateTimeFromDB($commande->commande_date_creation)); ?></span> 
							<i class="fa fa- icon-muted"></i> Date commande
						</span> 	
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e($commande->commande_statut_livraison); ?></span> 
							<i class="fa fa- icon-muted"></i> Livraison
						</span> 	
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e($commande->commande_statut); ?></span> 
							<i class="fa fa- icon-muted"></i> Statut
						</span> 
						
						
					</div> 
					
				</section>
			</div>
			
			
			
			<div class="col-sm-5"> 
			
				<section class="panel panel-default">
					<header class="panel-heading bg-info lt no-border title"> 
						<div class="clearfix"> 
							<div class="clear"> 
							<div class="h3 m-t-xs m-b-xs text-white">
							<small style="color:white">Divers</small>
							
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div>
						<div style="height:200px;max-height:200px;overflow:auto;">
							<table class="table table-responsive" id="table_pieces_jointes"> 
								<tr>
									<td> 
									</td>
								</tr>
							</table> 
						</div>
					</div> 
				</section> 
			 	

			</div> 
		
		
			
		</div> 
		</div> 
		
		<br style="clear:both;"/>	
</div>

			<div class="line line-lg pull-in"></div>
				
			
<section class="panel panel-default"> 
	<header class="panel-heading"> Contenu de la commande
	</header> 
	
	<div class="table-responsive"> 
		<table id="table_courriers" class="table table-striped m-b-none datatable someClass"> 
			<thead> 
				<tr>
					<th width=""></th>
					<th width="">Image</th>
					<th width="">Nom</th>
					<th width="">Catégorie</th>
					<th width="">Prix unitaire</th>
					<th width="">Quantité</th>
					<th width="">Total</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route('DetailsProduit',$produit->produit_id)); ?>"><i class="fa fa-cogs text-info" title="Afficher les détails"></i></a></td> 
					<td><img src="<?php echo e(asset('images/produits/'.$produit->produit_photo)); ?>" style="width:50px;height:auto;"/></td> 
					<td><?php echo e($produit->produit_nom); ?></td>
					<td><?php echo e($produit->categorie_nom); ?></td>
					<td style="text-align: right;"><?php echo e(number_format($produit->panier_produit_pu, 0, '', ' ')); ?></td>
					<td style="text-align: center;"><?php echo e($produit->panier_quantite); ?></td>
					<td style="text-align: right;font-weight:bold;"><?php echo e(number_format($produit->panier_produit_pu * $produit->panier_quantite, 0, '', ' ')); ?>  FCFA</td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

			
		 
		
		</div>
		
	</div>

		</div>

	</div>


<?php else: ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('commandes')); ?>">Commandes</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Commande introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		La commande que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>