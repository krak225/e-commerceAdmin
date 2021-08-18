 <?php $__currentLoopData = $commentaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commentaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Message. Default to the left -->
<div class="direct-chat-msg doted-border">

	  <div class="direct-chat-info clearfix">
	    <span class="direct-chat-name pull-left"><?php echo e($commentaire->email); ?></span>
	  </div>
	  
	  <!-- /.direct-chat-info -->
	  	<?php if(File::exists('images/'. $commentaire->photo ) && !is_dir('images/'. $commentaire->photo) ): ?>
	  	<img alt="img" src="<?php echo e(asset('images/'. $commentaire->photo )); ?>" class="direct-chat-img">
	  	<?php else: ?>
		<img alt="img" src="<?php echo e(asset('images/avatar.jpg')); ?>" class="direct-chat-img">
		<?php endif; ?>


	  <!-- /.direct-chat-img -->
	  <div class="direct-chat-text">
	   	<?php echo e($commentaire->commentaire_message); ?>

	  </div>
	  <div class="direct-chat-info clearfix">
	    <span class="direct-chat-timestamp pull-right"><?php echo e(Stdfn::dateTimeFromDB($commentaire->commentaire_date_creation)); ?></span>
	  </div>

  <!-- /.direct-chat-text -->
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>