
//------------------------------------ FUNCTIONS WITH AJAX ---------------------------------->
//--------------------------------- DELETE, MOVE UP AND DOWN -------------------------------->
$(document).ready(function(){
    // DELETE CON AJAX ///////////////////////////////////////////////////////////////////////
    $('.cornerDeleteButton').click(function(e){
        e.preventDefault();
    });
    $('.deleteConfirm').click(function(){
        //We delete using ajax
        //var auxLevel = jQuery(this).children();
        var mapParent = jQuery(this).parent().parent().parent().parent().parent().parent();
        var maps = mapParent.parent();
        var level = jQuery(jQuery(mapParent.children()[0]).children()[2]);

        var url = window.location.href+"/"+jQuery(this).attr("iddb");
        console.log(url);
        $.ajax({
            "method" : "DELETE",
            "url" : url,
            "data" : {
                "level": level.text(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(data){
                //Lo que tenemos que hacer desaparecer
                mapParent.slideUp(400, function(){
                    mapParent.remove();
                    var index = 1;
                    for(var i = 1; i <= jQuery($('#allElements').children()).length + 1; i++){
                        if(i == level.text()){
                            continue;
                        }

                        $('#level'+i).text(index);
                        $('#level'+i).attr('id', 'level'+index);
                        $('#oneElement'+i).attr('id', 'oneElement'+index++);
                    }
                });
            }
        });
    });
    

    // MOVE UP ///////////////////////////////////////////////////////////////////////
    $('.bUp').click(function(){
        var button = jQuery($(this).children()[0]);
        button.prop('disabled', true);
        var parent = $(this).parent().parent().parent();
        var mapSelected = $(this).parent().parent();
        var level = jQuery(mapSelected.children()[0]);
        level = jQuery(level.children()[2]);
        //var button = jQuery(jQuery(jQuery(mapSelected.children()[0]).children()[0]).children()[0]);
        

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

    // MOVE DOWN   ///////////////////////////////////////////////////////////////////////
    $('.bDown').click(function(){
        var button = jQuery($(this).children()[0]);
        button.prop('disabled', true);

        var parent = $(this).parent().parent().parent();
        var mapSelected = $(this).parent().parent();
        var level = jQuery(mapSelected.children()[0]);
        level = jQuery(level.children()[2]);
        //Uncool but fast version
        //var button = jQuery(jQuery(level.siblings()[3]).children()[0]);
        //Cool but slow version
        //var button = $('.bDown'+level.text());
       
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