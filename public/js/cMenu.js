
// Enseña el menú indicado en csMenu
function showMenu(e, csMenu){
        // // We place the menu in the middle
        let localClicks = {top: e.originalEvent.clientY - 30, left: e.originalEvent.clientX - $("#leftNavBar").width() - 30};
        if(!userBusy){
            if($(".cMenu").css("display") == "none"){
                $(".cMenu").css({"left":localClicks.left, "top":localClicks.top});
                $(".cMenu").show();

                $("."+csMenu).fadeIn(150);
                let options = $("."+csMenu).find(".option");
                for (let i = 0; i < options.length; i++) {
                    jQuery(options[i]).animate({
                        top: (Math.sin( i / options.length * 2 * Math.PI) * 60) + 5, 
                        left: (Math.cos( i / options.length * 2 * Math.PI) * 60) + 5
                    }, 150);
                }
            } else { 
                $(".cMenu").animate({"left":localClicks.left, "top":localClicks.top}, 150);
            }
        }
};

// Oculta el menú que se esté mostrando
function hideMenu(){
        if($(".cMenu").css("display") == "block"){
            $(".cMenu").fadeOut(150, function(e){
                // Por cada subMenu
                $(".cMenu").children().each(function(e){
                    // Miramos si se está enseñando
                    if($(this).css("display") == "block"){
                        // Si lo está lo ocultamos
                        $(this).hide();
                        $(this).children().each(function(e) {
                            $(this).css({top:5, left:5});
                        });
                    }
                });
            });
        }
};

