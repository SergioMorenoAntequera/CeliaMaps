<?php $__env->startSection('title','Prueba plantilla'); ?>


<?php $__env->startSection('header'); ?>
    asd
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<ul class="nav nav-fill pt-3">
    <li class="nav-item">
    <a class="nav-link" href="<?php echo e(url("")); ?>">Todas</a>
    </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url("")); ?>">Prueba</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url("")); ?>">Prueba</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url("")); ?>">Prueba</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url("")); ?>">Prueba</a>
        </li>
    
</ul>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
    ad
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/maps/resources/views//layouts/test.blade.php ENDPATH**/ ?>