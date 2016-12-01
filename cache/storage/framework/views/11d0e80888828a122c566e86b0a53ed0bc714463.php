<?php $__env->startSection('content'); ?>
	<div class="header">
		<div class="content">
			<p><?php echo $dd['content']; ?></p>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('common.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>