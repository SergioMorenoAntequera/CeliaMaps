//Top Left Menu.js

//Slider and how it affects the maps
function sliderChange(value, id){
    var slider = $("#"+id);
    //HEre we change the value
    slider.siblings(".opacity").text(value);
    var eye = slider.parents(".mapTrans").find("i");
    var clicked = slider.parents(".mapTrans");
    var mapIndex = $('.mapTrans').index(clicked);
    // Para los graciosillos
    if(eye.hasClass('fa-eye')){
        images[mapIndex].setOpacity(slider.val() * 0.01);
    } else {
        images[mapIndex].setOpacity(0);
    }
}

$(document).ready(function(){

    $('.ballMenu').on('click', function(){
        toggleBalls();
    });

    $('.ball').on("click", function(){
        if($(this).attr("id").includes("Maps")) {
            $("#mapsMenu").fadeToggle(100);
        }
        if($(this).attr("id").includes("Hotspots")) {
            $("#hotspotsMenu").fadeToggle(100);
        }
        if($(this).attr("id").includes("Streets")) {
            $("#streetsMenu").fadeToggle(100);
        }
    });
    
    $(".menu").draggable();

    $('.closeMenuButton').on("click", function(){
        $(this).parents(".menu").fadeOut(100);
    });

    $(".pinMenuButton").on("click", function(){
        var ping = $(this).children(".pingCross");
        if(ping.css('display') == "none"){
            // Fijando el menú en el mepa
            ping.css('display', "block");
        } else {
            // Desfijamos el menú del mapa
            ping.css('display', "none");
        }
    });

    //Eye to enable disable tranparencies
    $('.contEye').click(function(){
        swapShowMenu($(this));
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
    
    //////////////////////////////////////////////////////////////////////////////////////////
    // AUXILIAR METHODS //////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////

    // CAMBIAR ENTRE ENSEÑAR LAS BOLAS O NO //////////////////////////////////////////////////
    function toggleBalls(){
        var BallMenu = $(".ballMenu");
        var balls = BallMenu.siblings(".ball");
        balls.each(function(index){
            var ball = jQuery(balls[index]);
            if(ball.css('top') == "0px"){
                var lefts = new Array("110px", "75px", "10px");
                var tops = new Array("10px", "75px", "110px");
            } else {
                var lefts = new Array("0px", "0px", "0px");
                var tops = new Array("0px", "0px", "0px");
            }
            ball.animate({
                left: lefts[index],
                top: tops[index],
            }, 200);
        });
    }

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
        var valueOpacity = eyeContainer.siblings().find('.sliderVar').val();
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