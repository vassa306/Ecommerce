 <?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard">
	<div class="row expanded">
		<h2>Dashboard</h2>
		<?php echo e($admin); ?> <br>
		<!--      <?php echo \app\classes\CSRFToken::_token(); ?>

		<?php echo \app\classes\Session::get('token'); ?>

		<?php echo e($_SERVER['REQUEST_URI']); ?> -->
		<form action="/admin" method="post" enctype="multipart/form-data">
			<input name="product" value="testing"> <input type="file"
				name="image"> <input type="submit" value="go" name="submit">
		</form>
	   <!-- \app\classes\Request::all()-->  
		</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\developer2\eshop\gitrepo\ecommerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>