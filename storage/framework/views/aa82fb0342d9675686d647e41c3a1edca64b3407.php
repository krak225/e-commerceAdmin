<?php $__env->startSection('content'); ?>
<?php if(!empty($courrier)): ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courrierHome')); ?>"> CourrierAPP</a></li> 
	<li><a href="<?php echo e(route('courriers')); ?>">Courriers</a></li> 
	<li class="active"><?php echo e(ucfirst(strtolower($courrier->courrier_objet))); ?></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none"><?php echo e($courrier->courrier_objet); ?></h3>
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
							<small style="color:white;">Informations sur le courrier</small>
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="list-group no-radius alt"> 
						<div class="list-group-item"> 
							<span class="badge bg-light" style="background: none;"><span class="label label-default" style="font-size: 100%;"><?php echo e(Stdfn::truncateN($courrier->courrier_numero,5)); ?></span></span> 
							<i class="fa fa- icon-muted"></i> Numéro du courrier
						</div> 
						<div class="list-group-item"> 
							Objet 
							<div class="badged bg-light" style="display:block;"> <?php echo e($courrier->courrier_objet); ?></div> 
						</div> 
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e($courrier->courrier_expediteur); ?></span> 
							<i class="fa fa- icon-muted"></i> Expéditeur
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(Stdfn::dateTimeFromDB($courrier->courrier_date_arrivee)); ?></span> 
							<i class="fa fa- icon-muted"></i> Date arrivée
						</span> 
						<span class="list-group-item"> 
							<span class="badge bg-light"><?php echo e(Stdfn::dateTimeFromDB($courrier->courrier_date_imputation)); ?></span> 
							<i class="fa fa- icon-muted"></i> Date imputation
						</span> 
						
						<!--span class="list-group-item"> 
							<span class="badge " style="background:none;"><?php if($courrier->courrier_statut_diligence == "NON DILIGENCE"): ?><span id="btnCreerDiligenceWithCourrier" data-courrier_id="<?php echo e($courrier->courrier_id); ?>" class="btn btn-sm btn-default" style="display: inline-block;padding:0px 10px;">En faire une diligence</span> <?php endif; ?> <span class="label label-<?php echo e(strtolower(str_replace(' ', '',$courrier->courrier_statut_diligence))); ?>"><?php echo e($courrier->courrier_statut_diligence); ?></span></span> 
							<i class="fa fa- icon-muted"></i> Est-ce une diligence ?  
						</span-->

						<?php if(!empty($imputations_a_moi_assignes['ic_fichiers_traitement'])): ?>	
						<span class="list-group-item"> 
							<span class="badge " style="background:none;"><?php if($courrier->courrier_statut_traitement == "NON TRAITE"): ?><span id="btnChangerStatutTraitementCourrier" data-courrier_id="<?php echo e($courrier->courrier_id); ?>" class="btn btn-sm btn-default" style="display: inline-block;padding:0px 10px;">Changer le statut</span> <?php endif; ?> <span class="label label-<?php echo e(strtolower(str_replace(' ', '',$courrier->courrier_statut_traitement))); ?>"><?php echo e($courrier->courrier_statut_traitement); ?></span></span> 
							<i class="fa fa- icon-muted"></i> Statut traitement 
						</span>
						<?php endif; ?>
						
					</div> 
					
				</section>
			</div>
			
			
			
			<div class="col-sm-5"> 
			
				<section class="panel panel-default">
					<header class="panel-heading bg-info lt no-border title"> 
						<div class="clearfix"> 
							<div class="clear"> 
							<div class="h3 m-t-xs m-b-xs text-white">
							<small style="color:white">Le fichier numérique</small>
							
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div>
						<div style="height:200px;max-height:200px;overflow:auto;">
							<table class="table table-responsive" id="table_pieces_jointes"> 
								<tr> 
									<th>Aperçu</th>
								</tr>
								<?php $__currentLoopData = $piecesjointes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piecejointe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td> 
										<a target="_blank" href="<?php echo e(route('ShowPieceJointe',$piecejointe->courrier_fichier_id)); ?>" title="Afficher la pièce jointe" class="apercu_fichier">
											<?php if(in_array($piecejointe->courrier_fichier_extension,array('jpg','jpeg','png','gif'))): ?>
											<img src="data:image/jpeg;base64,<?php echo e($piecejointe->courrier_fichier_contenu); ?>" style="width:80px;height:auto;"/>
											<?php else: ?>
											<img src="<?php echo e(asset('images/icon-48-article.png')); ?>" style="width:80px;height:auto;" title="Cliquez pour afficher ou télécharger"/>
											<?php endif; ?>
										</a>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</table> 
						</div>
					</div> 
				</section> 
			 	
			 	<!-- chat box button -->

			 	<!-- //chat box button -->
				

			</div> 
		
		
			
		</div> 
		</div> 
		
		<br style="clear:both;"/>	
