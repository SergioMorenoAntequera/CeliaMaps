<?php $__env->startSection('title', 'Celia Maps'); ?> 

<?php $__env->startSection('content'); ?>

    <div id="frame">
        <img id="map" class="mapImg" src="<?php echo e(url('img/maps/Mapa-prueba.png')); ?>">
        <img class="mapImg" src="<?php echo e(url('img/maps/Mapa-prueba-2.png')); ?>">
        <img id="token" src="<?php echo e(url('img/icons/token.svg')); ?>">
    </div>

            <div class="modal fade" id="modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-dark" id="exampleModalLabel">Crear nuevo Hotspot</h5>
                      <button type="button" class="close"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-dark pb-0">
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
                                <input type="text" class="form-control" name="point_x" id="point_x" placeholder="Point X of the hotspot">
                            </div>
                            <div class="form-group">
                                <label>Punto Y</label>
                                <input type="text" class="form-control" name="point_y" id="point_y" placeholder="Point Y of the hotspot">
                            </div>
                            
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Añadir nuevo hotspot</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>     

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function(){
        
        $("input[name='map_id']").click(function(){
            $("#input_map"+this.value).toggle();
            console.log(this.value);
        });
    
        $('#map').click(function(e){
            var point_x = e.pageX - this.offsetLeft;
            var point_y = e.pageY - this.offsetTop;
            console.log("X: " + point_x + " Y: " + point_y); 
            // Modal
            setTimeout(function() {
                $('#modal').modal('show');
            }, 250);
            // Coordenadas punto
            $(".modal-body #point_x").val(point_x);
            $(".modal-body #point_y").val(point_y);
            // Ficha
            $("#token").css("left",point_x-15);
            $("#token").css("top",point_y-27);
            $("#token").show();

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/hotspot/create.blade.php ENDPATH**/ ?>