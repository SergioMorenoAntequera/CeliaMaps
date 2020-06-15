$(document).ready(function(){
    // Change kind of map in the background ///////////////////////////////////////////////////
    $('.tiles').click(function() {
        var parent = $('#tileChooser');
        mapTiles.forEach(function(e){
            map.removeLayer(e);
        });
        map.addLayer(mapTiles[parent.children().index($(this))]);
    });

    // We hide the menu and all that //////////////////////////////////////////////////////////
    $('#tilesShow').click(function(){
        var icono = $(this).find('i');
        var chooser = $(this).siblings();

        if(icono.hasClass("fa-chevron-down")){
            icono.removeClass("fa-chevron-down");
            icono.addClass("fa-chevron-up");
            
            $(this).parent().animate({
                bottom: "-100px",
            }, 300);
        } else {
            icono.removeClass("fa-chevron-up");
            icono.addClass("fa-chevron-down");
            
            if(window.innerWidth <= 520 ) {
                $(this).parent().animate({
                    bottom: "210px",
                }, 300);
            } else {
                $(this).parent().animate({
                    bottom: "15px",
                }, 300);
            }
        }
    });
});