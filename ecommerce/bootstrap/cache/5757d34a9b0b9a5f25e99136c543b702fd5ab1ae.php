<?php $__env->startSection('body'); ?>
   <!-- navigation -->
   <?php echo $__env->make('includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <!-- Site Wrapper-->
   <div class="site_wrapper">
        <?php echo $__env->yieldContent('content'); ?>
   </div>
   <!-- navigation -->
   <?php echo $__env->yieldContent('footer'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\developer2\eshop\gitrepo\ecommerce\resources\views/layouts/app.blade.php ENDPATH**/ ?>