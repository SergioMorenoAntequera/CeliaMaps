<?php $__env->startSection('title', 'Celia Maps'); ?>

<?php $__env->startSection('header'); ?>
    (En teoría)Aquí se crean modifican los mapas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <br>
    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Modificar Hotspot
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo e(route('hotspot.update', $hotspot->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PATCH"); ?>
                    
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" value="<?php echo e($hotspot->title); ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo e($hotspot->description); ?>">
                    </div>
                    <div class="form-group">
                        <label>Punto X</label>
                        <input type="text" class="form-control" name="point_x" value="<?php echo e($hotspot->point_x); ?>">
                    </div>
                    <div class="form-group">
                        <label>Punto Y</label>
                        <input type="text" class="form-control" name="point_y" value="<?php echo e($hotspot->point_y); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    footer
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/edit.blade.php ENDPATH**/ ?>