
	<div class="col-sm-12" style="padding:0px;margin:-16px 0px -10px 0px;">
		
		<section class="panel panel-default"> 
			<header class="panel-heading">Informations</header> 
			<div class="step-content clearfix" style="padding-bottom:0px;padding-left:0px;"> 
				
				<div class="step-pane active" id="step1"> 
						
					<div class="col-md-12 form-group">
						<div class="table-responsived"> 
							<table class="table_infos" style="width:100%;">
								<tr>
									<th style="width:150px;padding:5px 0px;">Libellé</th>
									<td style="padding:5px;">: <?php echo e($tache->tache_libelle); ?></td>
								</tr>
								<tr>
									<th style="width:150px;padding:5px 0px;">Date début prévu</th>
									<td style="padding:5px;">: <span id="date_debut_preview"><?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?> </span></td>
								</tr>
								<tr>
									<th style="width:150px;padding:5px 0px;">Date fin prévu</th>
									<td style="padding:5px;">: <span id="date_fin_preview"><?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?> </span><span id="btn-prolonger" style="color:orange;margin-left:50px;cursor:pointer;"><i class="fa fa-edit"></i> Prolonger</span></td>
								</tr>
							</table>
						</div>
					</div>
					
				</div> 

			</div> 
			
			
			
			<header id="box_mofification_echeances_header" class="panel-heading lt border title">&nbsp;</header> 
			
			<div id="box_mofification_echeances" class="hidden"> 
			
				<div class="list-group no-radius alt"> 
					
					<div class="step-content clearfix" style="padding-bottom:0px;"> 
						
						<div method="post" class="form-horizontal">
							
							<input type="hidden" id="tache_id" value="<?php echo e($tache->tache_id); ?>"/>
							
							<div class="step-pane active" id="step1"> 
								
								<div class="col-md-12 form-group">
									<div class="table-responsived"> 
										<table style="width:100%;">
											<tr>
												<td style="width:20%;padding-left:5px;">Nouvelle date début</td>
												<td style="width:20%;padding-left:5px;">Nouvelle date fin</td>
												<td style="width:50%;padding-left:5px;">Commentaire</td>
												<td style="width:10%;padding-left:5px;"></td>
											</tr>
											<tr>
												<td style="padding:5px;vertical-align:top;">
													<input style="padding-top:0px;padding-bottom:0px;" type="date" id="new_date_debut" class="form-control" value="<?php echo e(Stdfn::dateFromDB($tache->tache_date_debut_prevu)); ?>" />
												</td>
												<td style="padding:5px;vertical-align:top;">
													<input style="padding-top:0px;padding-bottom:0px;" type="date" id="new_date_fin" class="form-control" value="<?php echo e(Stdfn::dateFromDB($tache->tache_date_fin_prevu)); ?>" />
												</td>
												<td style="padding:5px;vertical-align:top;">
													<textarea style="padding-top:0px;padding-bottom:0px;" id="motif_modification_echeance" class="form-control" required></textarea>
												</td>
												<td style="padding:5px;vertical-align:top;">
													<button id="btnSaveNewDates" class="btn btn-success btn-sm">Mettre à jour</button> 
												</td>
											</tr>
										</table>
									</div>
								</div>
								
								
							</div> 
							
							
						</div>
						
					</div>
					
				</div> 
				
			</div> 
			
			
		</section>
		
		
		<section class="panel panel-default"> 
			<header class="panel-heading lt border title">Utilisateurs affectés à cette tâche</header> 
			
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
													<button id="btnSaveUser" class="btn btn-success btn-sm">Ajouter</button> 
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
								<th width="70%">Nom & Prénoms</th> 
								<th width="30%">Rôle</th> 
								<th width="" style="display:none;">N°</th> 
							</tr> 
						</thead> 
						<tbody id="liste_utilisateurs_affectes">
						<?php $__currentLoopData = $users_affectes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($user->nom . ' ' . $user->prenoms); ?></td>
								<td><?php echo e($user->role_libelle); ?></td>
								<td style="display:none;"><?php echo e($user->user_tache_id); ?></td>
							</tr>	
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody> 
					</table> 
				</div> 
			</div> 
			
			
		</section>
		
	</div>
	<br style="clear:both;"/>
	