</div>

<hr style="clear:both;"/>

<!-- Si le courrier a le statut imputé -->
<?php if($courrier->courrier_statut_imputation == "IMPUTE"): ?>

	<!-- liste imputation adressé à l'utilisateur connecté -->
	<?php $i = -1; ?>
	<?php if(!empty($imputations_a_moi_assignes)): ?>
	<?php $__currentLoopData = $imputations_a_moi_assignes['ic']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imputation_courrier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php $i++; ?>
	<!-- -->
	<div class="panel panel-default"> 
		<header class="panel-heading bg-warning lt no-border title"> 
			<div class="clearfix"> 
				<div class="clear"> 
					<div class="h3 m-t-xs m-b-xs text-white">
						<small style="color:white">CE COURRIER VOUS A ETE IMPUTÉ</small>
						<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
					</div>  
				</div> 
			</div> 
		</header>
		
		<div class="wizard-steps clearfix" id="form-wizard"> 
			<!--ul class="steps"> 
				<li data-target="#step3"><span class="badge"></span>Transmettre le courrier à une direction, un département ou un service</li>
			</ul--> 
		</div> 

		<?php if(Session::has('message')): ?>
			<div class="alert alert-success">
			  <?php echo e(Session::get('message')); ?>

			</div>
		<?php endif; ?>

		<?php if(Session::has('warning_erreur_calcul')): ?>
			<div class="alert alert-warning">
			  <?php echo e(Session::get('warning_erreur_calcul')); ?>

			</div>
		<?php endif; ?>


		<div class="step-content clearfix"> 
			
				<div class="step-pane active" id="step1"> 
					
					<div class="col-md-12"> 
					
						<div class="col-md-5 row"> 
								
							<div class="form-group<?php echo e($errors->has('executants') ? ' has-error' : ''); ?>">
								<label for="executants" class="col-md-12 bold"><u>Destinataires : </u></label>

								<div class="col-md-12">
									<ul class="no_liste_item">
									<?php $__currentLoopData = $imputations_a_moi_assignes['ic_executants'][$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><i class="fa fa-check-square-o" style="color:green;"></i> <?php echo e($service->service_nom); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>	
								</div>
								
							</div>
							
						</div>
						
						<div class="col-md-5"> 
								
							<div class="form-group<?php echo e($errors->has('objectifs') ? ' has-error' : ''); ?>">
								<label for="objectifs" class="col-md-12 bold"><u>Recommandations : </u></label>

								<div class="col-md-12">
									<ul class="no_liste_item">
									<?php $__currentLoopData = $imputations_a_moi_assignes['ic_actionaeffectuer'][$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objectif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><i class="fa fa-check-square-o" style="color:green;"></i> <?php echo e($objectif->objectif_imputation_libelle); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>	
								</div>
								
							</div>

						</div>


						<div class="col-md-2"> 
								
							<span id="btnPartagerCourrier" data-courrier_id="<?php echo e($courrier->courrier_id); ?>"  data-courrier_numero="<?php echo e($courrier->courrier_numero); ?>" class="btn btn-sm btn-danger" style="display: inline-block;padding:0px 10px;" title="Partager avec vos collaborateurs"><i class="fa fa-share-square"></i> Accorder l'accès</span>

						</div>
						
						
					</div>
					
					
					
					<div class="col-md-12">

						<div class="form-group<?php echo e($errors->has('priorite') ? ' has-error' : ''); ?>">
							<label for="priorite" class="col-md-4 bold"><u>Signalisation: </u></label>
							
							<div class="col-md-8">
								<div><?php if($imputation_courrier->priorite_id==1): ?><i class="fa fa-exclamation-triangle" style="color:red;"></i><?php endif; ?> <?php echo e($imputation_courrier->priorite_libelle); ?></div>
							</div>
							
						</div>

					</div>
					
					<div class="col-md-12" style="padding-bottom:10px;"> 
							
						<div class="form-group<?php echo e($errors->has('observations') ? ' has-error' : ''); ?>">
							<label for="observations" class="col-md-12 bold"><u>Observations: </u></label>

							<div class="col-md-12">
								<div><?php echo e($imputation_courrier->imputation_courrier_observations); ?></div>
							</div>
						</div>

					</div>
					
					

					<!-- bloc des commentaires (à reorganiser dup) -->
					<?php if(Stdfn::SiActionAutorisee('COURRIER_SEE_CHAT')): ?>
					<div class="line line-lg pull-in"></div>
					
					<div class="panel panel-default" style="padding-bottom:10px;"> 
										
						<div class="col-sm-12" style="padding:0px;"> 
							<section class="panel panel-default"> 
								<header class="panel-heading bg-info lt no-border title"> 
									<div class="clearfix"> 
										<div class="clear"> 
										<div class="h3 m-t-xs m-b-xs text-white">
										<small style="color:white;"><i class="fa  fa-comments"></i> COMMENTAIRES</small>
										<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
										</div>  
										</div> 
									</div> 
								</header> 
							</section>
						</div>

						<div class="row col-lg-12" style="padding: 0px;margin: 0px;"> 
							
							<div class="col-md-12">
								<form method="post" action="<?php echo e(route('SaveCommentaire')); ?>">
									<?php echo csrf_field(); ?>

									<input type="hidden" name="courrier_id" id="courrier_id" value="<?php echo e($courrier->courrier_id); ?>"/>
									<div class="col-md-12" style="margin:0px;padding: 0px;">
										<textarea id="" placeholder="Ecrire un message..." rows="5" name="message" required style="width: 100%;"></textarea>
									</div>	
									<div class="col-md-12 pull-right text-right" style="margin:0px;padding: 0px;">	
										<button class="button btn btn-success btn-footer" type="submit"><i class="fa  fa-send-o"></i> Envoyer</button>
									</div>
								</form>
							</div> 

							<div class="col-md-12 panel panel-default" id="comments_box"> 

								<section class="comments">

									<?php $__currentLoopData = $commentaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								    <article class="comment">
								      <a class="comment-img" href="<?php echo e(route('DetailsUtilisateur',$commentaire->id)); ?>" title="<?php echo e($commentaire->civilite .' '. $commentaire->nom . ' ' . $commentaire->prenoms); ?>">
								        <?php if(File::exists('images/'. $commentaire->photo ) && !is_dir('images/'. $commentaire->photo) ): ?>
									  	<img alt="img" src="<?php echo e(asset('images/'. $commentaire->photo )); ?>" class="direct-chat-img" style="width:45px;height: 45px;"/>
									  	<?php else: ?>
										<img alt="img" src="<?php echo e(asset('images/avatar.jpg')); ?>" class="direct-chat-img" style="width:45px;height: 45px;"/>
										<?php endif; ?>
								      </a>
								      <div class="comment-body">
								        <div class="text">
								          <p><?php echo e($commentaire->commentaire_message); ?></p>
								        </div>
								        <p class="attribution">Par <a href="<?php echo e(route('DetailsUtilisateur',$commentaire->id)); ?>"><?php echo e($commentaire->civilite .' '. $commentaire->nom . ' ' . $commentaire->prenoms); ?></a> le <?php echo e(Stdfn::dateTimeFromDB($commentaire->commentaire_date_creation)); ?></p>
								      </div>
								    </article>

								    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								  </section>

								
							</div>
							
						</div>

						<br style="clear:both;"/>
					
					</div>
					<?php endif; ?>
					<!-- //bloc des commentaires -->

					
					<!--div class="line line-lg pull-in"></div>
					
					<div class="actions pull-right"> 
						<span id="btnTraiterCourier" data-courrier_id="<?php echo e($courrier->courrier_id); ?>" class="btn btn-sm btn-info rounded">TRAITER LE COURRIER</span> 
					</div-->
					
					<div class="line line-lg pull-in"></div>
					
					<div class="panel panel-default" style="padding-bottom:10px;"> 
												
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
								
								var img_preview_src = (response.courrier_fichier_extension=="jpg" || response.courrier_fichier_extension=="jpeg" || response.courrier_fichier_extension=="png" || response.courrier_fichier_extension=="gif" )? 'data:'+response.courrier_fichier_mimetype+';base64,'+response.courrier_fichier_contenu : '<?php echo e(asset("images/icon-article.png")); ?>';
								
								$('#table_fichiers_traitement').append('<a target="_blank" href="<?php echo e(route("ShowPieceJointe","")); ?>/'+response.courrier_fichier_id+' " title="'+response.courrier_fichier_nom_original+'" class="apercu_fichier"><img src="'+img_preview_src+'" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/></a>');
								
								
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

										
						<div class="col-sm-12" style="padding:0px;"> 
							<section class="panel panel-default"> 
								<header class="panel-heading bg-info lt no-border title"> 
									<div class="clearfix"> 
										<div class="clear"> 
										<div class="h3 m-t-xs m-b-xs text-white">
										<small style="color:white;">Fichiers de traitement</small>
										<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
										</div>  
										</div> 
									</div> 
								</header> 
							</section>
						</div>

						<div class="row col-lg-12"> 
							
							<div class="col-sm-12"> 

								<div class="col-md-5" style="border-right:1px dotted #eee;">
									<form method="post" action="<?php echo e(route('UpdateFichiersTraitementCourrier',[$courrier->courrier_id,$imputation_courrier->imputation_courrier_id])); ?>" enctype="multipart/form-data" class="dropzone" id="dropzone">
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
									<!--table id="table_justifs" class="table table-responsive"> 
										<tr> 
											<th>Nom du fichier</th>
											<th>Action</th>
										</tr>
										<?php $__currentLoopData = $imputations_a_moi_assignes['ic_fichiers_traitement'][$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fichier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr> 
											<th><img src="base64;<?php echo e($fichier->courrier_fichier_contenu); ?>"/></th>
											<th><?php echo e($fichier->courrier_fichier_nom); ?></th>
											<th>Action</th>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</table--> 
									<?php $__currentLoopData = $imputations_a_moi_assignes['ic_fichiers_traitement'][$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fichier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a target="_blank" href="<?php echo e(route('ShowPieceJointe',$fichier->courrier_fichier_id)); ?>" title="<?php echo e($fichier->courrier_fichier_nom_original); ?>" class="apercu_fichier">
										<?php if(in_array($fichier->courrier_fichier_extension,array('jpg','jpeg','png','gif'))): ?>
										<img src="data:image/jpeg;base64,<?php echo e($fichier->courrier_fichier_contenu); ?>" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/>
										<?php else: ?>
										<img src="<?php echo e(asset('images/icon-article.png')); ?>" style="border:1px solid #717171;margin:2px;width:100px;height:auto;" title="<?php echo e($fichier->courrier_fichier_nom_original); ?>"/>
										<?php endif; ?>
									</a>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								
							</div>
							
						</div>

						<br style="clear:both;"/>
					
					</div>
					
					
					
				</div> 
				
			 
		
		</div>
		
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	<!-- fin de liste imputation adressé à l'utilisateur connecté -->

<?php endif; ?>
<!-- fin de si le courrier a le statut imputé -->

<br style="clear:both;"/>

<!-- si autorise faire une imputation -->
<?php if(Stdfn::SiActionAutorisee('COURRIER_DISPLAY_ALL') || Stdfn::SiActionAutorisee('IMPCOURRIER')): ?>
<div class="col-sm-12" style="padding:0px;"> 

	<!-- si non impute -->
	<?php if(! $my_imputation): ?>
	
		<?php if(Stdfn::SiActionAutorisee('IMPCOURRIER')): ?>
			
		<!-- -->
		<div class="panel panel-default"> 

			<header class="panel-heading bg-warning lt no-border title"> 
				<div class="clearfix"> 
					<div class="clear"> 
					<div class="h3 m-t-xs m-b-xs text-white">
					<small style="color:white">Imputer le courrier à une Direction/Département/Service</small>
					
					<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
					</div>  
					</div> 
				</div> 
			</header>
			
			<div class="wizard-steps clearfix" id="form-wizard"> 
				<!--ul class="steps"> 
					<li data-target="#step3"><span class="badge"></span>Transmettre le courrier à une direction, un département ou un service</li>
				</ul--> 
			</div> 

			<?php if(Session::has('message')): ?>
				<div class="alert alert-success">
				  <?php echo e(Session::get('message')); ?>

				</div>
			<?php endif; ?>

			<?php if(Session::has('warning_erreur_calcul')): ?>
				<div class="alert alert-warning">
				  <?php echo e(Session::get('warning_erreur_calcul')); ?>

				</div>
			<?php endif; ?>


			<div class="step-content clearfix"> 
				<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('SaveOrUpdateImputationCourrier')); ?>">
					
					<?php echo csrf_field(); ?>

					
					<input type="hidden" name="courrier_id" value="<?php echo e($courrier->courrier_id); ?>">
					
					<div class="step-pane active" id="step1"> 
						
						<div class="col-md-12"> 
						
							<div class="col-md-6"> 
									
								<div class="form-group<?php echo e($errors->has('executants') ? ' has-error' : ''); ?>">
									<label for="executants" class="col-md-12 bold">Destinataires *</label>

									<div class="col-md-12">
										<ul class="no_liste_item">
										<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $checked = in_array($service->service_id, $tab_ids_executants_of_courrier)? ' checked ' : ''; ?>
											<li><input type="checkbox" <?php echo e($checked); ?> name="executants[]" value="<?php echo e($service->service_id); ?>"/> <?php echo e($service->service_nom); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>	
									</div>
									
								</div>
								
							</div>
							
							<div class="col-md-6"> 
									
								<div class="form-group<?php echo e($errors->has('objectifs') ? ' has-error' : ''); ?>">
									<label for="objectifs" class="col-md-12 bold">Recommandations *</label>

									<div class="col-md-12">
										<ul class="no_liste_item">
										<?php $__currentLoopData = $objectifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objectif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $checked = in_array($objectif->objectif_imputation_id, $tab_ids_objectifs_of_courrier)? ' checked ' : ''; ?>
											<li><input type="checkbox" <?php echo e($checked); ?> name="objectifs[]" value="<?php echo e($objectif->objectif_imputation_id); ?>"/> <?php echo e($objectif->objectif_imputation_libelle); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>	
									</div>
									
								</div>

							</div>
							
						</div>
						
						
						
						<div class="col-md-12">

							<div class="form-group<?php echo e($errors->has('priorite') ? ' has-error' : ''); ?>">
								<label for="priorite" class="col-md-4 bold">Signalisation *</label>
								
								<div class="col-md-8">
									<ul class="no_liste_item">
										<?php $__currentLoopData = $priorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php $checked = ($imputation_courrier_priorite_id == $priorite->priorite_id)? ' checked ' : ''; ?>
										<li><input type="radio" name="priorite_id" value="<?php echo e($priorite->priorite_id); ?>" <?php echo e($checked); ?> /> <?php echo e($priorite->priorite_libelle); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>	
								</div>
								
							</div>

						</div>
						
						<div class="col-md-12"> 
								
							<div class="form-group<?php echo e($errors->has('observations') ? ' has-error' : ''); ?>">
								<label for="observations" class="col-md-12 bold">Observations</label>

								<div class="col-md-12">
									<textarea autocomplete="off" class="form-control" name="observations"></textarea>

									<?php if($errors->has('observations')): ?>
										<span class="help-block">
											<strong><?php echo e($errors->first('observations')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

						</div>
						
					
					</div> 
					
					
					<div class="line line-lg pull-in"></div>
					
					<div class="actions pull-right"> 
						<!--button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button--> 

						
						<button type="submit" class="btn btn-success btn-sm">VALIDER L'IMPUTATION</button> 
						
					</div>
					
				</form>
				
				 
			
			</div>
			
			
			
			
			
		</div>
		<?php endif; ?> <!-- fin de si autorise faire imputation -->

		 <!-- si autorise faire proposition d'imputation -->
		<?php if(Stdfn::SiActionAutorisee('PROPOSER_IMPCOURRIER')): ?>
			
		<!-- -->
		<div class="panel panel-default"> 

			<header class="panel-heading bg-warning lt no-border title"> 
				<div class="clearfix"> 
					<div class="clear"> 
					<div class="h3 m-t-xs m-b-xs text-white">
					<small style="color:white">Proposition d'imputation du courrier</small>
					
					<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
					</div>  
					</div> 
				</div> 
			</header>
			
			<div class="wizard-steps clearfix" id="form-wizard"> 
				<!--ul class="steps"> 
					<li data-target="#step3"><span class="badge"></span>Transmettre le courrier à une direction, un département ou un service</li>
				</ul--> 
			</div> 

			<?php if(Session::has('message')): ?>
				<div class="alert alert-success">
				  <?php echo e(Session::get('message')); ?>

				</div>
			<?php endif; ?>

			<?php if(Session::has('warning_erreur_calcul')): ?>
				<div class="alert alert-warning">
				  <?php echo e(Session::get('warning_erreur_calcul')); ?>

				</div>
			<?php endif; ?>


			<div class="step-content clearfix"> 
				<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('SaveOrUpdateImputationCourrier')); ?>">
					
					<?php echo csrf_field(); ?>

					
					<input type="hidden" name="courrier_id" value="<?php echo e($courrier->courrier_id); ?>">
					
					<div class="step-pane active" id="step1"> 
						
						<div class="col-md-12"> 
						
							<div class="col-md-6"> 
									
								<div class="form-group<?php echo e($errors->has('executants') ? ' has-error' : ''); ?>">
									<label for="executants" class="col-md-12 bold">Destinataires *</label>

									<div class="col-md-12">
										<ul class="no_liste_item">
										<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $checked = in_array($service->service_id, $tab_ids_executants_of_courrier)? ' checked ' : ''; ?>
											<li><input type="checkbox" <?php echo e($checked); ?> name="executants[]" value="<?php echo e($service->service_id); ?>"/> <?php echo e($service->service_nom); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>	
									</div>
									
								</div>
								
							</div>
							
							<div class="col-md-6"> 
									
								<div class="form-group<?php echo e($errors->has('objectifs') ? ' has-error' : ''); ?>">
									<label for="objectifs" class="col-md-12 bold">Recommandations *</label>

									<div class="col-md-12">
										<ul class="no_liste_item">
										<?php $__currentLoopData = $objectifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objectif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php $checked = in_array($objectif->objectif_imputation_id, $tab_ids_objectifs_of_courrier)? ' checked ' : ''; ?>
											<li><input type="checkbox" <?php echo e($checked); ?> name="objectifs[]" value="<?php echo e($objectif->objectif_imputation_id); ?>"/> <?php echo e($objectif->objectif_imputation_libelle); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>	
									</div>
									
								</div>

							</div>
							
						</div>
						
						
						
						<div class="col-md-12">

							<div class="form-group<?php echo e($errors->has('priorite') ? ' has-error' : ''); ?>">
								<label for="priorite" class="col-md-4 bold">Signalisation *</label>
								
								<div class="col-md-8">
									<ul class="no_liste_item">
										<?php $__currentLoopData = $priorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php $checked = ($imputation_courrier_priorite_id == $priorite->priorite_id)? ' checked ' : ''; ?>
										<li><input type="radio" name="priorite_id" value="<?php echo e($priorite->priorite_id); ?>" <?php echo e($checked); ?> /> <?php echo e($priorite->priorite_libelle); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>	
								</div>
								
							</div>

						</div>
						
						<!--div class="col-md-12"> 
								
							<div class="form-group<?php echo e($errors->has('observations') ? ' has-error' : ''); ?>">
								<label for="observations" class="col-md-12 bold">Observations</label>

								<div class="col-md-12">
									<textarea autocomplete="off" class="form-control" name="observations"></textarea>

									<?php if($errors->has('observations')): ?>
										<span class="help-block">
											<strong><?php echo e($errors->first('observations')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

						</div-->
						
					
					</div> 
					
					
					<div class="line line-lg pull-in"></div>
					
					<div class="actions pull-right"> 
						<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
					</div>
					
				</form>
				
				 
			
			</div>
			
			
			
			
			
		</div>
	<?php endif; ?> <!-- fin de si autorise faire proposition d'imputation -->


	<!-- -->
	
	<?php else: ?>
	
	<?php if(!empty($imputation_courrier) && ($courrier->courrier_statut_imputation == "IMPUTE")): ?>
	<!-- -->
	<div class="panel panel-default"> 
		<header class="panel-heading bg-success lt no-border title"> 
			<div class="clearfix"> 
				<div class="clear"> 
				<div class="h3 m-t-xs m-b-xs text-white">
				<small style="color:white"><!--VOUS AVEZ IMPUTÉ CE COURRIER |--> DETAILS DE L'IMPUTATION</small>
				<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
				</div>  
				</div> 
			</div> 
		</header>
		
		<div class="wizard-steps clearfix" id="form-wizard"> 
			<!--ul class="steps"> 
				<li data-target="#step3"><span class="badge"></span>Transmettre le courrier à une direction, un département ou un service</li>
			</ul--> 
		</div> 

		<?php if(Session::has('message')): ?>
			<div class="alert alert-success">
			  <?php echo e(Session::get('message')); ?>

			</div>
		<?php endif; ?>

		<?php if(Session::has('warning_erreur_calcul')): ?>
			<div class="alert alert-warning">
			  <?php echo e(Session::get('warning_erreur_calcul')); ?>

			</div>
		<?php endif; ?>


		<div class="step-content clearfix"> 
			
				<?php echo csrf_field(); ?>

				
				<input type="hidden" name="courrier_id" value="<?php echo e($courrier->courrier_id); ?>">
				
				<div class="step-pane active" id="step1"> 
					
					<div class="col-md-12"> 
					
						<div class="col-md-6 row"> 
								
							<div class="form-group<?php echo e($errors->has('executants') ? ' has-error' : ''); ?>">
								<label for="executants" class="col-md-12 bold"><u>Destinataires : </u></label>

								<div class="col-md-12">
									<ul class="no_liste_item">
									<?php $__currentLoopData = $executants_of_courrier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><i class="fa fa-check-square-o" style="color:green;"></i> <?php echo e($service->service_nom); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>	
								</div>
								
							</div>
							
						</div>
						
						<div class="col-md-6"> 
								
							<div class="form-group<?php echo e($errors->has('objectifs') ? ' has-error' : ''); ?>">
								<label for="objectifs" class="col-md-12 bold"><u>Recommandations : </u></label>

								<div class="col-md-12">
									<ul class="no_liste_item">
									<?php $__currentLoopData = $objectifs_of_courrier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objectif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><i class="fa fa-check-square-o" style="color:green;"></i> <?php echo e($objectif->objectif_imputation_libelle); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>	
								</div>
								
							</div>

						</div>
						
					</div>
					
					
					
					<div class="col-md-12">

						<div class="form-group<?php echo e($errors->has('priorite') ? ' has-error' : ''); ?>">
							<label for="priorite" class="col-md-4 bold"><u>Signalisation: </u></label>
							
							<div class="col-md-8">
								<div><?php if($imputation_courrier->priorite_id==1): ?><i class="fa fa-exclamation-triangle" style="color:red;"></i><?php endif; ?> <?php echo e($imputation_courrier->priorite_libelle); ?></div>
							</div>
							
						</div>

					</div>
					
					<div class="col-md-12"> 
							
						<div class="form-group<?php echo e($errors->has('observations') ? ' has-error' : ''); ?>">
							<label for="observations" class="col-md-12 bold"><u>Observations : </u></label>

							<div class="col-md-12">
								<div><?php echo e($imputation_courrier->imputation_courrier_observations); ?></div>
							</div>
						</div>

					</div>
					
				
				</div> 
				
			 		<?php if(Stdfn::SiActionAutorisee('COURRIER_SEE_CHAT_ON_DETAILS_IMP')): ?>
					<div class="line line-lg pull-in"></div>
					
					<div class="panel panel-default" style="padding-bottom:10px;"> 
										
						<div class="col-sm-12" style="padding:0px;"> 
							<section class="panel panel-default"> 
								<header class="panel-heading bg-info lt no-border title"> 
									<div class="clearfix"> 
										<div class="clear"> 
										<div class="h3 m-t-xs m-b-xs text-white">
										<small style="color:white;"><i class="fa  fa-comments"></i> COMMENTAIRES</small>
										<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
										</div>  
										</div> 
									</div> 
								</header> 
							</section>
						</div>

						<div class="row col-lg-12" style="padding: 0px;margin: 0px;"> 
							
							<div class="col-md-12">
								<form method="post" action="<?php echo e(route('SaveCommentaire')); ?>">
									<?php echo csrf_field(); ?>

									<input type="hidden" name="courrier_id" id="courrier_id" value="<?php echo e($courrier->courrier_id); ?>"/>
									<div class="col-md-12" style="margin:0px;padding: 0px;">
										<textarea id="" placeholder="Ecrire un message..." rows="5" name="message" required style="width: 100%;"></textarea>
									</div>	
									<div class="col-md-12 pull-right text-right" style="margin:0px;padding: 0px;">	
										<button class="button btn btn-success btn-footer" type="submit"><i class="fa  fa-send-o"></i> Envoyer</button>
									</div>
								</form>
							</div> 

							<div class="col-md-12 panel panel-default" id="comments_box"> 

								<section class="comments">

									<?php $__currentLoopData = $commentaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								    <article class="comment">
								      <a class="comment-img" href="<?php echo e(route('DetailsUtilisateur',$commentaire->id)); ?>" title="<?php echo e($commentaire->civilite .' '. $commentaire->nom . ' ' . $commentaire->prenoms); ?>">
								        <?php if(File::exists('images/'. $commentaire->photo ) && !is_dir('images/'. $commentaire->photo) ): ?>
									  	<img alt="img" src="<?php echo e(asset('images/'. $commentaire->photo )); ?>" class="direct-chat-img" style="width:45px;height: 45px;"/>
									  	<?php else: ?>
										<img alt="img" src="<?php echo e(asset('images/avatar.jpg')); ?>" class="direct-chat-img" style="width:45px;height: 45px;"/>
										<?php endif; ?>
								      </a>
								      <div class="comment-body">
								        <div class="text">
								          <p><?php echo e($commentaire->commentaire_message); ?></p>
								        </div>
								        <p class="attribution">Par <a href="<?php echo e(route('DetailsUtilisateur',$commentaire->id)); ?>"><?php echo e($commentaire->civilite .' '. $commentaire->nom . ' ' . $commentaire->prenoms); ?></a> le <?php echo e(Stdfn::dateTimeFromDB($commentaire->commentaire_date_creation)); ?></p>
								      </div>
								    </article>

								    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								  </section>

								
							</div>
							
						</div>

						<br style="clear:both;"/>
					
					</div>
					<?php endif; ?>

					<?php if(Stdfn::SiActionAutorisee('COURRIER_DISPLAY_FICHIERS_TRAITEMENT')): ?>
					<div class="line line-lg pull-in"></div>
					
					<div class="panel panel-default" style="padding-bottom:10px;"> 
										
						<div class="col-sm-12" style="padding:0px;"> 
							<section class="panel panel-default"> 
								<header class="panel-heading bg-info lt no-border title"> 
									<div class="clearfix"> 
										<div class="clear"> 
										<div class="h3 m-t-xs m-b-xs text-white">
										<small style="color:white;">Fichiers issus du traitement</small>
										<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
										</div>  
										</div> 
									</div> 
								</header> 
							</section>
						</div>

						<div class="row col-lg-12"> 
							
							<div class="col-sm-12"> 

								<div class="col-md-7" id="table_fichiers_traitement">
									
									<?php $__currentLoopData = $imputation_courrier_fichiers_traitement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fichier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a target="_blank" href="<?php echo e(route('ShowPieceJointe',$fichier->courrier_fichier_id)); ?>" title="<?php echo e($fichier->courrier_fichier_nom_original); ?>" class="apercu_fichier">
										<?php if(in_array($fichier->courrier_fichier_extension,array('jpg','jpeg','png','gif'))): ?>
										<img src="data:image/jpeg;base64,<?php echo e($fichier->courrier_fichier_contenu); ?>" style="border:1px solid #717171;margin:2px;width:100px;height:auto;"/>
										<?php else: ?>
										<img src="<?php echo e(asset('images/icon-article.png')); ?>" style="border:1px solid #717171;margin:2px;width:100px;height:auto;" title="<?php echo e($fichier->courrier_fichier_nom_original); ?>"/>
										<?php endif; ?>
									</a>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								
							</div>
							
						</div>

						<br style="clear:both;"/>
					
					</div>
					<?php endif; ?>
					

		</div>
		
		
		
		
		
	</div>
	<?php endif; ?>
	
	
	<?php endif; ?>
	<!-- // fin si imputation non effectuee -->
	</div>
	<?php endif; ?>	
	<!-- // fin si autorise faire imputation -->

	
	

	<!-- //échanges (commentaires) relatifs au courrier -->
	<div class="" id="commentaires_of_courrier"> 

		<!--header class="panel-heading bg-success lt no-border title"> 
			<div class="clearfix"> 
				<div class="clear"> 
				<div class="h3 m-t-xs m-b-xs text-white">
				<small style="color:white">Echanges relatifs au courrier</small>
				<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
				</div>  
				</div> 
			</div> 
		</header-->
		
		<div class="step-content clearfix"> 


		<!--div class="popup-box chat-popup popup-box-on" id="qnimate" style="display: none;">

			<div id="chatbox_removable">
			  	<div class="popup-head">
					<div class="popup-head-left">
						<div class="row">
							<div class="col-md-10"> 
								Chat - Courrier N° <?php echo e(Stdfn::truncateN($courrier->courrier_numero,5)); ?>

							</div>
						  	<div class="col-md-2 pull-right" style="border:1px solid red:">
								<button data-widget="remove" id="btnCloseChatBox" class="chat-header-button pull-right" type="button" style="border:1px solid red"><i class="fa fa-times text-danger"></i></button>
			            	</div>
			            </div>

					</div>
			  	</div>

				<div class="popup-messages">
	    		
					<div class="direct-chat-messages" id="chat_messages_list">
	                    
	                    <?php $__currentLoopData = $commentaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <div class="direct-chat-msg doted-border">

	                      <div class="direct-chat-info clearfix">
	                        <span class="direct-chat-name pull-left"><?php echo e($commentaire->email); ?></span>
	                      </div>
	                      
	                      <img alt="img" src="<?php echo e(asset('images/'. $commentaire->photo )); ?>" class="direct-chat-img">
	                      
	                      <div class="direct-chat-text">
	                       	<?php echo e($commentaire->commentaire_message); ?>

	                      </div>
						  <div class="direct-chat-info clearfix">
	                        <span class="direct-chat-timestamp pull-right"><?php echo e(Stdfn::dateTimeFromDB($commentaire->commentaire_date_creation)); ?></span>
	                      </div>

	                    </div>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
	                  </div>
				
				</div>
			</div>

			<div class="popup-messages-footer">
				<div class="box_edit_message">
					<textarea id="status_message" placeholder="Ecrire un message..." rows="20" cols="40" name="message" required></textarea>
					
					<button class="button btn btn-success btn-footer" type='button' id="btnSendCommentaire" style="display: none;"><i class="fa  fa-send-o"></i> Envoyer</button>
					<input type="hidden" id="courrier_id" value="<?php echo e($courrier->courrier_id); ?>">
				</div>
				<div class="btn-footer" id="btnOpenChatBox">
					<button class="bg_none">Chat - Courrier N° <?php echo e(Stdfn::truncateN($courrier->courrier_numero,5)); ?> </button>
					<button class="bg_none"><i class="fa fa-film"></i> </button>
		            <button class="bg_none" title="Joindre des images"><i class="fa fa-picture-o"></i> </button>
		            <button class="bg_none" title="Joindre des fichiers"><i class="fa fa-paperclip"></i> </button>
					<button class="bg_none pull-right"><i class="fa fa-comments"></i> </button>
				</div>
			</div>

	  	</div-->


		<!--script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	  	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/chat.css')); ?>"/>
	  	<script type="text/javascript">
			$(function(){

				$("#btnOpenChatBox").click(function () {

			        $( "#qnimate" ).animate({height: "415px"}, 100 );


			        $('.box_edit_message').show();


			    });
			          
	            $("#btnCloseChatBox").click(function () {

	            	$( "#qnimate" ).animate({height: "50px"}, 100 );

	          		$('.box_edit_message').hide();

	            });



			});
		</script-->

		</div>

	</div>

	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/comments.css')); ?>"/>

<?php else: ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courrierHome')); ?>"> CourrierAPP</a></li> 
	<li><a href="<?php echo e(route('courriers')); ?>">Courriers</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Courrier introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		Le courrier que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>