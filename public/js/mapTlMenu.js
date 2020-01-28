//Top Left Menu.js
$(document).ready(function(){
    $('#mapid').click(function(e) {
        var latlng = map.mouseEventToLatLng(e.originalEvent);
        console.log("PRA");
        console.log(latlng.lat + ', ' + latlng.lng);
    });  

    $('#mapsMenu').slideToggle(300);
    //Eye to enable disable tranparencies
    $('.contEye').click(function(){
        swapShowMenu($(this));
    });
    //Slider and how it affects the maps
    $('.slider').change(function(){
        $(this).parent().find(".opacity").text($(this).val());        
    });
    $('#mapsShow').click(function(){
        var icono = $(this).find('i');
        if(icono.hasClass('fa-chevron-up')){
            $(this).siblings().slideUp(300);
            $(this).siblings().animate({
                top: "0px",
            }, 300);
            icono.removeClass('fa-chevron-up');
            icono.addClass('fa-chevron-down');
        } else {
            $(this).siblings().slideDown(300);
            icono.removeClass('fa-chevron-down');
            icono.addClass('fa-chevron-up');
        }
    });

    // CHANGING THE OPACITY OF THE MAP ON TOP  ///////////////////////////////////////////////
    $('.slider').change(function(){
        var slider = $(this);
        var mapIndex = $(this).parent().children().index($(this));
        images[mapIndex].setOpacity($(this).val() * 0.01);
    });
    
    //////////////////////////////////////////////////////////////////////////////////////////
    // AUXILIAR METHODS //////////////////////////////////////////////////////////////////////

    // SWAP BETWEEN EYES MODES //////////////////////////////////////////////////////////////
    function swapShowMenu(eyeContainer){

        var eye = jQuery(eyeContainer.find(".eye"));

        if(eye.hasClass("fa-eye")){
            disable(eyeContainer, eye);
        } else {
            enable(eyeContainer, eye);
        }
    }
    // ENABLE EYE /////////////////////////////////////////////////////////////////////////
    function enable(eyeContainer, eye){
        eye.removeClass("fa-eye-slash");
        var valueOpacity = eyeContainer.siblings().find('.slider').val();
        eyeContainer.siblings().find('.opacity').text(valueOpacity);
        eyeContainer.animate({ 
            opacity: 1,
        }, 100);
        eye.addClass("fa-eye");
        eyeContainer.find(".opacity").attr("disabled", false);
        eyeContainer.siblings('.contSlider').slideDown(200);
    }
    // DISABLE EYE  /////////////////////////////////////////////////////////////////////////
    function disable(eyeContainer, eye){
        eye.removeClass("fa-eye");
        eye.parent().animate({
            opacity: 0.50,
        }, 100);
        eye.addClass("fa-eye-slash");
        eyeContainer.find("input").attr("disabled", true);
        eyeContainer.siblings('.contSlider').slideUp(200, function(){
            eyeContainer.siblings().find('.opacity').text(0);
        });
    }
    
});