<?php $__env->startSection('title', 'Crear Hotspot'); ?>

<?php $__env->startSection('content'); ?>
    <br>
    <div class="container w-50 text-center">
        <div class="card">
            <div class="card-header">
                Registar Hotspot
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo e(route('hotspot.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" placeholder="Title of the hotspot">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Description of the hotspot">
                    </div>
                    <div class="form-group">
                        <label>Punto X</label>
                        <input type="text" class="form-control" name="point_x" placeholder="Point X of the hotspot">
                    </div>
                    <div class="form-group">
                        <label>Punto Y</label>
                        <input type="text" class="form-control" name="point_y" placeholder="Point Y of the hotspot">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    footer
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/create.blade.php ENDPATH**/ ?>