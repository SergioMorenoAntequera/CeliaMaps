//Top Left Menu.js
$(document).ready(function(){

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
        var eye = slider.parents(".mapTrans").find("i");
        var clicked = slider.parents(".mapTrans");
        var mapIndex = $('.mapTrans').index(clicked);

        // Para los graciosillos
        if(eye.hasClass('fa-eye')){
            images[mapIndex].setOpacity($(this).val() * 0.01);
        } else {
            images[mapIndex].setOpacity(0);
        }
    });
    
    //////////////////////////////////////////////////////////////////////////////////////////
    // AUXILIAR METHODS //////////////////////////////////////////////////////////////////////

    // SWAP BETWEEN EYES MODES //////////////////////////////////////////////////////////////
    function swapShowMenu(eyeContainer){

        var eye = jQuery(eyeContainer.find(".eye"));
        var clicked = eyeContainer.parents(".mapTrans");
        var mapIndex = $('.mapTrans').index(clicked);

        if(eye.hasClass("fa-eye")){
            disable(eyeContainer, eye, mapIndex);
        } else {
            enable(eyeContainer, eye, mapIndex);
        }
    }
    // ENABLE EYE /////////////////////////////////////////////////////////////////////////
    function enable(eyeContainer, eye, mapIndex){
        eye.removeClass("fa-eye-slash");
        var valueOpacity = eyeContainer.siblings().find('.slider').val();
        eyeContainer.siblings().find('.opacity').text(valueOpacity);
        eyeContainer.animate({ 
            opacity: 1,
        }, 100);
        eye.addClass("fa-eye");
        eyeContainer.find(".opacity").attr("disabled", false);
        eyeContainer.siblings('.contSlider').slideDown(200);

        map.addLayer(images[mapIndex]);
        images[mapIndex].setOpacity(valueOpacity * 0.01);
    }
    // DISABLE EYE  /////////////////////////////////////////////////////////////////////////
    function disable(eyeContainer, eye, mapIndex){
        eye.removeClass("fa-eye");
        eye.parent().animate({
            opacity: 0.50,
        }, 100);
        eye.addClass("fa-eye-slash");
        eyeContainer.find("input").attr("disabled", true);
        eyeContainer.siblings('.contSlider').slideUp(200, function(){
            eyeContainer.siblings().find('.opacity').text(0);
        });

        images[mapIndex].setOpacity(0);
    }
});