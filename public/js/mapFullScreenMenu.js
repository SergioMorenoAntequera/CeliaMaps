$(document).ready(function(){

    $("#fullScreenMenu").click(function(){ 
        
        // Full screen button image
        var img = $(this).children("img");
        // Actual image path
        let url = img.attr("src");
        // Path without filename and file extension
        url = url.substring(0, url.length - 14);

        //Tiene tanto rollo para que funcione en todos los navegadores
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
            
            // Change button image
            img.attr("src", url+"fsMinimize.png");
            
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
            
            // Change button image
            img.attr("src", url+"fsMaximize.png");
        }
    });
});
