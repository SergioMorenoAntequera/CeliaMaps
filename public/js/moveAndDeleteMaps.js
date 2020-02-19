
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
        var button = $(this).find("button");
        button.prop('disabled', true);
        var parent = $(this).parents("#allElements");
        var mapSelected = $(this).parents(".oneElement");
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
                //Here we update the position of the divs
                //Here we have to update the numbers in the divs
                for (var i = 0; i < parent.children().length; i++) {
                    //We get the id of all the elements
                    var mapOther = jQuery(parent.children().get(i-1));
                    var levelOther = jQuery(mapOther.children()[0]);
                    levelOther = jQuery(levelOther.children()[2]);
                    //var levelOther = parseInt(mapOther.attr('id').replace("mapLevel", ""));
                    //console.log(idElement);

                    if(levelOther.text() == level.text() - 1){
                        mapOther.fadeOut(300);
                        mapSelected.fadeOut(300, function(){
                            level.text(parseInt(level.text()) - 1);
                            levelOther.text(parseInt(levelOther.text()) + 1);
                            
                            level.attr('id', "level"+level.text());
                            levelOther.attr('id', "level"+levelOther.text());
                            mapSelected.attr('id', "oneElement"+level.text());
                            mapOther.attr('id', "oneElement"+levelOther.text());

                            mapSelected.after(mapOther);
                            mapOther.fadeIn(300);
                            mapSelected.fadeIn(300);
                            button.prop('disabled', false);
                        });
                        return;
                    }
                }                        
            }
        });
    });

    // MOVE DOWN //////////////////////////////////////////////////////////////////////////
    $('.bDown').click(function(){
        var button = $(this).find("button");
        button.prop('disabled', true);
        var parent = $(this).parents("#allElements");
        var mapSelected = $(this).parents(".oneElement");
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
                
                //Here we update the position of the divs
                //Here we have to update the numbers in the divs
                for (var i = 0; i < parent.children().length; i++) {
                    //We get the id of all the elements


                    var mapOther = jQuery(parent.children().get(i+1));
                    var levelOther = jQuery(mapOther.children()[0]);
                    levelOther = jQuery(levelOther.children()[2]);
                    
                    if(parseInt(levelOther.text()) == parseInt(level.text()) + 1){
                        mapOther.fadeOut(300);
                        mapSelected.fadeOut(300, function(){
                            mapSelected.before(mapOther);
                            
                            level.text(parseInt(level.text()) + 1);
                            levelOther.text(parseInt(levelOther.text()) - 1);
                            button.prop('disabled', false);

                            level.attr('id', "level"+level.text());
                            levelOther.attr('id', "level"+levelOther.text());
                            mapSelected.attr('id', "oneElement"+level.text());
                            mapOther.attr('id', "oneElement"+levelOther.text());

                            mapOther.fadeIn(300);
                            mapSelected.fadeIn(300);
                        });
                        return;
                    }
                }                        
            }
        });
    });
});