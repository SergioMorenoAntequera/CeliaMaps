<?php $__env->startSection('title', 'Celia Maps'); ?>

<?php $__env->startSection('header'); ?>
    (En teoría)Aquí se crean modifican los mapas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="container text-center">
		<a href="<?php echo e(route('hotspot.create')); ?>">
			<button>
				Crear nuevo
			</button>
		</a>

		<div class="row allElements justify-content-center">
			<?php $__currentLoopData = $hotspotList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotspot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="oneElement col-8">
					<div class="textElement bg-primary">
						<p><b class="text-white"><?php echo e($hotspot->id); ?> <a href="<?php echo e(route("hotspot.show", $hotspot->id)); ?>"> <?php echo e($hotspot->title); ?> </a></b></p>
						<p><b class="text-white">Point X: <?php echo e($hotspot->point_x); ?>   Point Y: <?php echo e($hotspot->point_y); ?></b></p>
						<p><b class="text-white"><?php echo e($hotspot->map_id); ?></b></p>
					
						<!-- Boton para modificar -->
                        <a href="<?php echo e(route('hotspot.edit', $hotspot->id)); ?>"> 
                            <button class="cornerUpdateButton bg-secondary">
                                <img src="<?php echo e(url("img/icons/editWhite.png")); ?>" alt=""> 
                            </button>
                        </a>
                    
                        <!-- Boton para borrar -->
                        <form method="POST" action="<?php echo e(route('hotspot.destroy', $hotspot->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("DELETE"); ?>

                            <button class="cornerDeleteButton bg-secondary" type="submit" value="Eliminar">
                                <img src="<?php echo e(url("img/icons/deleteWhite.png")); ?>" alt="">    
                            </button>
                        </form>
					</div>
				</div>
				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/index.blade.php ENDPATH**/ ?>