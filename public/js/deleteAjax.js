
//------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
//--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
$(document).ready(function(){

    // DELETE CON AJAX ///////////////////////////////////////////////////////////////////////
    $(".deleteConfirm").on("click", function(){
        var route = window.location.href + "/deleteAjax/" + $(this).attr("iddb");
        var panel = $(this).parents(".wholePanel")

        
        $.ajax({
            type: "DELETE",
            "url": route,
            data: {_token: token, id: $(this).attr("iddb")},
            success: function(response){
                // Animación de borrar
                panel.css({
                    "position":"relative",
                });
                panel.animate({
                    left: "50px",
                }, 200, function(){
                    panel.animate({
                        left: "-3000px"
                    }, 450, function(){
                        panel.slideToggle(function(){
                            panel.remove();
                        });
                    });
                });
            }
        });
    });

});