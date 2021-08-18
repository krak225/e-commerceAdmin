<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('todoHome')); ?>"> TodoAPP</a></li>  
	<li><a href="<?php echo e(route('taches_all')); ?>"></i> Diligences</a></li>  
	<li class="active"><?php echo e($tache->tache_libelle); ?></li> 
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
	<h3 class="m-b-none"><?php echo e($tache->tache_libelle); ?></h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Informations</header> 
	
	<div class="col-md-12" style="padding-top:20px;">
		<div class="list-group col-md-12 radius"> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($tache->tache_libelle); ?></span> 
				<i class="fa fa- icon-muted"></i> Diligence
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($tache->tache_description); ?></span> 
				<i class="fa fa- icon-muted"></i> Description
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($tache->tache_critere_evaluation); ?></span> 
				<i class="fa fa- icon-muted"></i> Indicateurs
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($tache->categorie_tache_libelle); ?></span> 
				<i class="fa fa- icon-muted"></i> Catégorie 
			</span>
		 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?></span> 
				<i class="fa fa- icon-muted"></i> Date début prévu
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?></span> 
				<i class="fa fa- icon-muted"></i> Date fin prévu
			</span> 
			<span class="list-group-item"> 
				<span class="badge bg-light"><?php echo e($tache->nom . ' ' . $tache->prenoms); ?></span> 
				<i class="fa fa- icon-muted"></i> Créee par
			</span> 
			<span class="list-group-item btnChangerStatutTache" title ="Click-droit pour changer le statut"  data-tache_id="<?php echo e($tache->tache_id); ?>" data-tache_numero="<?php echo e($tache->tache_id); ?>" data-tache_libelle="<?php echo e($tache->tache_libelle); ?>" data-tache_statut_current="<?php echo e($tache->tache_statut); ?>"style="background:none;"> 
				<span class="badge " style="background: none;"> <span id="btnChangerStatutTache" data-tache_id="<?php echo e($tache->tache_id); ?>" class="btn btn-sm btn-default" style="display: inline-block;padding:0px 10px;">Changer le statut</span> <span class="label label-<?php echo e(strtolower(str_replace(' ','',$tache->tache_statut))); ?>"><?php echo e($tache->tache_statut); ?></span></span> 
				<i class="fa fa- icon-muted"></i> Statut 
			</span>
		</div>
	</div>
	<br style="clear:both;"/>	
</section>


<section class="panel panel-default"> 
	<header class="panel-heading"> Documents justificatifs des traitements </header> 
			
		<div class="" style="padding-bottom:10px;"> 
									
			<script src="<?php echo e(asset('js/jquery-1.9.1.min.js')); ?>"></script>
			<script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>

			<script type="text/javascript">

			var my_login =  '<?php echo e(Auth::user()->email); ?>';


			Dropzone.options.dropzone =
			{
				paramName: "fichier_justif",
				disablePreview: true,
				capture: null,
				dictDefaultMessage: "Déverser les fichiers ici !",
				maxFilesize: 5,
				renameFile: function(file) {
					var dt = new Date();
					var time = dt.getTime();
				   // return time+file.name;
				   return file.name;
				},
				acceptedFiles: ".jpeg,.jpg,.png,.gif, .pdf, .docx, .doc, .xlsx, .xls",
				addRemoveLinks: false,
				timeout: 5000,
				success: function(file, response) 
				{
					
					this.removeFile(file);
					
					var img_preview_src = (response.tache_fichier_extension=="jpg" || response.tache_fichier_extension=="jpeg" || response.tache_fichier_extension=="png" || response.tache_fichier_extension=="gif" )? 'data:'+response.tache_fichier_mimetype+';base64,'+response.tache_fichier_contenu : '<?php echo e(asset("images/icon-article.png")); ?>';
					
					$('#table_fichiers_traitement').append('<a target="_blank" href="<?php echo e(route("ShowPieceJointeTache","")); ?>/'+response.tache_fichier_id+' " title="'+response.tache_fichier_nom_original+'" class="apercu_fichier"><img src="'+img_preview_src+'" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/></a>');
					
					
				},
				error: function(file, response)
				{
				   return false;
				}
			};


				var csrf_token = $('meta[name="csrf-token"]').attr('content');
				var base_url = $("#eco_base_url").val();
				var base_url = '<?php echo e('http://'.$_SERVER['HTTP_HOST']); ?>/';
				
				function SupprimerPieceJointe(piecejointe_id, ligne_selectionnee){
					
					var url 			= base_url+'supprimerpiecejointe';
					var url_ok 	 		= '';
					
					noty({
						dismissQueue: false,
						force: true,
						layout:'center',
						modal: true,
						theme: 'defaultTheme',
						text:"Voulez-vous supprimer ce fichier ?",
						type: "information",
						buttons: [{addClass: 'btn btn-danger ', text: 'Supprimer', onClick: function($noty) {
						   $noty.close();
								
								$.ajax({
									headers:{'X-CSRF-TOKEN': csrf_token},
									type:'post',
									url: url,
									data: {piecejointe_id:piecejointe_id},
									success: function(e){
										
										if(e == 1){
											
											$('#ligne_pj'+piecejointe_id).hide();
											// ligne_selectionnee.hide();
											// location.href = url_ok;
											// notification("Suppression effectuée avec succès","success");
											
										}else if(e == 2){
											
											// notification("Vous ne pouvez pas supprimer cet fichier","warning");
											
										}else{
											
											// notification("Erreur lors de la suppression du fichier","error");
											
										}
										
									},
									error: function(){
										
										// notification("Erreur lors de la suppression du fichier","error");
										
									}
								});
								
						
							
						   }},
						   {addClass: 'btn btn-info ', text: 'Non', onClick: function($noty) {
								$noty.close();
							
						   
						   }}]
					});
					
					
				}

			</script>

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
			-->
			</style>

			<div class="row col-lg-12"> 

				<div class="col-md-5" style="border-right:1px dotted #eee;margin-top: 10px;">
					<form method="post" action="<?php echo e(route('UpdateFichiersTraitementTache',[$tache->tache_id])); ?>" enctype="multipart/form-data" class="dropzone" id="dropzone">
						<?php echo csrf_field(); ?>

						<div style="height:120px;" class="dz-message rounded0 btn btn-sm btn-default" data-dz-message>
							<span>
								<span class="fa-stack fa-2x pull-left m-r-sm"> 
									<i class="fa fa-circle fa-stack-2x text-info"></i> 
									<i class="fa fa-file-o fa-stack-1x text-white"></i> 
								</span> 
								Déverser les fichiers ici !
							</span>
						</div>
					</form>
				</div>
				<div class="col-md-7" id="table_fichiers_traitement">
					<?php $__currentLoopData = $tache_fichiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fichier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a target="_blank" href="<?php echo e(route('ShowPieceJointeTache',$fichier->tache_fichier_id)); ?>" title="<?php echo e($fichier->tache_fichier_nom_original); ?>" class="apercu_fichier">
						<?php if(in_array($fichier->tache_fichier_extension,array('jpg','jpeg','png','gif'))): ?>
						<img src="data:image/jpeg;base64,<?php echo e($fichier->tache_fichier_contenu); ?>" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/>
						<?php else: ?>
						<img src="<?php echo e(asset('images/icon-article.png')); ?>" style="border:1px solid #717171;margin:2px;width:100px;height:auto;" title="<?php echo e($fichier->tache_fichier_nom_original); ?>"/>
						<?php endif; ?>
					</a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				
			</div>

			<br style="clear:both;"/>
		
		</div>
			
