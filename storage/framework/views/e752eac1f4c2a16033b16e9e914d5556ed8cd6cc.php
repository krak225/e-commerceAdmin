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
