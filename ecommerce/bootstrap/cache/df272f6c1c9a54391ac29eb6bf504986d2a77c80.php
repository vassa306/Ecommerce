<div class="row expanded column">


	<?php if(isset($errors)): ?>
	<div class="callout alert" data-closable>
		<?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $__currentLoopData = $error_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($error_item); ?> </br> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<button class="close-button" aria-label="Dismiss Message"
			type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php endif; ?> <?php if(isset($success)|| \app\classes\Session::has('success')): ?>
	<div class="callout success" data-closable>
		<?php if(isset($success)): ?> <?php echo e($success); ?>

		<?php elseif(\app\classes\Session::has('success')): ?> <?php echo e(\app\classes\Session::flash('success')); ?> <?php endif; ?>
		<button class="close-button" aria-label="Dismiss Message"
			type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php endif; ?><?php /**PATH C:\xampp\htdocs\ecommerce\resources\views/includes/message.blade.php ENDPATH**/ ?>