<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('courrierHome')); ?>"> Courrier APP</a></li>   
	<li><a href="<?php echo e(route('memos')); ?>"> Mémos</a></li> 
	<li class="active">Nouveau mémo</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Nouveau mémo</h3> 
</div>

<?php if(Session::has('message')): ?>
	<div class="alert alert-success">
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Rédaction d'un mémo</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('SaveMemo')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group<?php echo e($errors->has('memo_objet') ? ' has-error' : ''); ?>">
					<label for="memo_objet" class="col-md-12">Objet</label>

					<div class="col-md-12">
						<input id="memo_objet" type="text" class="form-control" name="memo_objet" value="<?php echo e(old('memo_objet')); ?>" required autofocus>

						<?php if($errors->has('memo_objet')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('memo_objet')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('memo_contenu') ? ' has-error' : ''); ?>">
					<label for="memo_contenu" class="col-md-12">Corps du mémo</label>
					
					<div class="col-md-12">
						<textarea id="memo_contenu" class="summernote form-control" name="memo_contenu" required style="height:500px;"></textarea>

						<?php if($errors->has('memo_contenu')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('memo_contenu')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
			</div> 
			
			
			<div class="line line-lg pull-in"></div>
			
			<div class="actions pull-right"> 
				<button type="reset" class="btn btn-danger btn-sm">Annuler</button> 
				<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
			</div>
			
		</form>
		
	</div>
	
	<!-- Import jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>

	<!-- Import Trumbowyg -->
	<script src="<?php echo e(asset('css/trumbowyg/trumbowyg.min.js')); ?>"></script>
	<!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
	<script src="<?php echo e(asset('css/trumbowyg/plugins/fontfamily/trumbowyg.fontfamily.min.js')); ?>"></script>

	<!-- Import Trumbowyg plugins... -->
	<!--script src="<?php echo e(asset('css/trumbowyg/plugins/upload/trumbowyg.cleanpaste.min.js')); ?>"></script>
	<script src="<?php echo e(asset('css/trumbowyg/plugins/upload/trumbowyg.pasteimage.min.js')); ?>"></script-->
	
	<link rel="stylesheet" href="<?php echo e(asset('css/trumbowyg/ui/trumbowyg.min.css')); ?>">

	<!-- Init Trumbowyg -->
	<script>
		// Doing this in a loaded JS file is better, I put this here for simplicity
		
		$('#memo_contenu').trumbowyg({
			lang: 'fr',
			btns: [
				['viewHTML'],
				['undo', 'redo'], // Only supported in Blink browsers
				['fontfamily'],
				// ['formatting'],
				['strong', 'em', 'del'],
				['superscript', 'subscript'],
				['link'],
				// ['insertImage'],
				['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
				['unorderedList', 'orderedList'],
				['horizontalRule'],
				['removeformat'],
				['fullscreen']
			],
			plugins: {
				fontfamily: {
					fontList: [
						{name: 'Arial', family: 'Arial, Helvetica, sans-serif'},
						{name: 'Times New Roman', family: 'Times New Roman'},
						{name: 'Comic Sans', family: '\'Comic Sans MS\', Textile, cursive, sans-serif'},
						{name: 'Open Sans', family: '\'Open Sans\', sans-serif'}
					]
				}
			}
		});
		
		
	</script>

	
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>