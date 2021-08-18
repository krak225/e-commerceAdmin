<?php $__env->startSection('content'); ?>
<?php if(!empty($course)): ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courses')); ?>">Courses</a></li> 
	<li class="active">Course N°<?php echo e(Stdfn::truncateN($course->course_id,5)); ?></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Course N°<?php echo e(Stdfn::truncateN($course->course_id,5)); ?></h3>
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
							<small style="color:white;">Informations sur la course</small>
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="list-group no-radius alt"> 
						<div class="list-group-item"> 
							<span class="badge bg-light" style="background: none;"><span class="label label-default" style="font-size: 100%;"><?php echo e(Stdfn::truncateN($course->course_id,5)); ?></span></span> 
							<i class="fa fa- icon-muted"></i> Numéro 
						</div> 
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(ucfirst($course->nature_course)); ?></span> 
							<i class="fa fa- icon-muted"></i> Nature de la course 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(ucfirst($course->commune_retrait_libelle)); ?></span> 
							<i class="fa fa- icon-muted"></i> Lieu de retrait 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(ucfirst($course->commune_livraison_libelle)); ?></span> 
							<i class="fa fa- icon-muted"></i> Lieu de livraison 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(number_format($course->frais_livraison, 0, '', ' ')); ?> FCFA</span> 
							<i class="fa fa- icon-muted"></i> Frais de livraison
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(Stdfn::dateTimeFromDB($course->date_creation)); ?></span> 
							<i class="fa fa- icon-muted"></i> Date course
						</span>
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(ucfirst($course->utilisateur_login)); ?></span> 
							<i class="fa fa- icon-muted"></i> Nom du client 
						</span>
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(ucfirst($course->utilisateur_telephone)); ?></span> 
							<i class="fa fa- icon-muted"></i> Contact du client 
						</span>	
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e($course->statut); ?></span> 
							<i class="fa fa- icon-muted"></i> Statut
						</span> 
						
						<span class="list-group-item"> 
							<span class="badge " style="background:none;"><?php if($course->statut_livraison == "NON LIVREE"): ?><span id="btnChangerStatutLivraisonCourse" data-course_id="<?php echo e($course->course_id); ?>" class="btn btn-sm btn-default" style="display: inline-block;padding:0px 10px;">Changer le statut</span> <?php endif; ?> <span class="label label-<?php echo e(strtolower(str_replace(' ', '',$course->statut_livraison))); ?>"><?php echo e($course->statut_livraison); ?></span></span> 
							<i class="fa fa- icon-muted"></i> Statut livraison 
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

		</div>
		
	</div>

		</div>

	</div>


<?php else: ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courses')); ?>">Courses</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Course introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		La course que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>