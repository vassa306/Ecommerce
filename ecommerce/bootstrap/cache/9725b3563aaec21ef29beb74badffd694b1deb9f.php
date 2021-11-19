 
<?php $__env->startSection('title','Create Product'); ?>
<?php $__env->startSection('data-page-id','adminProducts'); ?> 

<!-- at first use isset - test if variable exists in page -->
<?php $__env->startSection('content'); ?>
	<div class="add-product">
		<div class="row expanded">
		   <div class="column medium-11">
				<h2>Add Inventory Item</h2>
			</div>
		</div>

		<?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<form method="post" action="/admin/products/create">
			<div class ="small-12 medium-11">
				<div class="row expanded">
					<div class="small-12 medium-6 column">
					  	<label>Product Name:
					  		<input type="text" name="name" placeholder="Product Name" 
					  		value="<?php echo e(\app\classes\Request::old('post','name')); ?>">
					  	</label>
					</div>
			
									
			
					<div class="small-12 medium-6 column">
					  	<label>Product Price:
					  		<input type="text" name="price" placeholder="Product Price" 
					  		value="<?php echo e(\app\classes\Request::old('post','price')); ?>">
					  	</label>
					</div>
				</div>
			</div>
			
			<div class ="small-12 medium-11">
				<div class="row expanded">
					<div class="small-12 medium-6 column">
					  	<label>Product Category:
					  		<select name = "category" id="product-category">
					  			<option value="<?php echo e(\app\classes\Request::old('post','category')?:""); ?>">
					  			 	<?php echo e(\app\classes\Request::old('post','category')?:"Select Category"); ?>

					  			</option>
					  			 <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  			 	<option value="<?php echo e($category->id); ?>"> <?php echo e($category->name); ?></option>
					  			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					  		</select>
					  	</label>
					</div>
			
					<div class="small-12 medium-6 column">
					  	<label>Product SubCategory:
					  		<input type="text" name="price" placeholder="Product Subcategory" 
					  		value="<?php echo e(\app\classes\Request::old('post','price')); ?>">
					  	</label>
					</div>
				</div>
			</div>			
			
		</form>

	<?php echo $__env->make('includes.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\developer2\eshop\gitrepo\ecommerce\resources\views/admin/products/create.blade.php ENDPATH**/ ?>