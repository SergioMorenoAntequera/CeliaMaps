<?php $__env->startSection('title', 'Celia Maps'); ?>

<?php $__env->startSection('header'); ?>
    (En teoría)Aquí se crean modifican los mapas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	

	<!-- One div to get all the hotspots -->
    <div class="container text-center">
        <!-- Todos los elementos de la página -->
        <div id="allElements">
            <?php $__currentLoopData = $hotspots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotspot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- Cada uno de los elementos de la página -->
                <div class="wholePanel" style="height: 186px;">

                    <!-- Columna con el numero y las flechas -->
					<div class="leftPanel" style="width:25%; position: relative; overflow: hidden">
						<img src="<?php echo e(url('img/hotspots/'.$hotspot->images[0]->file_name.'')); ?>" style="height: 100%">
                    </div>

                    <!-- Columna con la información del hotspot -->
                    <div class="rightPanel" style="width:75%; position: relative;">
                        <!-- Titulo -->
						<p><b class="text-6"><?php echo e($hotspot->title); ?></b></p>

                        <!-- Algunos detalles -->
                        <p class="descriptionOverflow"><?php echo e($hotspot->description); ?></p>

                        <!-- Boton para Borrar  -->
                        <form method="POST" action="<?php echo e(route('hotspot.destroy', $hotspot->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("DELETE"); ?>

                            <div data-toggle="modal" data-target="#ModalCenter<?php echo e($hotspot->id); ?>" class="deleteCornerButton cornerButton">
                                <img class="center" src="<?php echo e(url("img/icons/delete.svg")); ?>" alt=""> 
                            </div>
                        </form>
                        <div id="ModalCenter<?php echo e($hotspot->id); ?>" class="modal fade text-dark" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿En serio?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <p>¿Seguro que quieres borrar el hotspot <?php echo e($hotspot->title); ?>?</p>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                        <button iddb="<?php echo e($hotspot->id); ?>" type="button" class="btn btn-danger deleteConfirm" data-dismiss="modal">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FINAL modal para borrar -->

                        <!-- Boton para modificar -->
                        <a href="<?php echo e(route('hotspot.edit', $hotspot->id)); ?>">
                            <div class="cornerButton" style="right: 50px">
                                <img class="center" src="<?php echo e(url("img/icons/edit.svg")); ?>" alt=""> 
                            </div>
                        </a>
                    </div>
                </div> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> 
    </div>

    <a href="<?php echo e(route('hotspot.create')); ?>">
    <div id="addButton">
        <img class="center" src="<?php echo e(url("img/icons/plus.svg")); ?>">
    </div>
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
    <!--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script> var token = '<?php echo e(csrf_token()); ?>'</script>
    <script type="text/javascript" src="<?php echo e(url('/js/moveAndDeleteMaps.js')); ?>">
    </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/index.blade.php ENDPATH**/ ?>