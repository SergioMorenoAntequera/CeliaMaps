<?php $__env->startSection('title', 'Celia Maps'); ?>

<?php $__env->startSection('header'); ?>
    (En teoría)Aquí se crean modifican los mapas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div id="table">
	<table style="width:60%">
		<tr>
			<th>Id</th>
			<th>Título</th>
			<th>Descripción</th>
			<th>Punto X</th>
			<th>Punto Y</th>
		</tr>
		<?php $__currentLoopData = $hotspotList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotspot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td>
					<span><?php echo e($hotspot->id); ?></span>
				</td>
				<td>
					<span><?php echo e($hotspot->title); ?></span>
				</td>
				<td>
					<span><?php echo e($hotspot->description); ?></span>
				</td>
				<td>
					<span><?php echo e($hotspot->point_x); ?></span>
				</td>
				<td>
					<span><?php echo e($hotspot->point_y); ?></span>
				</td>
				<td>
					<small>  
						<form style="display:contents" action = "<?php echo e(route('hotspot.destroy', $hotspot->id)); ?>" method="POST">
							<?php echo csrf_field(); ?>
							<?php echo method_field("DELETE"); ?>
								<button title="Delete" class="red" type="submit">Eliminar</button>
						</form>
						<form style="display:contents" action = "<?php echo e(route('hotspot.edit', $hotspot->id)); ?>" method="GET">
							<?php echo csrf_field(); ?>
							<button title="Edit" class="green" type="submit">Editar</button>
						</form>
					</small>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/index.blade.php ENDPATH**/ ?>