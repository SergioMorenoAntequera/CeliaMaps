
$(document).ready(function(){

    $('#borrado').click(function(e){
        e.preventDefault();
    });

    $('#borrado').click(function borradoUsuario(id, route){

        var route = "{{route('user.destroy', 'Request')}}".replace('Request',id)
        
        $.ajax({              
            url: route,
            type: 'delete',
            data: {
                "_token": "{{ csrf_token() }}",
                },
            success: function(result){
                if(result[status]){
                    $("#id" + result['Request']).remove();
                    alert('registro borrado');
                }else {
                    modalWindw(result[error],0,null);
                    alert('no funciona');
                }
            }   
        });
    });  
    
});
    


