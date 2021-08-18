<?php $__env->startSection('content'); ?>

			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
			<li class=""><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>			
			<li class="active">Perception</li>
			</ul> 
			<div class="m-b-md"> 
			<h3 class="m-b-none">TABLEAU DE BORD</h3>
			</div> 
			<section class="panel panel-default"> 
				<div class="row m-l-none m-r-none bg-light lter"> 
				<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-home fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="<?php echo e(route('bureaux')); ?>"> 
					<span class="h3 block m-t-xs">
					<strong id="bugs"><?php echo e($nombre_bureaux); ?></strong>
					</span> 
					<small class="text-muted text-uc">BUREAUX</small> 
					</a> 
				</div> 
				<div class="col-sm-8 col-md-4 padder-v b-r b-light lt"> 
				<span class="fa-stack fa-2x pull-left m-r-sm"> 
				<i class="fa fa-circle fa-stack-2x text-warning"></i> 
				<i class="fa fa-users fa-stack-1x text-white"></i> 
				<span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#fff" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="2000" data-target="#bugs" data-update="3000"></span> 
				</span> 
				
				<a class="clear" href="<?php echo e(route('utilisateurs')); ?>"> 
					<span class="h3 block m-t-xs"><strong><?php echo e($nombre_users); ?></strong></span> 
					<small class="text-muted text-uc">Utilisateurs</small> 
					</a> 
				</div> 
				<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-success"></i> 
					<i class="fa fa-money fa-stack-1x text-white"></i> 
					<span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update="5000"></span> 
					</span> <a class="clear" href="<?php echo e(route('perceptions')); ?>"> 
					<span class="h3 block m-t-xs">
					<strong><input type="hidden" id="hidden_montant_total" value="<?php echo e(str_replace(' ','',$nombre_perceptions)); ?>"/>
					<span id="montant_total"><?php echo e(number_format($nombre_perceptions, 0, '', ' ')); ?></span> FCFA</strong></span> 
					<small class="text-muted text-uc">ENCAISSÉ AUJOURD'HUI</small> 
					</a> 
				</div> 
				</div> 
			</section>

			<div class="row"> 
			
				<div class="col-md-6"> 
					
					<section class="panel panel-default"> 
						<header class="panel-heading font-bold"> Etat journalier des perceptions par bureau - <?php echo e(date('d-m-Y')); ?><i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
						</header> 
						<div class="panel-body"> 
							<div class="table-responsive"> 
								<table class="table table-striped m-b-none datatable0" id="statistiques"> 
									<thead> 
										<tr> 
											<th width="5%"></th> 
											<th width="45%">Bureau</th> 
											<th width="40%">Montant</th>
										</tr> 
									</thead> 
									<tbody>
									<?php $__currentLoopData = $statistiques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statistique): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><a href="<?php echo e(route('etatjournalier',$statistique->bureau_id)); ?>"><i class="fa fa-info-circle text-info" title="Afficher les détails"></i></a></td> 
											<td><?php echo e($statistique->bureau_libelle); ?></td> 
											<td style="text-align:right;"><strong id="bureau_<?php echo e($statistique->bureau_id); ?>"><?php if($statistique->montant_total_perception>0): ?> <?php echo e(number_format($statistique->montant_total_perception, 0, '', ' ')); ?> <?php else: ?> 0 <?php endif; ?></strong></td>
										</tr>	
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody> 
								</table> 
							</div>  
						</div> 
						<footer class="panel-footer bg-white no-padder"> 
							<div class="row text-center no-gutter">
							
								
							</div> 
						</footer> 
					</section>

					
				</div> 
			
				<div class="col-md-6"> 
				
					<section class="panel panel-default"> 
						<header class="panel-heading font-bold">
							<i class="fa fa-clock-o"></i>  DONNÉES EN TEMPS RÉEL
						</header> 
						<div class="panel-body"> 
							<div class="table-responsive" style="height:570px;overflow-x:hidden;overflow-y:auto;"> 
								<table class="table table-striped m-b-none datatable0" id="live_data"> 
									<thead> 
										<tr>  
											<th width="5%" style="display:none;">ID</th>
											<th width="20%">Percepteur</th>
											<th width="20%">Montant</th>
											<th width="40%">Date/heure</th>
										</tr> 
									</thead> 
									<tbody id="tbody">
									<?php $__currentLoopData = $perceptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perception): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td style="display:none;"><?php echo e($perception->perception_id); ?></td>
										<td><?php echo e($perception->email); ?></td>
										<td style="text-align:right"><?php echo e(number_format($perception->perception_montant, 0, '', ' ')); ?></td>
										<td><?php echo e($perception->perception_date); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody> 
								</table> 
							</div> 
						</div> 
						<footer class="panel-footer bg-white no-padder"> 
														
							<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.7.min.js"></script>
							<script>
							
							</script>
						</footer> 
					</section> 
					
				</div> 
				
			</div>

			<!--audio controls id="music">
			<source src="http://perception.buridaci.com/public/eventually.ogg" type="audio/mpeg">
			Your browser does not support the audio element.
			</audio>

			<script>
			var myMusic= document.getElementById("music");
			function play() {
			myMusic.play();
			}

			function pause() {
			myMusic.pause();
			}
			</script-->
			
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>