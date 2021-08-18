<div class="panel panel-default"> 

	<div class="step-content clearfix"> 
		
		<?php echo html_entity_decode(utf8_decode($memo->memo_contenu)) ?>
		
	</div> 

	<div class="panel wrapper panel-info">
		<div class="text-center bg-info">Signature</div>
		<div class="text-center">
			<?php if(!empty($memo->signature)): ?>
			<img class="" src="data:image/jpeg;base64,<?php echo e(Stdfn::KHLOE_DECRYPT($memo->signature)); ?>" style="width:120px;"/>
			<?php endif; ?>
		</div>
	</div> 
		
</div>
