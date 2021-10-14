use  <?php $__env->startSection('title','Product Categories'); ?>
<?php $__env->startSection('data-page-id','adminCategories'); ?> <?php $__env->startSection('content'); ?>
<div class="category">
	<div class="row expanded column">
		<h2>Categories</h2>
	</div>
	<?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- at first use isset - test if variable exists in page -->

	<div class="category">
		<div class="row expanded column">
			<h2>Product Categories</h2>
			
		</div>

		<?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="row expanded">
			<div class="small-12 medium-6 column">
				<form action="" method="post">
					<div class="input-group">
						<input type="text" class="input-group-field"
							placeholder="Search by name">
						<div class="input-group-button">
							<input type="submit" class="button" value="Search">
						</div>
					</div>
				</form>
			</div>

			<div class="small-12 medium-5 end column">
				<form action="/admin/products/categories" method="post">
					<div class="input-group">
						<input type="text" class="input-group-field" name="name"
							placeholder="Category Name"> <input type="hidden" name="token"
							value="<?php echo e(\app\classes\CSRFToken::_token()); ?>">
						<div class="input-group-button">
							<input type="submit" class="button" value="Create">
						</div>
					</div>
				</form>
			</div>
		</div>



		<!-- Delete Category -->
		<div class="row expanded">
			<div class="small-12 medium-11 column">
				<?php if(count($categories)): ?>
				<table class="hover unstriped" data-form="deleteForm">
					<tbody>
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($category['name']); ?></td>
							<td><?php echo e($category['slug']); ?></td>
							<td><?php echo e($category['added']); ?></td>
							<td width="100" class="text-right"><span data-tooltip
								aria-haspopup="true" class="has-tip top"
								data-disable-hover="false" tabindex="1" title="Add Sub Category">
									<a data-open="add-subcategory-<?php echo e($category['id']); ?>"><i
										class="fa fa-plus"></i> </a>
							</span> <span data-tooltip aria-haspopup="true"
								class="has-tip top" data-disable-hover="false" tabindex="1"
								title="Edit Category"> <a data-open="item-<?php echo e($category['id']); ?>"><i
										class="fa fa-edit"></i> </a>
							</span> <span> <span style="display: inline-block" data-tooltip
									aria-haspopup="true" class="has-tip top"
									data-disable-hover="false" tabindex="1" title="Delete Category">
										<form method="post"
											action="/admin/products/categories/<?php echo e($category['id']); ?>/delete"
											class="delete-item">
											<input type="hidden" name="token"
												value="<?php echo e(\app\classes\CSRFToken::_token()); ?>">
											<button type="submit">
												<i class="fa fa-times delete"></i>
											</button>
										</form>
								</span> <!-- Edit Category Modal  -->
									<div class="reveal" id="item-<?php echo e($category['id']); ?>" data-reveal
										data-close-on-click="false" data-close-on-esc="false">
										<div class="notification callout primary"></div>
										<h3>Edit Category</h3>
										<form>
											<div class="input-group">
												<label>Category Name <input type="text"
													id="item-name-<?php echo e($category['id']); ?>" name="name"
													value="<?php echo e($category['name']); ?>">
												</label>

												<div>
													<input type="submit" class="button update-category"
														id="submit-item-<?php echo e($category['id']); ?>" name="token"
														data-token="<?php echo e(\app\classes\CSRFToken::_token()); ?>"
														data-category-id="<?php echo e($category['id']); ?>" value="Update">
												</div>
											</div>
										</form>
										<a href="/admin/products/categories" class="close-button"
											aria-label="Close modal" type="button"> <span
											aria-hidden="true">&times;</span>
										</a>

									</div> <!--Add Subcategory-->
									<div class="reveal" id="add-subcategory-<?php echo e($category['id']); ?>"
										data-reveal data-close-on-click="false"
										data-close-on-esc="false">
										<div class="notification callout primary"></div>
										<h3>Add Subcategory</h3>
										<form>
											<div class="input-group">
												<input type="text" id="subcategory-name-<?php echo e($category['id']); ?>">
												<div>
													<input type="submit" class="button add-subcategory"
														id="<?php echo e($category['id']); ?>" name="token"
														data-token="<?php echo e(\app\classes\CSRFToken::_token()); ?>"
														value="Create">
												</div>
											</div>
										</form>
										<a href="/admin/products/categories" class="close-button"
											aria-label="Close modal" type="button"> <span
											aria-hidden="true">&times;</span>
										</a>
									</div></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
				<?php echo $links; ?> <?php else: ?>
				<h3>You have not any category</h3>
				<?php endif; ?>
			</div>
		</div>
	</div>
	




	<div class="subcategory">
		<div class="row expanded column">
			<h2>Sub Categories</h2>

		</div>

		<!-- at first use isset - test if variable exists in page -->

		<div class="row expanded"></div>


		<!-- Delete Category -->
		<div class="row expanded">
			<div class="small-12 medium-11 column">
				<?php if(count($subcategories)): ?>
				<table class="hover" data-form="deleteForm">
					<tbody>
						<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($subcategory['name']); ?></td>
							<td><?php echo e($subcategory['slug']); ?></td>
							<td><?php echo e($subcategory['added']); ?></td>
							<td width="100" class="text-right"><span data-tooltip
								aria-haspopup="true" class="has-tip top"
								data-disable-hover="false" tabindex="1" title="Edit SubCategory">
									<a data-open="item-subcategory-<?php echo e($subcategory['id']); ?>"><i
										class="fa fa-edit"></i> </a>
							</span>  
							<span style="display: inline-block" data-tooltip
									aria-haspopup="true" class="has-tip top"
									data-disable-hover="false" tabindex="1"
									title="Delete SubCategory">
										<form method="post"
											action="/admin/products/subcategories/<?php echo e($subcategory['id']); ?>/delete"
											class="delete-item">
											<input type="hidden" name="token"
												value="<?php echo e(\app\classes\CSRFToken::_token()); ?>">
											<button type="submit">
												<i class="fa fa-times delete"></i>
											</button>
										</form>
										
								</span> <!-- Edit SubCategory Modal  aa-->
									<div class="reveal"
										id="item-subcategory-<?php echo e($subcategory['id']); ?>" data-reveal
										data-close-on-click="false" data-close-on-esc="false">
										<div class="notification callout primary"></div>
										<h3>Edit SubCategory</h3>
										<form>
											<div class="input-group">
												<label>Category Name <input type="text"
													id="item-name-subcategory-<?php echo e($subcategory['id']); ?>"
													value="<?php echo e($subcategory['name']); ?>">
												</label>
												<label>Change Category
												  <select id="item-category-<?php echo e($subcategory['category_id']); ?>">
                                                        <?php $__currentLoopData = \app\models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($category->id == $subcategory['category_id']): ?>
                                                                <option selected="selected" value="<?php echo e($category->id); ?>">
                                                                    <?php echo e($category->name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
												</label>

												<div>
													<input type="submit" class="button update-subcategory"
														id="submit-item-<?php echo e($category['id']); ?>" name="token"
														data-token="<?php echo e(\app\classes\CSRFToken::_token()); ?>"
														data-subcategory-id="<?php echo e($subcategory['id']); ?>"
														data-category-id="<?php echo e($subcategory['category_id']); ?>" value="Update">
												</div>
											</div>
										</form>
										<a href="/admin/products/categories" class="close-button"
											aria-label="Close modal" type="button"> <span
											aria-hidden="true">&times;</span>
										</a>

									</div> <!--Add Subcategory modal--></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
				<?php echo $subcategories_links; ?> <?php else: ?>
				<h3>You have not any subcategory</h3>
				<?php endif; ?>

			</div>
		</div>

	<?php echo $__env->make('includes.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php $__env->stopSection(); ?>@endsection
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\developer2\eshop\gitrepo\ecommerce\resources\views/admin/products/categories.blade.php ENDPATH**/ ?>