</section>



<section class="panel panel-default"> 
	<header class="panel-heading">Utilisateurs affectés à cette tâche</header> 

	<div class="list-group no-radius alt"> 
		
		<div class="step-content clearfix" style="padding-bottom:0px;"> 
			<?php if(Stdfn::SiActionAutorisee('AFFECTER_TACHE')): ?>
			<?php if($tache->tache_statut != 'TERMINE'): ?>
			<div method="post" class="form-horizontal">
				
				<input type="hidden" id="tache_id" value="<?php echo e($tache->tache_id); ?>"/>
				
				<div class="step-pane active" id="step1"> 
					
					<div class="col-md-12 form-group">
						<div class="table-responsived"> 
							<table style="width:100%;">
								<tr>
									<td style="width:40%;padding-left:5px;">Utilisateur</td>
									<td style="width:30%;padding-left:5px;">Rôle</td>
									<td style="width:30%;padding-left:5px;">&nbsp;</td>
								</tr>
								<tr>
									<td style="padding:5px;">
										<div id="box_commentaire" >
											<select id="user_id" class="form-control" name="user_id" required>
												<option value="">Choisir</option>
												<?php $__currentLoopData = $autres_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($user->id); ?>"><?php echo e($user->nom.' '.$user->prenoms); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</td>
									<td style="padding:5px;">
										<div id="box_role" >
											<select id="role_id" class="form-control" name="role_id" required>
												<option value="">Choisir</option>
												<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($role->role_id); ?>"><?php echo e($role->role_libelle); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</td>
									<td style="padding:5px;">
										<div> 
											<button id="btnSaveUserTache" class="btn btn-success btn-sm">Ajouter</button> 
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					
				</div> 
				
				
			</div>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		
	</div> 
	
<!--/section>

<section class="panel panel-default"--> 
	<!--header class="panel-heading"> Liste des utilisateurs affectés</header--> 
	
	<div id="box_liste_utilisateurs_affectes"> 
		<div class="table-responsive" style="margin-top:-30px;"> 
			<table class="table table-striped m-b-none datatable"> 
				<thead> 
					<tr> 
						<th width="55%">Nom & Prénoms</th> 
						<th width="30%">Rôle</th> 
						<th width="15%">Action</th> 
					</tr> 
				</thead> 
				<tbody id="liste_utilisateurs_affectes">
				<?php $__currentLoopData = $users_affectes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($user->nom . ' ' . $user->prenoms); ?></td>
						<td><?php echo e($user->role_libelle); ?></td>
						<td><i class="fa fa-times text-danger btnSupprimerUserTache"data-user_tache_id="<?php echo e($user->user_tache_id); ?>" title="Supprimer" style="cursor:pointer;"></i></td>
					</tr>	
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody> 
			</table> 
		</div> 
	</div> 
	
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>