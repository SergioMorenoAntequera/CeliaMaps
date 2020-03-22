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

    // Variable para controlar los marcadores cuando están activos
    var hpMarkers = [];
    $('.ball').on("click", function(){
        if($(this).attr("id").includes("Maps")) {
            swapOpacity($(this).find("img"));
            $("#mapsMenu").fadeToggle(100);
        }
        if($(this).attr("id").includes("Hotspots")) {
            // Ponerle o quitarle transparencia al icono
            swapOpacity($(this).find("img"));
            
            // We check if the opacity is 1 is that we have to show the hotspots
            if($(this).find("img").css("opacity") == 1){
                // Mostramos todos los hotspot que nos hemos preparado en 
                // la variable jsHotspots antes de llamar este script
                jsHotspots.forEach(hp => {
                    var marker = L.marker([hp.lat, hp.lng], 
                        {icon: markerHotspot})
                        .on('click', function(e){
                            var hpData = e.target.hotspotInfo;
                            // Centramos la vista en el hotspot
                            map.setView([hpData.lat, parseFloat(hpData.lng) + 0.00041], 18);
                            // Se completa la información de la ventana
                            $("#hp-title").text(hpData.title);
                            $("#hp-img").attr("src", hpData.images[0].file_path + "/" + hpData.images[0].file_name);
                            $("#hp-description").text(hpData.description);
                            // Aparece la ventana
                            $("#hotspotMenu").fadeIn(200);
                        }
                    );
                    marker = $.extend(marker, {"hotspotInfo": hp});
                    hpMarkers.push(marker);
                    marker.addTo(map);
                });
            } else {
                // If it's not 1 it means tht we have to hide them
                // We check all the active markers and remove them from the map
                hpMarkers.forEach(marker => {
                    map.removeLayer(marker);
                });
                // Clear the active markers variable
                hpMarkers = [];
            }
            
            
            // $("#hotspotsMenu").fadeToggle(100);
            // if(activeMarkers.length == 0){
            //     $("#ballHotspots img").css({opacity:1});
            //     hotspotsFull.forEach(hotspot => {
            //     });
            // } else {
            //     $("#ballHotspots img").css({opacity:0.2});
            //     activeMarkers.forEach(marker => {
            //         map.removeLayer(marker);
            //     });
            //     activeMarkers = [];
            // }
        }

        if($(this).attr("id").includes("Streets")) {
            swapOpacity($(this).find("img"));
            $("#streetsMenu").fadeToggle(100);
        }
    });
    
    $(".menu").draggable();


    $('.closeMenuButton').on("click", function(){
        // Hacemos desaparecer la ventana
        $(this).parents(".menu").fadeOut(100);
        // La deseleccionamos del menú bola
        var idAux = $(this).parents(".menu").attr("id").replace("Menu", "");
        idAux = "ball" + idAux[0].toUpperCase() + idAux.substr(1);
        $("#"+idAux).find("img").css({opacity:0.2});
    });

    $(".pinMenuButton").on("click", function(){
        var ping = $(this).children(".pinIcon");
        if(ping.css('opacity') == 0.5){
            // Fijando el menú en el mepa
            ping.css('opacity', 1);
            ping.parents('.menu').draggable( "disable" );
        } else {
            // Desfijamos el menú del mapa
            ping.css('opacity', 0.5);
            ping.parents('.menu').draggable( "enable" );
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

    // Method that we use to see if an option is selected or not
    function swapOpacity(img){
        if(img.css("opacity") < 1){
            img.css({"opacity": 1});
        } else {
            img.css({"opacity": 0.2});
        }
    }
});