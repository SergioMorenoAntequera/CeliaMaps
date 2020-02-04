
$(document).ready(function(){

    $('#borrado').click(function(e){
        e.preventDefault();
    });

    $('#borrado').click(function borradoUsuario(id, route){

        var route = "{{route('user.destroy', 'idreq')}}".replace('idreq',id)
        console.log(route);
        
        
        $.ajax({              
            url: route,
            type: 'delete',
            data: {
                "_token": "{{ csrf_token() }}",
                },
            success: function(result){
                if(result[status]){
                    $("#id" + result['idreq']).remove();
                    alert('registro borrado');
                }else {
                    modalWindw(result[error],0,null);
                    alert('no funciona');
                }
            }   
        });
    });  
    
});
    


