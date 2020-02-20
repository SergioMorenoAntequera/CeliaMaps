
//------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
//--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
$(document).ready(function(){
    $(".cornerbutton").hover(function(){
        $(this).find("img").animate({
            width:"65%"
        }, 200);
    }, function(){
        $(this).find("img").animate({
            width:"60%"
        },200);
    });

    // DELETE CON AJAX ///////////////////////////////////////////////////////////////////////
    $(".deleteConfirm").on("click", function(){
        var route = window.location.href + "/" + $(this).attr("iddb");
        var panel = $(this).parents(".wholePanel")
        $.ajax({
            type: "DELETE",
            "url": route,
            data: {_token: token, id: $(this).attr("iddb")},
            success: function(){
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
                            //Reordenarlo todo
                            var index = 1;
                            $(".mapLevel").each(function(){
                                console.log($(this))
                                $(this).text(index++);
                            });
                        });
                    });
                });
            }
        });
    });

    // MOVE UP /////////////////////////////////////////////////////////////////////////////
    $('.bUp').click(function(){
        var button = $(this);
        button.prop('disabled', true);
        var parent = $(this).parents("#allElements");
        var mapSelected = $(this).parents(".wholePanel");
        var level = mapSelected.find(".mapLevel");
        
        if(level.text() == 1){
            alert("No puedes subir el primer mapa");
            button.prop('disabled', false);
            return;
        }
        
        var url = window.location.href+"/up";
        $.ajax({
            method: "GET",
            "url": url,
            data: {level: level.text()},
            success: function(data){
                //Here we get both of the divs that we are going to modify
                var goingDown = parent.find(".mapLevel:contains("+data.level+")");
                var goingUp = parent.find(".mapLevel:contains("+data.levelOther+")");
                //Here we modiffy the numbers
                goingDown.text(parseInt(goingDown.text()) + 1);
                goingUp.text(parseInt(goingUp.text()) - 1);
                
                //Now we swap to the parents to be able to move them
                goingDown = goingDown.parents(".wholePanel");
                goingUp = goingUp.parents(".wholePanel");
                var dist = parseInt(goingUp.position().top) - parseInt(goingDown.position().top);
                
                goingDown.animate({
                    top: "+="+dist,
                }, 200);
                goingUp.animate({
                    top : "-="+dist,
                }, 200, function(){
                    // goingUp.after(goingDown);
                    button.prop('disabled', false); 
                });
            }
        });
    });

    // MOVE DOWN //////////////////////////////////////////////////////////////////////////
    $('.bDown').click(function(){
        var button = $(this);
        button.prop('disabled', true);
        var parent = $(this).parents("#allElements");
        var mapSelected = $(this).parents(".wholePanel");
        var level = mapSelected.find(".mapLevel");

        var url = window.location.href+"/down";
        $.ajax({
            method: "GET",
            "url": url,
            data: {level: level.text()},
            success: function(data){

                if(data['lastOne']){
                    alert("No puedes bajar el último mapa");
                    button.prop('disabled', false);
                    return;
                }
                
                //Here we get both of the divs that we are going to modify
                var goingUp = parent.find(".mapLevel:contains("+data.level+")");
                var goingDown = parent.find(".mapLevel:contains("+data.levelOther+")");
                
                //Here we modiffy the numbers
                goingDown.text(parseInt(goingDown.text()) + 1);
                goingUp.text(parseInt(goingUp.text()) - 1);
                
                //Now we swap to the parents to be able to move them
                goingDown = goingDown.parents(".wholePanel");
                goingUp = goingUp.parents(".wholePanel");

                var dist = parseInt(goingUp.position().top) - parseInt(goingDown.position().top);
                
                goingDown.animate({
                    top: "+="+dist,
                }, 200);
                goingUp.animate({
                    top : "-="+dist,
                }, 200, function(){
                    // goingUp.after(goingDown);
                    button.prop('disabled', false); 
                });
            }
        });
    });
});