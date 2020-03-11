<?php $__env->startSection('title', 'Celia Maps'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container text-center">
        <div class="wholePanel">
            <div class="leftPanel">
                <div class="mt-3 content justify-content-center align-items-center">
                    Modificando hotspot
                    <br>
                    <p class="mb-3" style="margin-bottom: 0px;  font-size: 50px"><?php echo e($hotspot->title); ?></p>
                    <?php if($hotspot->images[0] != ""): ?>
                        <img class="mb-4" src="<?php echo e(url('img/hotspots/'.$hotspot->images[0]->file_name.'')); ?>" alt="Miniatura">  
                    <?php else: ?> 
                        <img class="mb-4" src="<?php echo e(url('img/maps/NoMap.png')); ?>" alt="Sin Miniatura">  
                    <?php endif; ?>
                </div>
            </div>    
           <div class="rightPanel">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul style="margin: 0px">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
               <form method="POST" action="<?php echo e(route('hotspot.update', $hotspot->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PATCH"); ?>
                    
                    <div class="form-group">
                        <label>Título <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="<?php echo e($hotspot->title); ?>">
                    </div>
                    <div class="form-group">
                        <label>Descripcion <span class="text-danger">*</span></label>
                        <textarea class="form-control" style="height: 110px" name="description"><?php echo e($hotspot->description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="lat" value="<?php echo e($hotspot->lat); ?>">
                        <input type="hidden" class="form-control" name="lng" value="<?php echo e($hotspot->lng); ?>">
                    </div>

                    <button type="submit" class="mt-3 btn btn-success"> Confirmar Cambios </button>
                </form>
                <a href="<?php echo e(route('hotspot.index')); ?>">
                    <div class="cornerButton">
                        <img class="center" src="<?php echo e(url("img/icons/close.svg")); ?>" alt=""> 
                    </div>
                </a>
           </div>
        </div>    
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/edit.blade.php ENDPATH**/ ?>