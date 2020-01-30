
$(document).ready(function(){
    $("#fullScreenMenu").click(function(){ 
        //Tiene tanto rollo para que funcione en todos los navegadores
        var img = $(this).children("img");
        var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
            (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
            (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
            (document.msFullscreenElement && document.msFullscreenElement !== null);
    
        var docElm = document.documentElement;
        if (!isInFullScreen) {
            if (docElm.requestFullscreen) {
                docElm.requestFullscreen();
            } else if (docElm.mozRequestFullScreen) {
                docElm.mozRequestFullScreen();
            } else if (docElm.webkitRequestFullScreen) {
                docElm.webkitRequestFullScreen();
            } else if (docElm.msRequestFullscreen) {
                docElm.msRequestFullscreen();
            }
            
            var url = window.location.href;
            if(url.includes("map/align/")){
                url = url.substr(0, url.indexOf("map/align/"));
            }
            img.attr("src", url+"img/icons/fsMinimize.png");
            
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            
            var url = window.location.href;
            if(url.includes("map/align/")){
                url = url.substr(0, url.indexOf("map/align/"));
            }
            img.attr("src", url+"img/icons/fsMaximize.png");
        }
    });
});
